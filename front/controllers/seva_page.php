<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    require_once 'vendor/autoload.php';
class Seva_Page extends MY_Controller {
    public $class_name;
    public $api;
    function __construct() {
        parent::__construct();
        $this->class_name = strtolower(get_class());
       
      
       
        // $this->load->model('master_model');
    }

   
    public function index($slug) {
        
        $template_path = $this->sevaspagewisecontent($slug);
        $data = $this->data;
        $data['page_heading'] = 'Seva Page';
        $data['breadcrumb'] = '<span><a href="">Home</a> - </span> <span><a href="'.$this->class_name .'">'.ucfirst($this->class_name).'</a> - </span>Seva Page';
        $data['scripts'] = array('assets/javascripts/seva_page.js');
        $this->load->view($template_path, $data);
    
    }

    public function save_donation(){
        $this->seva_page_model->data['full_name'] = $full_name = $this->input->post('full_name');
        $this->seva_page_model->data['phone_number'] = $phone_number = $this->input->post('phone_number');
        $this->seva_page_model->data['email'] = $email = $this->input->post('email');
        $this->seva_page_model->data['pan_number'] = $pan_number = $this->input->post('pan_number');
        $this->seva_page_model->data['city'] = $city = $this->input->post('city');
        $this->seva_page_model->data['amount'] = $amount = $this->input->post('amount');
        $this->seva_page_model->data['seva_name'] = $seva_name = $this->input->post('seva_name');
        
        $response = json_decode($this->instamojo_Authentication());
        $this->seva_page_model->data['access_token'] = $seva_name = $this->input->post('access_token');
      
     
    //   print_R($response->access_token);exit;
      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/v2/payment_requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer '.$response->access_token.''));

        $payload = Array(
            'purpose' => $seva_name,
            'amount' => $amount,
            'buyer_name' => $full_name,
            'email' => $email,
            'phone' => $phone_number,
            'redirect_url' => "http://6ae0-2405-201-c035-b0be-3413-a62-6151-4aca.ngrok.io/neat_ci/seva_page/thank_you/$response->access_token/",
            'send_email' => 'True',
            'send_sms' => 'True',
            'webhook' => ' http://6ae0-2405-201-c035-b0be-3413-a62-6151-4aca.ngrok.io/neat_ci/seva_page/webhook',
            'allow_repeated_payments' => 'False',
        );
    
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $create_payment_request = curl_exec($ch);
        curl_close($ch);  
        $payment_request = json_decode($create_payment_request);
        if($this->seva_page_model->insert('seva_offerings')){
            header("Location: $payment_request->longurl");
            exit;
        }
      
        

    }


    public function instamojo_Authentication(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/oauth2/token/');     
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $payload = Array(
            'grant_type' => 'client_credentials',
            'client_id' => INSTAMOO_CLIENT_ID,
            'client_secret' => INSTAMOO_SECRET_KEY
        );

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch); 

        return $response;
    }

    public function thank_you($access_token){
        $this->seva_page_model->data['payment_id'] = $payment_id = $this->input->get('payment_id');
        $this->seva_page_model->data['payment_status'] = $payment_status = $this->input->get('payment_status');
        $this->seva_page_model->data['payment_request_id'] = $payment_request_id = $this->input->get('payment_request_id');
        $this->seva_page_model->primary_key = array('access_token'=>$access_token);
        print_R($access_token);
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
            .text-center{ text-align: center !important}
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
                    </style>
                        <style> hr{border-top: 1px dashed !important;} .bg-thm-yellow{background: #fad433;} </style>
                    
                        
                <div class='container'>
                    <div class='row'>
                        <div class='col-12 text-center'>
                         <img src='".base_url().SETTINGS_UPLOAD_PATH.$data['settings']->LOGO_IMAGE."' alt='Company logo' style='width: 80%; max-width: 250px; margin-bottom: 30px;'>
                         <h1 class='display-4'>Thank you for being AWESOME SELF!</h1>
                         <p>Your donation towards Each One Educate One is successful. We appreciate the time and effort you have put in to help us in need.</p>
                            <hr class='border-lines'>
                            <h1 >Transaction Receipt</h1>
                            <table class='mx-auto'>
                                <tr><td style='text-align:right'>Name: </td><td >$tada->name</td></tr>
                                <tr><td style='text-align:right'>Email: </td><td >$tada->email</td></tr>
                                <tr><td style='text-align:right'>Pan Number: </td><td >$tada->pan_number</td></tr>
                                <tr><td style='text-align:right'>Payment Date: </td><td >$tada->payment_date</td></tr>
                                <tr><td style='text-align:right'>Transactional Receipt: </td><td >$tada->receipt</td></tr>
                                <tr><td style='text-align:right'>Total Contribution Received: </td><td >$tada->amount</td></tr>
                            </table>
                         
                            <hr class='border-lines'>
                            <p class='mt-2'>The world needs more people like you. We hope you continue spreading kindness and love.</p>
                            <h4 class='mt-2'>Thank you once again!</h4>
                           <br>
                            <div class='bg-secondary py-3' >
                            <small class='mt-3'>For any query please call our toll free number: $tada->office_phone</small><br>
                                <small><b>Pan Number :</b> DSOPK2922K</small>
                                <small><b>Website :</b> $tada->website_url </small>
                                <small><b>Email ID :</b> $tada->office_email </small><br>
                                <small><b>Address :</b>  $tada->office_address </small>
                                </div>
                        </div>
                      
                    </div>
                </div>";

                $mpdf->WriteHTML($html);
           $this->load->view($html);exit;
                $p = $mpdf->Output(INVOICE_PDF_PATH.$tada->receipt.'.pdf','F');
                return INVOICE_PDF_PATH.$tada->receipt.'.pdf';

}
}