@extends('master')
@section('title', 'Booking')
@section('main')
    <!-- start Main Wrapper -->
    <div class="main-wrapper scrollspy-container">

        <!-- start hero-header -->
        <div class="hero img-bg-01 in-banner">
            <div class="container">

                <div class="wrap-content">

                    <h1><span>Cylinder Booking</span></h1>
                    <p>&nbsp;</p>
                </div>

                <div class="breadcrumb">
                    <div class="container">
                        <ol>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('/cylinders')}}">Cylinders</a></li>
                            <li class="active">Booking</li>
                        </ol>
                    </div>
                </div>

            </div>
            <div class="overlay"></div>
        </div>
        <!-- end hero-header -->

        <section class="main-content">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 col-sm-8" @guest id="payment-div" @endguest>
                        @guest
                            <div class="payment-content guest-div">
                                <div class="payment-traveller">
                                    <div class="row">
                                        <div class="col-sm-12 form-horizontal">
                                            <div class="form-group">
                                                <div class="text-center" style="padding: 20px 5px;">
                                                    <a style="margin-right: 40px" data-toggle="modal" class="btn btn-primary" href="#loginModal"><i class="fa fa-user" data-toggle="tooltip" data-placement="bottom" title="login"></i> Log In</a>
                                                    <a data-toggle="modal" class="btn btn-primary" href="#registerModal"><i class="fa fa-user-plus" data-toggle="tooltip" data-placement="bottom" title="Register"></i> Register</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end payment-content -->
                        @endguest
                        <form method="POST" id="payment-page-form" action="{{url('booking/'.$cylinder->id)}}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$cylinder->id}}" name="cylinder_id">

                            <h3 class="section-title">Personal Details</h3>

                            <div class="payment-content">

                                <div class="payment-traveller">

                                    <div class="row">

                                        <div class="col-sm-6 form-horizontal">
                                            <div class="form-group">
                                                <label class="control-label">Name:</label>
                                                <div>
                                                    <input readonly required type="text" name="name" class="form-control" value="{{$user->name}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 form-horizontal">
                                            <div class="form-group">
                                                <label class="control-label">Email:</label>
                                                <div>
                                                    <input readonly required type="email" name="email" class="form-control" value="{{$user->email}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 form-horizontal">
                                            <div class="form-group">
                                                <label class="control-label">Phone:</label>
                                                <div>
                                                    <input type="text" required name="mobile_no" class="form-control" value="{{$user->mobile_no}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 form-horizontal">
                                            <div class="form-group">
                                                <label class="control-label">Address:</label>
                                                <div>
                                                    <select required class="selectpicker show-tick form-control" name="address" data-live-search="false">
                                                        <option value="">Select address</option>
                                                        <option {{$user->address=='Kicukiro'?'selected':''}} value="Kicukiro">Kicukiro</option>
                                                        <option {{$user->address=='Nyarugenge'?'selected':''}} value="Nyarugenge">Nyarugenge</option>
                                                        <option {{$user->address=='Gasabo'?'selected':''}} value="Gasabo">Gasabo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div><!-- end payment-content -->

                            <div class="payment-content billingone">

                                <h3 class="section-title">Billing Address</h3>
                                <div class="row">
                                    <div class="form-horizontal col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Address line 2:</label>
                                            <div>
                                                <input type="text" name="address_2" class="form-control" value="{{$user->address_2}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-horizontal col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Sector/Cell:</label>
                                            <div>
                                                <input name="sector" type="text" class="form-control" value="{{$user->sector}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-horizontal col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Street number:</label>
                                            <div>
                                                <input name="street" type="text" class="form-control" value="{{$user->street}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-horizontal col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">House Number:</label>
                                            <div>
                                                <input name="house" type="text" class="form-control" value="{{$user->house}}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- end payment-content billingone -->

                            <div class="payment-content">

                                <h3 class="section-title">Finish Payment</h3>

                                <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> After payment, we will deliver your cylinder at your home.</div>

                                <div id="paymentOption" class="payment-option-wrapper">

                                    <div class="row">

                                        <div class="col-sm-12">

                                            <div class="radio-block">
                                                <input id="payments1" name="payments" type="radio" class="radio payments_all" value="CreditCard"/>
                                                <label class="" for="payments1"><span>Credit Card</span> <img src="/assets/images/payment-credit-cards.png" alt="Image"></label>
                                            </div>

                                            <div id="CreditCard" style="padding: 20px; outline: 2px solid #fe8800" class="payment-option-form">

                                                <div class="inner">

                                                    <h5 class="">Total Payment: {{$cylinder->price}}</h5>
                                                    <h5 class="">Pay to {{$cylinder->user->name}}</h5>
                                                    <p>Additional charges may apply</p>

                                                    <div class="form-horizontal">

                                                    </div>

                                                    <?php
                                                    $publishable_key = 'pk_test_ZKdXB0CNTDDIMe0IYE9zpI2R00QLAf090S';
                                                    $plugin_name = 'Kigali Gas Booking System';
                                                    $plugin_image_url = asset('assets/images/gas-cyl.png');
                                                    $plugin_price = intval($cylinder->price);
                                                    ?>
                                                    <input id="stripe_pay_button" type="submit" class="btn btn-primary" value="Pay with your Card"
                                                        data-key="<?php echo $publishable_key; ?>"
                                                       data-amount="<?php echo $plugin_price; ?>"
                                                       data-currency="rwf"
                                                       data-name="<?php echo $plugin_name; ?>"
                                                       data-image="<?php echo $plugin_image_url; ?>"
                                                       data-description="Pay {{$cylinder->price}} to {{$cylinder->user->name}}"
                                                       data-allow-remember-me="false"
                                                       data-email="{{$user->email}}"/>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="clear"></div>

                                        <div class="col-sm-12">
                                            <div class="radio-block">
                                                <input id="payments2" name="payments" type="radio" class="radio payments_all" value="PayPal"/>
                                                <label class="" for="payments2"><span>PayPal</span> <img src="/assets/images/payment-paypal.png" alt="Image"></label>
                                            </div>
                                            <div id="PayPal" style="padding: 20px; outline: 2px solid #fe8800" class="payment-option-form">
                                                <div class="inner" style="padding-bottom: 50px">

                                                    <h5 class="">Total Payment: {{$cylinder->price_usd()}} USD (1 USD = {{\App\Currency::first()->exchange}} RWF)</h5>
                                                    <h5 class="">Pay to : paypal@kigaligasbooking.com</h5>
                                                    <p>You will be automatically redirected to PayPal</p>

                                                    <div id="paypal-button-container" class="col-md-6"></div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="clear"></div>

                                        <div class="col-sm-12" style="padding-bottom: 30px">
                                            <div class="radio-block">
                                                <input checked id="payments3" name="payments" type="radio" class="radio payments_all" value="MTN_Mobile_Money"/>
                                                <label class="" for="payments3"><span>MTN Mobile Money</span> <img src="/assets/images/payment-momo.png" alt="Image"></label>
                                            </div>
                                            <div id="MTN_Mobile_Money" style="padding: 20px; outline: 2px solid #fe8800" class="payment-option-form">
                                                <div class="inner">

                                                    <h5 class="">Your Payment Total: {{$cylinder->price}}</h5>
                                                    <h5 class="">Pay to : 0785672383</h5>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-sm-12" style="padding: 20px; outline: 2px solid #2B92ED">
                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label"><span id="payments1_span" style="display: none">Email you used on Payment form</span> <span id="payments2_span" style="display: none">PayPal Email Used to pay</span><span id="payments3_span">MTN Number Used To Pay</span></label>
                                                    <div>
                                                        <input type="text" id="transaction_number_input" name="transaction_number" class="form-control" value="{{$user->mobile_no}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Confirm Payment</button>
                                        </div>

                                    </div>

                                </div>
                            </div><!-- end payment-content -->
                        </form>
                    </div>

                    <div class="col-xs-12 col-sm-4">
                        <aside class="sidebar-wrapper with-box-shadow">

                            <div class="slider sidefd">
                                <div class="image-sidebar">
                                    <img src="{{$cylinder->image_url()}}" alt="image"/>
                                </div>
                            </div>
                            <div class="sidebar-dt tour-info">
                                <h3>{{$cylinder->name}}</h3>
                                <span>(1 hour delivery)</span>
                                <div class="rating-wrapper">
                                    <div class="rating-item">
                                        <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="fa fa-star-o" data-fractions="2" data-readonly value="4.5"/>
                                    </div>
                                </div>
                                <a class="review-rate">{{$cylinder->available}} available</a>
                                <ul class="price-summary-list">
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-5 col-sm-5">
                                                <h5>Agent name:</h5>
                                            </div>
                                            <div class="col-xs-7 col-sm-7 text-right">
                                                <p>{{$cylinder->user->name}}</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="row">
                                            <div class="col-xs-5 col-sm-5">
                                                <h5>Cylinder Size:</h5>
                                            </div>
                                            <div class="col-xs-7 col-sm-7 text-right">
                                                <p>{{$cylinder->size}}</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="row">
                                            <div class="col-xs-5 col-sm-5">
                                                <h5>Agent phone:</h5>
                                            </div>
                                            <div class="col-xs-7 col-sm-7 text-right">
                                                <p>{{$cylinder->user->mobile_no?$cylinder->user->mobile_no:'(No phone)'}}</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="row">
                                            <div class="col-xs-4 col-sm-4">
                                                <h5>Agent email:</h5>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 text-right">
                                                <p>{{$cylinder->user->email?$cylinder->user->email:'(No email)'}}</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <h6 class="heading text-primary uppercase">Cylinder Pricing</h6>
                                        <div class="row">
                                            <div class="col-xs-5 col-sm-5">
                                                Price
                                            </div>
                                            <div class="col-xs-7 col-sm-7 text-right">
                                                {{$cylinder->price}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5 col-sm-5">
                                                Shipping
                                            </div>
                                            <div class="col-xs-7 col-sm-7 text-right">
                                                Always free
                                            </div>
                                        </div>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <div class="row">
                                            <div class="col-xs-5 col-sm-5">
                                                <h5>Total </h5>
                                            </div>
                                            <div class="col-xs-7 col-sm-7 text-right">
                                                {{$cylinder->price}}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <span class="font600 font26 text-primary ">{{$cylinder->price}}</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </aside><!-- end sidebar-wrapper with-box-shadow -->
                        <div class="detail-content-sticky-nav">

                            <h3 class="font-lg">Terms & Conditions</h3>

                            <div id="MainMenu">
                                <div class="list-group panel">
                                    <a href="#demo1" class="list-group-item list-group-item-success itenerary_tab" data-toggle="collapse" data-parent="#MainMenu">
                                        <div class="pull-left"><h5>Step<span>01</span></h5></div>
                                        <div class="t-heading">
                                            <h4 class="font-lg">You placed the order</h4>
                                            <p>Pay by payment method you need.</p>
                                        </div>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="collapse" id="demo1">
                                        <p>If you don't pay, you won't get it.</p>
                                    </div>

                                    <a href="#demo2" class="list-group-item list-group-item-success itenerary_tab" data-toggle="collapse" data-parent="#MainMenu">
                                        <div class="pull-left"><h5>Step<span>02</span></h5></div>
                                        <div class="t-heading">
                                            <h4 class="font-lg">We mark the order as Active</h4>
                                            <p>We mark it as Active on payment.</p>
                                        </div>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="collapse" id="demo2">
                                        <p>As we received your payment, we will make it Active</p>
                                    </div>

                                    <a href="#demo3" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">
                                        <div class="pull-left"><h5>Step<span>03</span></h5></div>
                                        <div class="t-heading">
                                            <h4 class="font-lg">We deliver your gas to your home</h4>
                                            <p>We will bring it to take an empty bottle.</p>
                                        </div>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="collapse" id="demo3">
                                        <p>Wait for us to reach your home with your gas.</p>
                                    </div>

                                    <a href="#demo4" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">
                                        <div class="pull-left"><h5>Step<span>04</span></h5></div>
                                        <div class="t-heading">
                                            <h4 class="font-lg">You mark the booking as Finished</h4>
                                            <p>Mark the booking as finished</p>
                                        </div>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="collapse" id="demo4">
                                        <p>Remember to mark the booking as Finished.</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end detail-content-sticky-nav -->
                    </div>

                </div>

            </div>

        </section><!-- end main content -->

    </div>
    <!-- end Main Wrapper -->
@endsection
@section('custom-js')
    <script src="https://checkout.stripe.com/v2/checkout.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js" data-log-level="error"></script>
    <script>
        $(document).ready(function(){
            let transaction_number_input = $('#transaction_number_input');
            let $payments_all = $('.payments_all');
            $('#stripe_pay_button').on('click', function(event) {
                event.preventDefault();

                let $button = $(this),
                    $form = $('#payment-page-form');;

                let opts = $.extend({}, $button.data(), {
                    token: function(result) {
                        transaction_number_input.val(result.email);
                        $form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
                    }
                });

                StripeCheckout.open(opts);
            });
            $payments_all.on('click', function(){
                if($(this).attr('id')=='payments3'){
                    transaction_number_input.val("{{$user->mobile_no}}").prop('required', true);
                }else{
                    transaction_number_input.val("{{$user->email}}").prop('required', false);
                }
                $('#payments1_span, #payments2_span, #payments3_span').hide();
                $('#' + $(this).attr('id') + '_span').show();
                });

            const PAYPAL_ENV = 'sandbox';
            const PAYPAL_SANDBOX_KEY = 'AVxk5T_8cfjwF_7dZUkBE-dKxhiHL6HScjDCDsgSk6aR0CaYz4NXvqEKmKwvJZtX48fedW0CoSatBZBO';
            const PAYPAL_PRODUCTION_KEY = 'AUVzouONTKFpXZR2AkkDIZtpwKlFU8xwG5GaPExIHvgdqskx5JkqW8WrlscrfaO0cszczXbtvVas1fz6';

            let $paypal_selector_id = '#paypal-button-container';

            function payWithPaypal(){
                $paymentData={
                    total: {{$cylinder->price_usd()}}, // Amount payable in USD
                    selector: '#paypal-button-container'
                };

                paypal.Button.render({

                    // Set your environment

                    env: PAYPAL_ENV, // sandbox | production

                    // Specify the language displayed on your button

                    locale: 'en_US',

                    // Specify the style of the button

                    style: {
                        layout: 'horizontal',  // horizontal | vertical
                        size:   'responsive',    // medium | large | responsive
                        shape:  'rect',      // pill | rect
                        color:  'gold',       // gold | blue | silver | black
                        label: 'pay',
                        tagline: false
                        //fundingicons: 'true'
                    },

                    // Specify allowed and disallowed funding sources
                    //
                    // Options:
                    // - paypal.FUNDING.CARD
                    // - paypal.FUNDING.CREDIT
                    // - paypal.FUNDING.ELV

                    funding: {
                        allowed: [ paypal.FUNDING.CARD ],
                        disallowed: [ paypal.FUNDING.CREDIT ]
                    },

                    // PayPal Client IDs - replace with your own
                    // Create a PayPal app: https://developer.paypal.com/developer/applications/create

                    client: {
                        sandbox:    PAYPAL_SANDBOX_KEY,
                        production: PAYPAL_PRODUCTION_KEY
                    },

                    // Display a "Pay Now" button rather than a "Continue" button

                    commit: true,

                    payment: function(data, actions) {
                        return actions.payment.create({
                            payment: {
                                transactions: [
                                    {
                                        amount: { total: $paymentData.total, currency: 'USD' }
                                    }
                                ]
                            },
                            experience: {
                                input_fields: {
                                    no_shipping: 1
                                }
                            }
                        });
                    },

                    onAuthorize: function(data, actions) {
                        return actions.payment.execute().then(function() {
                            paid(data);
                        });
                    },

                    onCancel: function(data) {
                    }

                }, $paypal_selector_id );
            }

            function paid($data){
                let form = $('#payment-page-form');
                let transaction_number_input=$('#transaction_number_input');
                if(!transaction_number_input.val()){
                    transaction_number_input.val("{{$user->email}}");
                }
                form.append('<input type="hidden" name="paypal_payer_id" value="'+$data.payerID+'">').submit();
            }
                payWithPaypal();

            $('#payments3').trigger('click');
            $('.stripe-button-el').addClass('btn btn-primary').removeClass('stripe-button-el').children('span').css('min-height', 'auto');

        });

    </script>
@endsection
