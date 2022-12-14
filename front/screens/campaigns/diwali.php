<style>
    .campaign-wrap img,
    .customer-logos img {
        width: 100% !important;
    }

    #donate-form{
        background: #ffd121
    }
</style>




<section class="contact-page pt-10">
    <div class="container">

        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="contact-page__left">


                    <div class="contact-page__contact-info">

                        <p>The most-awaited festival of lights is here. This year, as you prepare for the
                            celebrations, unlock the door to a prosperous future for meritorious
                            students.</p>

                        <p>Your <span style="color: #ea5638">#CharityOnDiwali</span> will enable deserving students to continue their
                            higher education and achieve their aspirations.</p>


                        <table class="table table-bordered text-center">
                            <tr>
                                <td><b style="color:#ea5638">PUC (10+2)</b> <br> ₹15,000/Student</td>
                                <td><b style="color:#ea5638">DEGREE</b> <br> ₹25,000/Student</td>
                            </tr>
                            <tr>
                                <td><b style="color:#ea5638">ENGINEERING</b> <br> ₹50,000/Student</td>
                                <td><b style="color:#ea5638">MEDICAL</b> <br> ₹50,000/Student</td>

                            </tr>
                        </table>
                        <p>This is how your <span style="color: #ea5638">#CharityOnDiwali</span> will impact lives of students.</p>
                        <p>Apart from education, they will also benefit from our guidance and
                            training programmes such as:</p>
                        <ul>
                            <li>Admission guidance for college and course selection</li>
                            <li>Career guidance sessions &amp; soft skills workshop</li>
                            <li>Training on 21 st  century skills</li>
                            <li>Mentorship programmes to mould them into responsible citizens through residential camps, value inculcating workshops etc.</li>
                            <li>Employability Readiness Programme (for final year students)</li>
                        </ul>
                        <p>In return for your <span style="color: #ea5638">#CharityOnDiwali</span>, you will get,</p>
                        <ul>
                            <li>Regular updates on the progress of the student you have sponsored</li>
                            <li>Virtual/physical meetings or communication exchange with the
                                student via us.</li>
                            <li>Donation receipt and 80G tax exemption certificate for your donated
                                amount.</li>

                        </ul>

                        <div class="col-sm-12">
                            <div class="section-title text-center">

                                <h3 class="mt-40" style="color: #ea5638">This Diwali, empower students to shape their future.</h3>

                            </div>
                        </div>


                    </div>
                </div>
            </div>


            <div class="col-xl-6 col-lg-6 order-first order-md-2">
                <div class="contact-page__form helping-one__right-form">
                    <form name="donate-form" action="<?php echo base_url(); ?>diwali" class="contact-page__main-form " id="donate-form" method="post" enctype="multipart/form-data">
                        <h3 class="text-center section-title__tagline">Gift the light of education</h3>
                        <!-- <p class="text-center">Education has the power to break the vicious poverty-illiteracy cycle.</p> -->
                        <input id="currency" type="hidden" name="currency" value="INR">
                        <!-- <input type="hidden" name="citizen" value="indian"> -->
                        <input type="hidden" name="table_name" value="payments">
                        <input type="hidden" name="programme" value="diwali">
                        <input type="hidden" name="sem" value="<?php echo !empty($this->input->get('sem')) ? $this->input->get('sem') : '' ?>">
                        <!-- <p class="text-center">You can send us a message through the below form <br>and we will get in touch with you.</p> -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-page__input-box">
                                    <div class="form-group d-flex flex-wrap form-control p-20 border-0 mb-2">

                                        <div class="form-check d-flex mt-2">
                                            <label class="d-flex "><b>Citizen :</b></label>
                                        </div>
                                        <div class="form-check d-flex mt-2">
                                            <input class="form-check-input ml-10" type="radio" checked id="indian" value="indian" name="citizen">
                                            <label class="form-check-label pl-10" for="indian"> Indian</label> &nbsp;
                                        </div>
                                        <div class="form-check d-flex mt-2">
                                            <input class="form-check-input ml-10" type="radio" id="foreign" name="citizen" value="foreign" onclick="load_countries()">
                                            <label class="form-check-label pl-10" for="foreign"> Foreign</label> &nbsp;
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="indian-block">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="contact-page__input-box">
                                        <div class="form-group d-flex flex-wrap form-control p-20 border-0 mb-2">
                                            <div class="form-check d-flex mt-2">
                                                <input class="form-check-input ml-10" type="radio" checked id="one" name="radioamount" value="2000" onclick="get_amount(this.value)">
                                                <label class="form-check-label pl-10" for="one"> ₹2000</label> &nbsp;
                                            </div>
                                            <div class="form-check d-flex mt-2">
                                                <input class="form-check-input ml-10" type="radio" id="two" name="radioamount" value="5000" onclick="get_amount(this.value)">
                                                <label class="form-check-label pl-10" for="two"> ₹5000</label> &nbsp;
                                            </div>
                                            <div class="form-check d-flex mt-2">
                                                <input class="form-check-input ml-10" type="radio" id="three" name="radioamount" value="10000" onclick="get_amount(this.value)">
                                                <label class="form-check-label pl-10" for="three"> ₹10000</label> &nbsp;
                                            </div>
                                            <div class="form-check d-flex mt-2">
                                                <input class="form-check-input ml-10" type="radio" id="five" name="radioamount" value="15000" onclick="get_amount(this.value)">
                                                <label class="form-check-label pl-10" for="five"> ₹15000</label> &nbsp;
                                            </div>
                                            <div class="form-check d-flex mt-2">
                                                <input class="form-check-input ml-10" type="radio" id="seven" name="radioamount" value="25000" onclick="get_amount(this.value)">
                                                <label class="form-check-label pl-10" for="seven"> ₹25000</label> &nbsp;
                                            </div>

                                            <div class="form-check d-flex mt-2">
                                                <input class="form-check-input ml-10" type="radio" id="other" name="radioamount">
                                                <label class="form-check-label pl-10" for="other"> Custom amount</label> &nbsp;
                                                <div class="invalid-feedback">Amount field cannot be blank!</div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-lg-12">
                                <div class="helping-one__right-input-box">
                                    <input class="form-control" type="text" name="amount" placeholder="Other amount*" id="amount" value="2000">
                                    <div class="helping-one__right-dolar-icon">
                                        <span>&#8377; </span>
                                    </div>
                                </div>
                            </div>


                            <div class="row" id="indian-hide" style="display:none">
                                <div class="col-md-4">
                                    <label>Payable Amount in &nbsp;</label><label id="currency_code_text">INR</label>
                                </div>
                                <div class="col-xl-8">
                                    <div class="contact-page__input-box">
                                        <input class="form-control" type="text" name="payble_amount" placeholder="" id="payble_amount" value="1000" readonly>
                                        <div class="invalid-feedback">Full name field cannot be blank!</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="countries"></div>
                            <!-- <div class="row">
                            <div class="col-lg-12">
                                <div class="helping-one__right-input-box">
                                    <label for="conv-amount">Conversion Amount</label>
                                    <input class="form-control" type="text" name="amount" placeholder="Other amount*" id="amount">
                                    <div class="helping-one__right-dolar-icon">
                                        <span>&#8377; </span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="contact-page__input-box">
                                        <input class="form-control" type="text" name="name" placeholder="Full Name*" id="name">
                                        <div class="invalid-feedback">Full name field cannot be blank!</div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="contact-page__input-box">
                                        <input class="form-control" id="mobile_number" type="text" name="mobile_number" placeholder="Mobile Number*">
                                        <div class="invalid-feedback">Mobile Number field cannot be blank!</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="contact-page__input-box">
                                        <input class="form-control" type="email" name="email" placeholder="Email*" id="email">
                                        <div class="invalid-feedback">Email field cannot be blank!</div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="contact-page__input-box">
                                        <input class="form-control" type="text" name="pan" placeholder="Pan Number*" id="pan">
                                        <div class="invalid-feedback">Pan Number field cannot be blank!</div>
                                    </div>

                                </div>
                            </div>
                            <div class="row" id="country">

                            </div>

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="contact-page__input-box">
                                        <input class="form-control" type="text" name="city" placeholder="City">
                                        <div class="invalid-feedback">City field cannot be blank!</div>
                                    </div>
                                </div>

                                <div class="col-xl-4 mx-auto my-2">

                                    <button id="submit_form" type="submit" class="thm-btn contact-page__btn "><i class="fas fa-arrow-circle-right"></i>Donate Now</button>
                                </div>
                                <p class="text-center">Avail tax exemption under Section 80G</p>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="container-fluid mt-5 m">
    <div class="row">
        <div class="col-md-6 col-lg-3 our-kitchen-three" style="background:url(assets/images/backgrounds/student_puc.jpg);">
            <a class="mx-auto">
                <div class="three-boxes__text-box three-kitchen-boxes ">
                    <h2 class="">Sponsor a PUC Student</h2>
                    <!-- <p class="three-boxes__text">To optimize cooking time and preserve the maximum nutrition</p> -->

                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3 our-kitchen-three" style="background:url(assets/images/backgrounds/student_degree.jpg);">
            <a class="mx-auto">
                <div class="three-boxes__text-box three-kitchen-boxes ">
                    <h2 class="">Sponsor a Degree Student</h2>
                    <!-- <p class="three-boxes__text">To optimize cooking time and preserve the maximum nutrition</p> -->

                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3  our-kitchen-three" style="background:url(assets/images/backgrounds/student_engineering.jpg);">
            <a class="mx-auto">
                <div class="three-boxes__text-box three-kitchen-boxes ">
                    <h2 class="">Sponsor an Engineering Student</h2>
                    <!-- <p class="three-boxes__text">Daily fresh ingredients are processed with minimal contact</p> -->

                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3  our-kitchen-three" style="background:url(assets/images/backgrounds/student_medicine.jpg);">
            <a class="mx-auto">
                <div class="three-boxes__text-box three-kitchen-boxes ">
                    <h2 class="">Sponsor a Medical Student</h2>
                    <!-- <p class="three-boxes__text">Hot & fresh meals delivered to each distribution point</p> -->

                </div>
            </a>
        </div>
    </div>
</section>


<!-- <section class="testimonial-one about-page-testimonial">
    <div class="testimonial-one-bg" style="background-image: url(assets/images/backgrounds/testimonial-1-bg.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <div class="testimonial-one__left">
                    <div class="section-title text-left">
                        <span class="section-title__tagline">SUCCESS STORIES</span>
                        <h2 class="section-title__title">They identified with our vision and partnered with us to make it a reality.</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="testimonial-one__right">
                    <div class="testimonial-one__carousel owl-theme owl-carousel">
                        Testimonial One Single
                        <div class="testimonial-one__single">
                            <p class="testimonial-one__text">I am Sahana , studying final year BTech in Presidency University, Bangalore. I come from an economically backward family. We are two siblings and my father has been bed ridden since 6 years. My mother is a teacher in a private school and is the sole earning members in our family. When I secured a seat in BTech, I had no means to support myself to take up the course, considering our financial status. Youth For Seva helped me to pursue my education by providing financial and mentoring support. I recently secured a placement in IBM, Bangalore. I am extremely grateful to Youth for Seva , Vidya Chetana for the invaluable assistance to help me to achieve my goal.</p>
                            <div class="testimonial-one__client-info">
                                <div class="testimonial-one__client-img">
                                    <img src="assets/images/testimonial/sahana_pic.jpg" alt="">
                                    <div class="testimonial-one__quote">

                                    </div>
                                </div>
                                <div class="testimonial-one__client-name">
                                    <h3>Sahana</h3>
                                  
                                </div>
                            </div>
                        </div>
                      
                        <div class="testimonial-one__single">
                            <p class="testimonial-one__text">I am Yathish from a village near Tumkur, Karnataka . I have completed BE (Mechanical ) from R V College of Engineering.Bangalore. My father has health issues. We live on the pension money of my father given by the Karnataka state government. I did my diploma after 10th std, I received a Vidya Chetana scholarship to continue my Engineering Degree .I have completed my Engineering with 6.8GPA, got placement in DXA technology. I am very thankful to the team for supporting my education.</p>
                            <div class="testimonial-one__client-info">
                                <div class="testimonial-one__client-img">
                                    <img src="assets/images/testimonial/yathish_photo.jpg" alt="">
                                    <div class="testimonial-one__quote">

                                    </div>
                                </div>
                                <div class="testimonial-one__client-name">
                                    <h3>Yathish</h3>
                                  
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->



<div class="col-sm-12 col-md-12 mx-auto">
    <!--<div class="form-body">-->
    <div class="row">
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <!--                    <h3 class="text-center">Akshayachaitanya Donation Page</h3>-->
                    <!--                    <h4>Select any payment gateway to complete payment.</h4>-->

                    <form id="razorpay-form" action="<?php echo base_url(); ?>campaigns/save_payment/<?php echo $insert_id . '/' . $table_name; ?>" method="POST">
                        <script type="text/javascript" src="https://checkout.razorpay.com/v1/checkout.js" data-buttontext="" data-key="<?php echo $key; ?>" data-amount="<?php echo $amount; ?>" data-currency="INR" data-name="<?php echo $name ?>" data-image="<?php echo $image ?>" data-description="<?php echo $description ?>" data-prefill.name="<?php echo $prefill['name'] ?>" data-prefill.email="<?php echo $prefill['email'] ?>" data-prefill.contact="<?php echo $prefill['contact'] ?>" data-prefill.pan="<?php echo $prefill['pan'] ?>" data-notes.pan="<?php echo $prefill['pan'] ?>" data-notes.shopping_order_id="<?php echo $notes['merchant_order_id']; ?> " data-modal.confirm_close='true' data-modal.ondismiss="this.modal_close()" <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $display_amount ?>" <?php } ?> <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $display_currency ?>" <?php } ?> data-redirect='false' data-callback_url="<?php echo base_url(); ?>campaigns/save_payment/<?php echo $insert_id . '/' . $table_name; ?>">


                        </script>

                        <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                        <input type="hidden" name="receipt" value="<?php echo $notes['merchant_order_id']; ?>">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        <input type="hidden" name="name" value="<?php echo $prefill['name']  ?>">
                        <input type="hidden" name="email" value="<?php echo  $prefill['email'] ?>">
                        <input type="hidden" name="mobile_number" value="<?php echo $prefill['contact']; ?>">
                        <input type="hidden" name="city" value="<?php echo $notes['city']; ?>">
                        <input type="hidden" name="pan" value="<?php echo $prefill['pan']; ?>">
                        <input type="hidden" name="dob" value="<?php echo $prefill['dob']; ?>">
                        <input type="hidden" name="citizen" value="<?php echo $prefill['citizen']; ?>">
                        <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                        <input type="hidden" name="insert_id" value="<?php echo $insert_id; ?>">
                        <input type="hidden" name="programme" value="<?php echo $programme; ?>">

                    </form>


                </div>
            </div>
        </div>
        <!--</div>-->
    </div>




    <script type="text/javascript">
        window.onload = function() {

            var button = document.getElementById('clickButton');
            <?php if (!empty($key) && !empty($amount)) { ?>
                $('#razorpay-form').submit();
            <?php } ?>
            $('#modal-close').on('click', function() {

                //  window.location.replace("donate");
                window.location.href = 'sponsor-a-child';

            });


        }


        $(".number").keydown(function(event) {
            k = event.which;

            if ((k >= 48 && k <= 57) || k == 8) {

                return true

            } else {
                event.preventDefault();
                return false;
            }


        })

        function modal_close() {
            window.location.href = 'diwali';
        }
    </script>





    <script type="text/javascript">
        function load_countries() {
            var countries = '<div class="row" ><div class="col-xl-12"> <div class="contact-page__input-box"><div class="form-group d-flex flex-wrap form-control p-20 border-0 mb-2"><div class="form-check d-flex mt-2"><label class="d-flex "><b>Country Currency Code:</b></label></div><div class="form-check d-flex mt-2">';
            countries += '<select id="from_currency" class="form-control" onchange="set_currency(this.value)"><option value="USD">USD</option><option value="EUR">EUR</option><option value="GBP">GBP</option><option value="SGD">SGD</option><option value="CAD">CAD</option><option value="CNY">CNY</option><option value="SEK">SEK</option><option value="SEK">SEK</option><option value="MXN">MXN</option><option value="HKD">HKD</option><option value="NOK">NOK</option><option value="RUB">RUB</option><option value="ALL">ALL</option><option value="AMD">AMD</option><option value="ARS">ARS</option><option value="AWG">AWG</option><option value="BBD">BBD</option><option value="BDT">BDT</option><option value="BMD" >BMD</option><option value="BND">BND</option><option value="BOB">BOB</option><option value="GIP">GIP</option><option value="LKR">LKR</option><option value="MNT">MNT</option><option value="GHS">GHS</option><option value="ZAR">ZAR</option><option value="NOK">NOK</option><option value="NZD">NZD</option><option value="PAB">PAB</option><option value="PEN">PEN</option><option value="PHP">PHP</option><option value="PKR">PKR</option><option value="PLN">PLN</option><option value="PYG">PYG</option><option value="RON">RON</option><option value="RUB">RUB</option><option value="SAR">SAR</option><option value="SEK">SEK</option><option value="SGD">SGD</option><option value="THB">THB</option><option value="TRY">TRY</option><option value="TWD">TWD</option><option value="UAH">UAH</option><option value="USD" selected>USD</option><option value="UYU">UYU</option><option value="VND">VND</option><option value="YER">YER</option></select></div></div></div</div></div>';
            $('#pan').parent().addClass('d-none');
            $('#pan').val('----');
            $('#countries').html(countries);
            var country = '<div class="col-xl-12"><div class="contact-page__input-box"><input class="form-control" type="text" name="country" placeholder="Country" required><div class="invalid-feedback">City field cannot be blank!</div></div></div>';

            $('#country').html(country);
            $('#indian-hide').attr('style', false);
            $('#pan').attr('required', false);
        }
        $('#indian').click(function() {
            $('#countries').html('');
            $('#country').html('');
            $('#pan').parent().removeClass('d-none');
            $('#pan').val('');
            $('#indian-hide').css('display', 'none');
            $('#pan').attr('required', true);
        })

        function set_currency(value) {
            $('#currency').val(value);
            $('#currency_code_text').html(value);
            get_amount($('#amount').val())
        }

        function get_amount(amount) {

            var currency = $('#currency').val();
            $.ajax({
                url: "campaigns/currency_convert/" + amount + "/" + currency,
                success: function(data) {
                    $('#payble_amount').val(data);
                }
            })
            // $.getJSON("campaigns/currency_convert/"+amount+"/"+currency, function(data){
            // console.log(data);
            // });
        }


        var selection;
        $(document).ready(function() {

            $("#donate-form").validate({
                // Specify validation rules

                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    name: "required",
                    email: {
                        required: true,
                        // Specify that email should be validated
                        // by the built-in "email" rule
                        email: true
                    },
                    mobile_number: {
                        required: true,
                        minlength: 10,
                        maxlength: 12
                    },
                    pan: {
                        required: true
                    },
                    amount: {
                        required: true
                    },
                    // payble_amount: required
                },
                // Specify validation error messages
                messages: {
                    name: "Please enter your firstname",
                    mobile_number: {
                        required: "Please provide a mobile_number",
                        minlength: "Your mobile number must be at least 10 characters long",
                        maxlength: "Your mobile number must not be more than 12 characters length"
                    },
                    email: "Please enter a valid email address",
                    pan: "please enter pan number",
                    amount: "Please enter amount",
                    payble_amount: "Please enter amount"
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form) {
                    var amount = $('#amount').val();
                    if (amount == '' || amount < 1000) {
                        alert('Amount cannot be less than ₹1000')
                    } else {
                        form.submit();
                    }
                }
            });


        });








        $('#one').on('click', function() {
            $('#one, #two, #three, #five, #seven, #thousand, #fifteen, #twenty ').removeAttr('checked');
            $('#amount').val('2000');
            $('#one').attr('checked', true);



        })
        $('#two').on('click', function() {
            $('#one, #two, #three, #five, #seven, #thousand, #fifteen, #twenty ').removeAttr('ckecked');
            $('#amount').val('5000');
            $('#two').attr('checked', true);

        })
        $('#three').on('click', function() {
            $('#one, #two, #three, #five, #seven, #thousand, #fifteen, #twenty ').removeAttr('checked');
            $('#amount').val('10000');
            $('#three').attr('checked', true);

        })
        $('#five').on('click', function() {
            $('#one, #two, #three, #five, #seven, #thousand, #fifteen, #twenty ').attr('checked', false);
            $('#amount').val('15000');
            $('#five').attr('checked', true);

        })

        $('#seven').on('click', function() {
            $('#one, #two, #three, #five, #seven, #thousand, #fifteen, #twenty ').attr('checked', false);
            $('#amount').val('25000');
            $('#seven').attr('checked', true);

        })

        $('#other').on('click', function() {
            var amount = $('#other').val()
            $('#one, #two, #three, #five, #seven, #thousand, #fifteen, #twenty ').attr('checked', false);
            // $('#amount').val(amount);
            $('#other').attr('checked', true);

        })

        $('#amount').keyup(function() {
            var quantity = $('#amount').val();
            $('#other').val(quantity);
            // $('#other').html(quantity * 100);
            $('#other').attr('checked', true);

        })


        // It has the name attribute "registration"


        $('.customer-logos').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            arrows: false,
            dots: false,
            pauseOnHover: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 4
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 2
                }
            }]
        });





        //         function indianblock(){
        //             var indianblock = '<div class="row">';
        //                 indianblock += '<div class="col-xl-12">';
        //                                         indianblock += '<div class="contact-page__input-box"><div class="form-group d-flex flex-wrap form-control p-20 border-0 mb-2">';
        //                                             indianblock += '<div class="form-check d-flex mt-2">';
        //                                                 indianblock += '<input class="form-check-input ml-10" type="radio" checked id="one" name="radioamount">';
        //                                                 indianblock += '<label class="form-check-label pl-10" for="one"> ₹1000</label> &nbsp;';
        //                                             indianblock += '</div>';
        //                                             indianblock += '<div class="form-check d-flex mt-2">';
        //                                                 indianblock += '<input class="form-check-input ml-10" type="radio" id="two" name="radioamount">';
        //                                                 indianblock += '<label class="form-check-label pl-10" for="two"> ₹2000</label> &nbsp;';
        //                                             indianblock += '</div>';
        //                                             indianblock += '<div class="form-check d-flex mt-2">';
        //                                                 indianblock += '<input class="form-check-input ml-10" type="radio" id="three" name="radioamount">';
        //                                                 indianblock += '<label class="form-check-label pl-10" for="three"> ₹5000</label> &nbsp;';
        //                                             indianblock += '</div>';
        //                                             indianblock += '<div class="form-check d-flex mt-2">';
        //                                                 indianblock += '<input class="form-check-input ml-10" type="radio" id="five" name="radioamount">';
        //                                                 indianblock += '<label class="form-check-label pl-10" for="five"> ₹10000</label> &nbsp;';
        //                                             indianblock += '</div>';
        //                                             indianblock += '<div class="form-check d-flex mt-2">';
        //                                                 indianblock += '<input class="form-check-input ml-10" type="radio" id="seven" name="radioamount">';
        //                                                 indianblock += '<label class="form-check-label pl-10" for="seven"> ₹15000</label> &nbsp;';
        //                                             indianblock += '</div>';

        //                                             indianblock += '<div class="form-check d-flex mt-2">';
        //                                                 indianblock += '<input class="form-check-input ml-10" type="radio" id="other" name="radioamount">';
        //                                                 indianblock += '<label class="form-check-label pl-10" for="other"> Custom amount</label> &nbsp;';
        //                                                 indianblock += '<div class="invalid-feedback">Amount field cannot be blank!</div>';
        //                                             indianblock += '</div>';
        //                                         indianblock += '</div>';
        //                                     indianblock += '</div>';
        //                                 indianblock += '</div>';
        //                             indianblock += '</div>';
        //             $('#indian-block').html(indianblock);

        //         }
        // indianblock();
        //         function foreignblock(){
        //             var indianblock = '<div class="row">';
        //                 indianblock += '<div class="col-xl-12">';
        //                                         indianblock += '<div class="contact-page__input-box"><div class="form-group d-flex flex-wrap form-control p-20 border-0 mb-2">';
        //                                             indianblock += '<div class="form-check d-flex mt-2">';
        //                                                 indianblock += '<input class="form-check-input ml-10" type="radio" checked id="one" name="radioamount">';
        //                                                 indianblock += '<label class="form-check-label pl-10" for="one"> $14</label> &nbsp;';
        //                                             indianblock += '</div>';
        //                                             indianblock += '<div class="form-check d-flex mt-2">';
        //                                                 indianblock += '<input class="form-check-input ml-10" type="radio" id="two" name="radioamount">';
        //                                                 indianblock += '<label class="form-check-label pl-10" for="two"> ₹27</label> &nbsp;';
        //                                             indianblock += '</div>';
        //                                             indianblock += '<div class="form-check d-flex mt-2">';
        //                                                 indianblock += '<input class="form-check-input ml-10" type="radio" id="three" name="radioamount">';
        //                                                 indianblock += '<label class="form-check-label pl-10" for="three"> ₹5000</label> &nbsp;';
        //                                             indianblock += '</div>';
        //                                             indianblock += '<div class="form-check d-flex mt-2">';
        //                                                 indianblock += '<input class="form-check-input ml-10" type="radio" id="five" name="radioamount">';
        //                                                 indianblock += '<label class="form-check-label pl-10" for="five"> ₹10000</label> &nbsp;';
        //                                             indianblock += '</div>';
        //                                             indianblock += '<div class="form-check d-flex mt-2">';
        //                                                 indianblock += '<input class="form-check-input ml-10" type="radio" id="seven" name="radioamount">';
        //                                                 indianblock += '<label class="form-check-label pl-10" for="seven"> ₹15000</label> &nbsp;';
        //                                             indianblock += '</div>';

        //                                             indianblock += '<div class="form-check d-flex mt-2">';
        //                                                 indianblock += '<input class="form-check-input ml-10" type="radio" id="other" name="radioamount">';
        //                                                 indianblock += '<label class="form-check-label pl-10" for="other"> Custom amount</label> &nbsp;';
        //                                                 indianblock += '<div class="invalid-feedback">Amount field cannot be blank!</div>';
        //                                             indianblock += '</div>';
        //                                         indianblock += '</div>';
        //                                     indianblock += '</div>';
        //                                 indianblock += '</div>';
        //                             indianblock += '</div>';
        //             $('#indian-block').html(indianblock);
        //         }
    </script>