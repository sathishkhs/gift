<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'vendor/autoload.php';
// require(APPPATH . 'third_party/razorpay/razorpay-php/Razorpay.php');
// require_once 'vendor/dompdf/autoload.inc.php';
// print_r(get_included_files());exit;
use Razorpay\Api\Api;
class Campaigns extends MY_Controller {
    public $class_name;
    public $api;
    function __construct() {
        parent::__construct();
        $this->class_name = strtolower(get_class());
        $this->config->load('razorpay-config');
      
       
        $this->load->model('payment_model');
    }

  public function index($slug) {
        if($slug == 'sponsor-a-child'){
            redirect('sponsor-for-education');
        }
    //   print_r($_POST);exit;
        if(!empty($this->input->post())){
            $data = $this->data;
            $table_name = $this->input->post('table_name');
          
            $citizen = $this->input->post('citizen');
            $dob = !empty($this->input->post('dob')) ? $this->input->post('dob') : '0000-00-00';
            $pan = $this->input->post('pan');
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $mobile_number = $this->input->post('mobile_number');
            $location = !empty($this->input->post('location')) ? $this->input->post('location') : 'N/A';
            $city = $this->input->post('city');
            // $amount = $this->input->post('amount');
            // $amount = $this->input->post('payble_amount');
            
            $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $generated_key = substr(str_shuffle($str_result), 0, 4);
            $receipt = $generated_key . '_' . rand('127583123', '192474523');
            
            $this->payment_model->data['receipt'] = $receipt;
            $this->payment_model->data['name'] = $name = $this->input->post('name');
            $this->payment_model->data['email'] = $email = $this->input->post('email');
            $this->payment_model->data['mobile_number'] = $this->input->post('mobile_number');
            $this->payment_model->data['city'] = $this->input->post('city');
            $this->payment_model->data['amount'] = $amount = $this->input->post('amount');
            $this->payment_model->data['pan'] = $pan = $this->input->post('pan');
            
            $this->payment_model->data['citizen'] = $this->input->post('citizen');
            $this->payment_model->data['currency'] = $currency = $this->input->post('currency');
            $this->payment_model->data['programme'] = $programme = $this->input->post('programme');
            $this->payment_model->data['payment_date'] = date('Y-m-d H:i:s');
            $this->payment_model->data['sem'] =   $sem = $this->input->post('sem');
            $sem = !empty($sem) ? "?sem=".$sem : '';
                $insert_id = $this->payment_model->insert($table_name);
                if($currency == 'INR' ){
                    $rzp_amount = $amount * 100;
                    $keyId = $this->config->item('keyId');
                    $keySecret = $this->config->item('keySecret');
     
                }else{
                    $rzp_amount = $amount;
                    $keyId = $this->config->item('foreign_keyId');
                    $keySecret = $this->config->item('foreign_keySecret');
                }

            $api = new Api($keyId, $keySecret);
    
          
            //
            // We create an razorpay order using orders api
            // Docs: https://docs.razorpay.com/docs/orders
            //
            $orderData = [
                'receipt'         => $receipt,
                'amount'          => $rzp_amount, // 2000 rupees in paise
                'currency'        => $currency,
                'payment_capture' => 1, // auto capture
                'notes'           => array(
                    "name"  =>  $name,
                    "email"             => $email,
                    "contact"           => $mobile_number,
                    "pan"               => $pan,
                    "dob"               => $dob,
                    "citizen"           => $citizen,
                )

            ];
    
            $razorpayOrder = $api->order->create($orderData);
              
            $razorpayOrderId = $razorpayOrder['id'];
    
            $_SESSION['razorpay_order_id'] = $razorpayOrderId;
    
            $displayAmount = $amount = $orderData['amount'];
    
            // if ($this->config->item('displayCurrency') !== $currency) {
            //     $url = "https://api.fixer.io/latest?symbols=$this->config->item('displayCurrency')&base=" . $orderData['currency'] . "";
            //     $exchange = json_decode(file_get_contents($url), true);
    
            //     $displayAmount = $exchange['rates'][$this->config->item('displayCurrency')] * $amount / 100;
            // }
    
            $checkout = 'automatic';
    
            if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true)) {
                $checkout = $_GET['checkout'];
            }
    
            $data += [
                "key"               => $this->config->item('keyId'),
                "amount"            => $amount,
                "name"              => "Vidya Chetana",
                "description"       => "Vidya Chetana Scholarship Program",
                "image"             => "https://s3.amazonaws.com/assets.reachapp.co/assets/000/019/820/VC_YFS_logo_(1).original.png?1596717275",
                "prefill"           => [
                    "name"              => $name,
                    "email"             => $email,
                    "contact"           => $mobile_number,
                    "pan"               => $pan,
                    "dob"               => $dob,
                    "citizen"           => $citizen,
                ],
                "notes"             => [
                    "address"           => $city,
                    "location"          => $city,
                    "city"              => $city,
                    "merchant_order_id" => $receipt,
                ],
                "theme"             => [
                    "color"             => "#5ab941"
                ],
                "order_id"          => $razorpayOrderId,
                "insert_id"         => $insert_id,
                "programme"         => $programme,
                "table_name"              =>$table_name
            ];
    
            if ($this->config->item('displayCurrency') !== $currency) {
                $data['display_currency']  = $this->config->item('displayCurrency');
                $data['display_amount']    = $displayAmount;
            }
          
            $json = json_encode($data);
            $data['view_path'] = "campaigns/$slug";
            $this->load->view('templates/custom_page', $data);


        }else{
        $template_path = $this->pagewisecontent($slug);
        $template_path = "templates/campaigns/campaign_home";
        $data = $this->data;
        $data['view_path'] = "campaigns/$slug"; 
        $data['page_heading'] = $data['page_items']->page_title;
        $data['breadcrumb'] = '<b><a href="" class="thm-text">BACK TO HOME</a></b> ';
        // $data['scripts'] = array('assets/javascripts/campaign_page.js');
        $this->load->view($template_path, $data);
        }
    
    }
    

    function currency_convert($amount,$currency)
    {
        $url = "https://api.exchangerate-api.com/v4/latest/INR";
        $json = file_get_contents($url);
        $exp = json_decode($json);

        $convert = $exp->rates->$currency;

        // return $convert * $amount;
        echo json_encode(round($convert * $amount));
    }
    // echo thmx_currency_convert(1000);


    public function html_to_pdf($receipt, $razorpay_payment_id, $org_name, $email,$mobile_number, $name, $amount, $address){
        $mpdf = new \Mpdf\Mpdf();
    //   $html = $this->load->view('invoice_templates/donation_success',[],true);
        $this->payment_model->primary_key = array('template_id' => 4);
        $template = $this->payment_model->row_data('email_templates');
      $html = str_replace('####NAME####',$name,$template->template_content);
      $html = str_replace('####EMAIL####',$email,$html);
      $html = str_replace('####ORGNAME####',$org_name,$html);
      $html = str_replace('####ORDERID####',$receipt,$html);
      $html = str_replace('####TRANSACTIONID####',$razorpay_payment_id,$html);
      $html = str_replace('####AMOUNT####',$amount,$html);
      $html = str_replace('####ADDRESS####',$address,$html);
      $html = str_replace('####DATE####',date('Y-m-d'),$html);
      $html = str_replace('####MOBILE####',$mobile_number,$html);
    
      $mpdf->SetDisplayMode('fullpage','single');
   
        $mpdf->WriteHTML($html);
    //   $mpdf->WriteHTML($html);
        $mpdf->Output(INVOICE_PDF_PATH."$receipt.pdf",'F');
        return true;
       }
   


    public function save_payment($insert_id,$table_name)
    {
      $data = $this->data;
        $this->payment_model->primary_key = array('donation_id'=>$insert_id);
        $payment_data = $this->payment_model->row_data($table_name);
        // print_r($payment_data);exit;
        $this->payment_model->data['name'] =$name =  $payment_data->name;
        $this->payment_model->data['email'] =$email =  $payment_data->email;
        $this->payment_model->data['city'] =$city =  $payment_data->city;
        $this->payment_model->data['mobile_number'] =$mobile_number =  $payment_data->mobile_number;
        $this->payment_model->data['amount'] =$amount =  $payment_data->amount;
        
        $this->payment_model->data['programme'] =$programme =  $payment_data->programme;
      
        $this->payment_model->data['order_id'] =$order_id = (!empty($this->input->post('error')) ? json_decode($this->input->post('error')['metadata'])->payment_id : (!empty($this->input->post('razorpay_payment_id')) ? $this->input->post('razorpay_payment_id') : $payment_data->receipt.'RZP Id Not Found'));
        $this->payment_model->data['receipt'] =$receipt =  $payment_data->receipt;
        
        $this->payment_model->data['razorpay_payment_id'] = $razorpay_payment_id = (!empty($this->input->post('error')) ? json_decode($this->input->post('error')['metadata'])->payment_id : (!empty($this->input->post('razorpay_payment_id')) ? $this->input->post('razorpay_payment_id') : $payment_data->receipt.'RZP Id Not Found'));
      
        $pan = $payment_data->pan;
        $payment_date = date('Y-m-d H:i:s');

        $api = new Api($this->config->item('keyId'), $this->config->item('keySecret'));
        $api->payment->fetch($order_id)->edit(array('notes'=> array('name'=>$name, 'mobile_number'=>$mobile_number,'receipt'=>$receipt,'pan'=>$pan,'payment_date'=>$payment_date)));

        if(!empty($this->input->post('error'))){
            $this->payment_model->data['payment_status'] = 'Failed';
            $this->payment_model->data['razorpay_payment_id'] = json_decode($this->input->post('error')['metadata'])->payment_id;
            $this->payment_model->primary_key = array('donation_id'=>$insert_id);
            $this->payment_model->update($table_name);
            $this->sendmail($email, $name, $amount,$receipt, 0);
            redirect($this->class_name . '/donation_failed/');

        }else{    
        $this->payment_model->data['payment_status'] = 'success';
       
        $tada = (object)['office_address'=>$data['settings']->OFFICE_ADDRESS, 'website_url'=>base_url(), 'office_email'=>$data['settings']->EMAIL, 'office_phone'=>$data['settings']->TOLL_FREE_TIME, 'receipt'=>$payment_data->receipt, 'name'=>$payment_data->name, 'address'=>$payment_data->city, 'mobile_number'=>$payment_data->mobile_number, 'order_id'=>$order_id, 'payment_date'=>$payment_data->payment_date, 'campaign'=> $payment_data->programme, 'amount'=>$payment_data->amount, 'pan_number'=>$payment_data->pan, 'razorpay_payment_id'=>$razorpay_payment_id ];
        $data['pdf_path'] =  $pdf_path =  $this->invoice($tada);
        
        $this->payment_model->primary_key = array('donation_id'=> $insert_id);
        if ($this->payment_model->update($table_name)) {

           
            $this->sendmail($email, $name, $amount,$receipt, 1,$pdf_path);
            $this->session->set_flashdata('name',$name);
            $this->session->set_flashdata('amount',$amount);
            $this->session->set_flashdata('order_id',$order_id);
            $this->session->set_flashdata('razorpay_payment_id',$razorpay_payment_id);
            $this->session->set_flashdata('receipt',$receipt);
            
            redirect($this->class_name . "/donation_success/$name/$amount/$razorpay_payment_id/$pdf_path");
        } 
    }
    }

    public function sendmail($to_mail, $name, $amount,$receipt, $status,$pdf_path1 ='',$pdf_path2='', $pdf_path3 ='')
    {
        $pdf_path = $pdf_path1.'/'.$pdf_path2.'/'.$pdf_path3;

        $config['protocol']    = 'mail';
        $config['smtp_host']    = 'mail.vidyachetana.in';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '30';
        $config['smtp_user']    = 'donations@vidyachetana.in';
        $config['smtp_pass']    = 'vidyachetana';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        // $config['smtp_crypto'] = 'ssl';
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not 
        $config['wordwrap'] = TRUE; // bool whether to validate email or not 

        $this->load->library('email', $config);
        $this->email->set_mailtype("html");
        $this->email->from('donations@vidyachetana.in', 'Vidya Chetana');
        $this->email->to($to_mail);

        if ($status == 1) {
            $this->payment_model->primary_key = array('template_id' => 1);
            $template = $this->payment_model->row_data('email_templates');
            $data['name'] = $name;
            $data['amount'] = $amount;
            $this->email->subject($template->template_title);
            // $message = $template->template_content;
            $message = str_replace('####NAME####', $name, $template->template_content);
            $message = str_replace('####RECEIPT####', $receipt, $message);
            $message = str_replace('####PDFPATH####', $pdf_path, $message);
        } elseif ($status == 0) {
            $this->payment_model->primary_key = array('template_id' => 2);
            $template = $this->payment_model->row_data('email_templates');
            $data['name'] = $name;
            $data['amount'] = $amount;
            $this->email->subject($template->template_title);
            // $message = $template->template_content;

            $message = str_replace('####NAME####', $name, $template->template_content);
            $message = str_replace('####RECEIPT####', $receipt, $message);
            $message = str_replace('####PDFPATH####', $pdf_path, $message);
            // $message = $this->load->view('email_templates/failed.php',$data,true);
        }


        $this->email->message($message);
       
        $q = $this->email->send();

        
    }

    public function donation_success($res = '', $amount= '', $razorpay_payment_id = '',$pdf_path1 ='',$pdf_path2='', $pdf_path3 ='')
    {
        $pdf_path = $pdf_path1.'/'.$pdf_path2.'/'.$pdf_path3;
       
        $data = $this->data ;
        // if(empty($res) || empty($amount)){
        //     redirect('donate');
        // }
        $data['pdf_path'] = $pdf_path;
        $msg = array();
        $data['view_path'] = $this->class_name . '/donation_success';
        $data['name'] = urldecode($res);
        $data['amount'] = $amount;
        $data['razorpay_payment_id'] = $razorpay_payment_id;
        $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
        $this->load->view('templates/custom_page', $data);
    }
    public function donation_failed($name)
    {
        $data = $this->data;
        $msg = array();
        $data['view_path'] = $this->class_name . '/donation_failed';
        $data['name'] = ucfirst($name);
        $data['scripts'] = array('javascripts/' . $this->class_name . '.js', 'javascripts/dashboard.js');
        $this->load->view('templates/custom_page', $data);
    }




    
    
    public function invoice($tada){
        // print_R(file_get_contents(base_url('assets/css/bootstrap.min.css')));exit;
        $data = $this->data;
     
        $mpdf = new \Mpdf\Mpdf();
        // $html = $this->load->view('html_to_pdf',[],true);
     
        // $html=" <style>body{ font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; text-align: center; color: #777} body h1{ font-weight: 300; margin-bottom: 0px; padding-bottom: 0px; color: #000} body h3{ font-weight: 300; margin-top: 10px; margin-bottom: 20px; font-style: italic; color: #555} body a{ color: #06f} .invoice-box{ max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); font-size: 16px; line-height: 24px; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; color: #555} .invoice-box table{ width: 100%; line-height: inherit; text-align: left; border-collapse: collapse} .invoice-box table td{ padding: 5px; vertical-align: top} .invoice-box table tr td:nth-child(2){ text-align: left} .invoice-box table tr.top table td{ padding-bottom: 20px} .invoice-box table tr.top table td.title{ font-size: 45px; line-height: 45px; color: #333} .invoice-box table tr.information table td{ padding-bottom: 40px} .invoice-box table tr.heading td{ background: #eee; border-bottom: 1px solid #ddd; font-weight: bold} .invoice-box table tr.details td{ padding-bottom: 20px} .invoice-box table tr.item td{ border-bottom: 1px solid #eee} .invoice-box table tr.item.last td{ border-bottom: none} .invoice-box table tr.total td:nth-child(2){ border-top: 2px solid #eee; font-weight: bold} @media only screen and (max-width: 600px){ .invoice-box table tr.top table td{ width: 100%; display: block; text-align: center} .invoice-box table tr.information table td{ width: 100%; display: block; text-align: center}}.bg-thm-yellow{background: #fad433} </style><body><div class='invoice-box'><table><tbody><tr class='top'><td colspan='2'><table><tbody><tr><td class='title'><img src='".base_url().SETTINGS_UPLOAD_PATH.$data['settings']->LOGO_IMAGE."' alt='Company logo' style='width: 100%; max-width: 300px'></td><td><h3>ImpactGuru Foundation</h3>$tada->office_address<br><b>Website :</b>$tada->website_url <br><b>Email ID :</b>$tada->office_email <br><b>Phone :</b>$tada->office_phone <br></td></tr></tbody></table></td></tr><tr class='information'><td colspan='2'><table><tbody><tr><td>Receipt : $tada->receipt <br>Mr/Mrs $tada->name $tada->address Mobile: $tada->mobile_number <br></td><td>Order Id: $tada->order_id <br>Payment Date: $tada->payment_date <br></td></tr></tbody></table></td></tr></tbody></table><table><tbody><tr class='heading bg-thm-yellow'><td>TAX EXEMPTION CERTIFICATE </td></tr><tr class='details'><td><h3>We truly appreciate your contribution to the cause of $tada->campaign</h3><p>This is to confirm that we have received a sum of Rs.$tada->amount.00 (Rupees Thirty Five Thousand Only ) from $tada->name having PAN $tada->pan_number through Direct Credit Receipt no. $tada->receipt. </p></td></tr></tbody></table><table><tbody><tr class='heading'><td>Support Towards</td><td></td></tr><tr class='item'><td>$tada->campaign</td><td>₹$tada->amount.00 </td></tr></tbody></table></div></body>"; 
        $mpdf->debug = true;
        // $stylesheet = '<style>'.file_get_contents('assets/css/bootstrap.min.css').'</style>';
        // $mpdf->WriteHTML($stylesheet,1);
        $html = "<style>
            .container{ width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto} @media (min-width:576px){ .container{ max-width: 540px}} @media (min-width:768px){ .container{ max-width: 720px}} @media (min-width:992px){ .container{ max-width: 960px}} @media (min-width:1200px){ .container{ max-width: 1200px}} .container-fluid,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl{ width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto} @media (min-width:576px){ .container, .container-sm{ max-width: 540px}} @media (min-width:768px){ .container, .container-md, .container-sm{ max-width: 720px}} @media (min-width:992px){ .container, .container-lg, .container-md, .container-sm{ max-width: 960px}} @media (min-width:1200px){ .container, .container-lg, .container-md, .container-sm, .container-xl{ max-width: 1200px}} .row{ display: -ms-flexbox; display: flex; -ms-flex-wrap: wrap; flex-wrap: wrap; margin-right: -15px; margin-left: -15px} .col,
            .col-1,
            .col-10,
            .col-11,
            .col-12,
            .col-2,
            .col-3,
            .col-4,
            .col-5,
            .col-6,
            .col-7,
            .col-8,
            .col-9,
            .col-auto,
            .col-lg,
            { position: relative; width: 100%; padding-right: 15px; padding-left: 15px} .col{ -ms-flex-preferred-size: 0; flex-basis: 0; -ms-flex-positive: 1; flex-grow: 1; min-width: 0; max-width: 100%} .col-12{ -ms-flex: 0 0 100%; flex: 0 0 100%; max-width: 100%}
            .display-3{ font-size: 4.5rem; font-weight: 300; line-height: 1.2} .display-4{ font-size: 2.0rem; font-weight: 300; line-height: 1.2}
            .text-center{ text-align: center !important} .text-left{text-align:left !important;}
            .w-100{ width: 100% !important}
            .d-flex{ display: -ms-flexbox !important; display: flex !important} .justify-content-between{ -ms-flex-pack: justify !important; justify-content: space-between !important} .mt-2,
            .my-2{ margin-top: .5rem !important}
            .mt-3,
            .my-3{ margin-top: 1rem !important}.col-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }td{padding-right: 20px;}.mx-auto{margin-left: auto;margin-right: auto;}.bg-secondary {
                background-color: #dce5ed !important
            }.py-3{padding-top: 2em;padding-bottom: 2em; }
            h1{ border-bottom: 0;}
           
                    </style>
                        <style> hr{border-top: 1px dashed !important;} .bg-thm-yellow{background: #fad433;} </style>
                    
                        
                <div class='container'>
                    <div class='row'>
                        <div class='col-12 text-center'>
                         <img src='".base_url()."assets/images/YFS-Logo.png' alt='Company logo' style='width: 80%; max-width: 250px;'>
                         <p><b>Jnanagiri, 75/76, 4th Cross, 2nd Main ,<br>
                         Soudamini Layout, Konankunte, Bangalore-560062<br>
                         PAN : AAATY3178K 
                         </b></p>
                         <p>+91-80-2632 2260  |  donations@youthforseva.org | www.youthforseva.org</p>
                         <hr>
                         <h1 class='display-4'>Donation Receipt</h1>
                         <table class='mx-auto'>
                            <tr><td style='text-align:right'>Name: </td><td >$tada->name</td></tr>
                            <tr><td style='text-align:right'>Programme: </td><td >$tada->campaign</td></tr>
                            <tr><td style='text-align:right'>Transactional Receipt: </td><td >$tada->receipt</td></tr>
                            <tr><td style='text-align:right'>Payment Order ID: </td><td >$tada->order_id</td></tr>
                            <tr><td style='text-align:right'>Payment Date: </td><td >$tada->payment_date</td></tr>
                            <tr><td style='text-align:right'>Tender: </td><td >Online Payment</td></tr>
                            <tr><td style='text-align:right'>Total Contribution Received: </td><td >$tada->amount</td></tr>
                             
                         </table>
                         <hr>
                         <p>Thank you for supporting us!</p>

                         <p>Please accept our sincere gratitude for your generous contribution towards Children Education. Your kindness will directly impact lives of the underprivileged children by supporting their education and enabling them to achieve their aspirations.</p>                        
                         <p>Together, we can educate children for a promising future!</p>  
                         <p>In service of the society,</p>
                         <p>Vidya Chetana</p>
                          
                            <hr class='border-lines'>
                            <p class='mt-1'>Note: DONATIONS TO THIS ORGANISATION ARE EXEMPTED U/S 80G OF IT ACT VIDE N0 Exempted u/80G vide.DIN.AAATY3178KF2021401 Dt.28-05-2021 Valid From AY 2022-23 to AY 2026-27</p>
                            <h4 class='mt-1'>Thank you once again!</h4>
                           <br>
                            <div class='bg-secondary py-2' >
                            <small class='mt-1'>For any query please call our toll free number: $tada->office_phone</small><br>
                                <small><b>Website :</b> $tada->website_url </small>
                                <small><b>Email ID :</b> $tada->office_email </small><br>
                                <small><b>Address :</b>  ".strip_tags($tada->office_address)." </small>
                                </div>
                        </div>
                      
                    </div>
                </div>";

                $mpdf->WriteHTML($html);
        //    $this->load->view($html);exit;
                $p = $mpdf->Output(INVOICE_PDF_PATH.$tada->receipt.'.pdf','F');
                return INVOICE_PDF_PATH.$tada->receipt.'.pdf';

}
public function inv(){
    $data = $this->data;
    $html = "<!DOCTYPE html>
    <!-- saved from url=(0058)https://sparksuite.github.io/simple-html-invoice-template/ -->
    <html lang='en'><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
            
   <style>
    
   .container{ width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto} @media (min-width:576px){ .container{ max-width: 540px}} @media (min-width:768px){ .container{ max-width: 720px}} @media (min-width:992px){ .container{ max-width: 960px}} @media (min-width:1200px){ .container{ max-width: 1200px}} .container-fluid,
   .container-lg,
   .container-md,
   .container-sm,
   .container-xl{ width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto} @media (min-width:576px){ .container, .container-sm{ max-width: 540px}} @media (min-width:768px){ .container, .container-md, .container-sm{ max-width: 720px}} @media (min-width:992px){ .container, .container-lg, .container-md, .container-sm{ max-width: 960px}} @media (min-width:1200px){ .container, .container-lg, .container-md, .container-sm, .container-xl{ max-width: 1200px}} .row{ display: -ms-flexbox; display: flex; -ms-flex-wrap: wrap; flex-wrap: wrap; margin-right: -15px; margin-left: -15px} .col,
   .col-1,
   .col-10,
   .col-11,
   .col-12,
   .col-2,
   .col-3,
   .col-4,
   .col-5,
   .col-6,
   .col-7,
   .col-8,
   .col-9,
   .col-auto,
   .col-lg,
   { position: relative; width: 100%; padding-right: 15px; padding-left: 15px} .col{ -ms-flex-preferred-size: 0; flex-basis: 0; -ms-flex-positive: 1; flex-grow: 1; min-width: 0; max-width: 100%} .col-12{ -ms-flex: 0 0 100%; flex: 0 0 100%; max-width: 100%}
   .display-3{ font-size: 4.5rem; font-weight: 300; line-height: 1.2} .display-4{ font-size: 3.5rem; font-weight: 300; line-height: 1.2}
   .text-center{ text-align: center !important}
   .w-100{ width: 100% !important}
   .d-flex{ display: -ms-flexbox !important; display: flex !important} .justify-content-between{ -ms-flex-pack: justify !important; justify-content: space-between !important} .mt-2,
   .my-2{ margin-top: .5rem !important}
   .mt-3,
   .my-3{ margin-top: 1rem !important}
           </style>
    
            <!-- Invoice styling -->
         <style> hr{border-top: 1px dashed !important;} table{
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;}  table td{
            padding: 5px;
            vertical-align: top;} table tr td:nth-child(2){
            text-align: right;}  table tr.top table td{
            padding-bottom: 20px;}  table tr.top table td.title{
            font-size: 45px;
            line-height: 45px;
            color: #333;}  table tr.information table td{
            padding-bottom: 40px;}  table tr.heading td{
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;}  table tr.details td{
            padding-bottom: 20px;} table tr.item td{
            border-bottom: 1px solid #eee;}  table tr.item.last td{
            border-bottom: none;}  table tr.total td:nth-child(2){
            border-top: 2px solid #eee;
            font-weight: bold;} @media only screen and (max-width: 600px){
            table tr.top table td{
            width: 100%;
            display: block;
            text-align: center;}  table tr.information table td{
            width: 100%;
            display: block;
            text-align: center;}}.bg-thm-yellow{background: #fad433;} </style>
        </head>
    
        <body>
           
            <div class='container'>
                <div class='row'>
                    <div class='col-12 text-center'>
                     <img src='".base_url().SETTINGS_UPLOAD_PATH.$data['settings']->LOGO_IMAGE."' alt='Company logo' style='width: 100%; max-width: 300px'>
                     <p>Jnanagiri, 75/76, 4th Cross, 2nd Main ,
                     Soudamini Layout, Konankunte, Bangalore-560062
                     PAN : AAATY3178K 
                     </p>
                     <p>+91-80-2632 2260  |  donations@youthforseva.org | www.youthforseva.org</p>


                     <h1 class='display-4'>Thank you for being AWESOME SELF!</h1>
                     <p>Your donation towards Impact Guru Foundation is successful. We appreciate the time and effort you have put in to help us in need.</p>
                        <hr class='border-lines'>
                        <h1 >Transaction Receipt</h1>
                        <div class=' w-100 d-flex justify-content-between'>
                            <div>Name</div>
                            <div>1st Jan 2022</div>
                        </div>
                        <div class=' w-100 d-flex justify-content-between'>
                            <div>Date</div>
                            <div>1st Jan 2022</div>
                        </div>
                        <div class=' w-100 d-flex justify-content-between'>
                            <div>Transactional Receipt Number</div>
                            <div>1st Jan 2022</div>
                        </div>
                        <div class=' w-100 d-flex justify-content-between'>
                            <div>Total Contribution Received</div>
                            <div>1st Jan 2022</div>
                        </div>
                        
                        <hr class='border-lines'>
                        <p class='mt-2'>The world needs more people like you. We hope you continue spreading kindness and love.</p>
                        <h4 class='mt-2'>Thank you once again!</h4>
                      
                        <br>

                        <small class='mt-3'>For any query please call our toll free number: 9901599015</small><br>
                            <small><b>Website :</b> $tada->website_url </small>
                            <small><b>Email ID :</b> $tada->office_email </small><br>
                            <small><b>Address :</b> $tada->office_phone </small>
                    </div>
                  
                </div>
            </div></body></html>";

    $this->load->view($html);
}

}