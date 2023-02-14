
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>デバイス保険</title>
        <link rel="icon" href="{{asset('/img/top/favicon.ico')}}" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
    </head>
    <body>
<header>
    @include('header')
</header>
    <div class="container checkout">
    <h2 class="checkout__ttl">新規入会</h2>
        <h3 class="checkout__ttl02">お申し込み</h3>
        <img src="{{asset('/img/Progress-payment.png')}}" class="checkout__img">
        <p class="checkout__text">ご契約内容を送信しました。<br>続けて決済情報のご入力をお願いいたします。</p>
        <!--stripe-->
        <div class="row checkout__sec">
            <div class="col-md-6 col-md-offset-3">
                <h3 class="checkout__sec--ttl">決済情報入力</h3>
            </div>
            
                
            <form 
                role="form" 
                action="{{ route('stripe.post') }}" 
                method="post" 
                class="require-validation"
                data-cc-on-file="false"
            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
            id="payment-form"
            onsubmit="submitted=true; this.querySelector('input[type=submit]').disabled=true;">
            @csrf

                <div class="checkout__cont">
                    <div class="panel-heading display-table" >
                        <h3 class="panel-heading__ttl">お支払方法</h3>
                        <input type="radio" name="payment" id="card" class="payment-form__list--radio" checked>
                        <label for="card" class="payment-form__list--label">クレジットカード</label>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @elseif (Session::has('error'))
                            <div class="alert alert-error text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('error') }}</p>
                            </div>
                        @endif

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>カード番号</label> <input
                                    autocomplete='off' class='form-control card-number' placeholder='0000000000000000' size='20'
                                    type='text'>
                            </div>
                        </div>
    
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> 
                                <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='000' size='4'
                                    type='text'>
                            </div>
                            
                            <div class="form-group">
                                <label class='control-label'>有効期限</label>
                                <div class="flex">
                                    <div class='col-xs-12 col-md-4 expiration required'>
                                        <input
                                            class='form-control card-expiry-month' placeholder='月' size='2'
                                            type='text'><span>　/　</span>
                                    </div>
                                    <div class='col-xs-12 col-md-4 expiration required'>
                                        <input
                                            class='form-control card-expiry-year' placeholder='年' size='2'
                                            type='text'>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>時間を置いてからやり直してください。</div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="btn btn-primary btn-lg btn-block" id="sub_btn" type="submit" onclick="loding();">
                            </div>
                        </div>
                    
                    </div>       
                </div>
            </form>
        </div>
    </div>
<footer>
    @include('footer')
</footer>
<!--paidy
    <div class="paidy">
        <button id="paidy-checkout-button" onclick="paidyPay()">ペイディでお支払い</button>
    </div>
    <script type="text/javascript" src="{{url('https://apps.paidy.com/')}}"></script>
    <script type="text/javascript">
                        var config = {
                            "api_key": "pk_test_64flakiliha8239usr0cpe7gvd",
                            "logo_url": "http://www.paidy.com/images/logo.png",
                            "closed": function(callbackData) {
                                /*
                                Data returned in the callback:
                                callbackData.id,
                                callbackData.amount,
                                callbackData.currency,
                                callbackData.created_at,
                                callbackData.status
                                */
                                console.log(callbackData.id);
                            }
                        };
                        var paidyHandler = Paidy.configure(config);
                        function paidyPay() {
                            var payload = {
                                "amount": 10000,
                                "currency" : "JPY",
                                "store_name": "Paidy sample store",
                                "buyer": {
                                    "email": "successful.payment@paidy.com",
                                    "name1": "山田　太郎",
                                    "name2": "ヤマダ　タロウ",
                                    "phone" : "08000000001",
                                    "dob": "1990-10-25"
                                },
                                "buyer_data": {
                                            "user_id": "yamada_taro",
                                            "age": 29,
                                            "age_platform": 50,
                                            "days_since_first_transaction": 29,
                                            "ltv": 250000,
                                            "order_count": 1000,
                                            "last_order_amount": 20000,
                                            "last_order_at": 20,
                                            "order_amount_last3months": 15000,
                                            "order_count__last3months": 5,
                                            "additional_shipping_addresses": [{
                                                    "line1": "AZABUビル 2F",
                                                    "line2": "東麻布2-10-1",
                                                    "city": "港区",
                                                    "state": "東京都",
                                                    "zip": "106-0023"
                                            }],
                                            "billing_address": {
                                                    "line1": "AXISビル 10F",
                                                    "line2": "六本木4-22-1",
                                                    "city": "港区",
                                                    "state": "東京都",
                                                    "zip": "106-2004"
                                            },
                                            "delivery_locn_type": "office",
                                            "gender": "Male",
                                            "subscription_counter": 2,
                                            "previous_payment_methods": {
                                                    "credit_card_used": false,
                                                    "cash_on_delivery_used": true,
                                                    "convenience_store_prepayment_used": true,
                                                    "carrier_payment_used": false,
                                                    "bank_transfer_used": false,
                                                    "rakuten_pay_used": true,
                                                    "line_pay_used": false,
                                                    "amazon_pay_used": false,
                                                    "np_postpay_used": false,
                                                    "other_postpay_used": false
                                            },
                                            "number_of_points": 8023,
                                            "order_item_categories": ["sunglasses", "contact lenses"]
                                },
                                "order": {
                                    "items": [
                                    {
                                        "id":"PDI001",
                                        "quantity":1,
                                        "title":"スニーカー",
                                        "unit_price":10000,
                                        "description":" "
                                    }
                                    ],
                                    "order_ref": "88e021674",
                                    "shipping": 0,
                                    "tax": 0
                                },
                                "shipping_address": {
                                    "line1": "AXISビル 10F",
                                    "line2": "六本木4-22-1",
                                    "city": "港区",
                                    "state": "東京都",
                                    "zip": "106-2004"
                                },
                                "description" : "Sample store"
                        };
                        paidyHandler.launch(payload);
                        function execute(callback) {
                        // コールバックの実行
                        callback();
                        }
        };
    </script>-->
    <!--<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
    <script type="text/javascript">
    $(function() {
        /*------------------------------------------
        --------------------------------------------
        Stripe Payment Code
        --------------------------------------------
        --------------------------------------------*/
        
        var $form = $(".require-validation");

        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                            'input[type=text]', 'input[type=file]',
                            'textarea'].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
            $errorMessage.addClass('hide');
        
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        
        });

        /*------------------------------------------
        --------------------------------------------
        Stripe Response Handler
        --------------------------------------------
        --------------------------------------------*/
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];

                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
    </script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
    $(function() {
        /*------------------------------------------
        --------------------------------------------
        Stripe Payment Code
        --------------------------------------------
        --------------------------------------------*/
        
        var $form = $(".require-validation");

        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                            'input[type=text]', 'input[type=file]',
                            'textarea'].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
            $errorMessage.addClass('hide');
        
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        
        });

        /*------------------------------------------
        --------------------------------------------
        Stripe Response Handler
        --------------------------------------------
        --------------------------------------------*/
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];

                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
    </script>
    <script>
        function loding() {
            
		    document.getElementById("sub_btn").style.background = "#FFF";
            document.getElementById("sub_btn").style.color = "#957AFF";
            document.getElementById("sub_btn").style.border = "1px solid #957AFF";        


        }
    </script>

    </body>
</html>
