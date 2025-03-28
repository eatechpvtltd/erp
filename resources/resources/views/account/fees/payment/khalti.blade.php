{!! Form::open(['route' => 'account.fees.khalti-payment','method' => 'post', 'class' => 'form-horizontal', "enctype" => "multipart/form-data"]) !!}
    {!! Form::hidden('student_id', encrypt($data['student']->id)) !!}
    {!! Form::hidden('amount', encrypt($data['student']->balance)) !!}
    {!! Form::hidden('website_url', encrypt($generalSetting->website)) !!}
    {!! Form::hidden('return_url', encrypt(Request::fullUrl())) !!}
    <button type="submit" class="btn btn-xs btn-primary">
        Pay with Khalti
    </button>
{!! Form::close() !!}
{{--
{!! Form::open(['route' => 'account.fees.khalti-payment','method' => 'post', 'class' => 'form-horizontal', "enctype" => "multipart/form-data"]) !!}
{!! Form::text('student_id', encrypt($data['student']->id)) !!}
--}}{{--{!! Form::text('reg_no', $data['student']->reg_no) !!}--}}{{--
--}}{{--{!! Form::text('name', $data['student']->first_name.' '.$data['student']->middle_name.' '.$data['student']->last_name) !!}
{!! Form::text('email', $data['student']->email) !!}
{!! Form::text('phone', $data['student']->mobile_1) !!}--}}{{--
{!! Form::text('fee_head', encrypt($feeHead)) !!}
{!! Form::text('amount', encrypt($data['student']->balance)) !!}
{!! Form::text('website_url', encrypt($generalSetting->website)) !!}
{!! Form::text('return_url', encrypt(Request::fullUrl())) !!}


<button type="submit" class="btn btn-xs btn-primary">
    Pay with Khalti
</button>
{!! Form::close() !!}--}}

@ability('super-admin', 'fees-payment-khalti-payment')









{{--<hr class="hr-2">--}}
{{--<!-- Place this where you need payment button -->--}}
{{--<button class="payment-button" style="background-color: #773292; color: #fff; border: none; padding: 5px 10px; border-radius: 2px;"--}}
{{--        data-due="{{ $net_balance*100 }}"--}}
{{--        data-product-identity="{{ $data['student']->reg_no }}"--}}
{{--        data-product-name="{{ ViewHelper::getSemesterById($feemaster->semester) }}-{{ ViewHelper::getFeeHeadById($feemaster->fee_head) }}">--}}
{{--    Pay with Khalti--}}
{{--</button>--}}
@endability



<!--<hr class="hr-2">-->
<!-- Place this where you need payment button -->
{{--<button class="payment-button" style="background-color: #773292; color: #fff; border: none; padding: 5px 10px; border-radius: 2px;"--}}
{{--        data-due="{{ 100*100 }}"--}}
{{--        data-product-identity="{{ $data['student']->reg_no }}"--}}
{{--        data-product-name="Registration Fee - API Testing">--}}
{{--    Pay with Khalti--}}
{{--</button>--}}

{{--<a href="#" data-amount='100' id='payment-button-2' class="btn btn-primary pay-khalti">Pay with Khalti</a>--}}
<!--<a href="
<a href="http://example.com/?pidx=bZQLD9wRVWo4CdESSfuSsB
&txnId=4H7AhoXDJWg5WjrcPT9ixW
&amount=1000
&mobile=98XXXXX904
&purchase_order_id=test12
&purchase_order_name=test
&transaction_id=4H7AhoXDJWg5WjrcPT9ixW">Pay With Khalti 2.0</a>-->

@section('js')

{{--    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>--}}
{{--    <script src="{{ asset('assets/resources/khalti/js/khalti-client.js') }}" type="text/javascript"></script>--}}

{{--    <link rel="stylesheet" href="https://rawgit.com/google/code-prettify/master/styles/sons-of-obsidian.css" />--}}
{{--    <script type="text/javascript">--}}

{{--        $(function(){--}}
{{--            // just show the live js here.--}}
{{--            $.ajax({url: "{{ asset('assets/resources/khalti/js/khalti-client.js') }}", success: function(resp){--}}
{{--                    $("#js-code-here").text(resp.trim());--}}
{{--                    addEventListener('load', function(event) { PR.prettyPrint(); }, false);--}}
{{--                }, dataType: 'html'});--}}
{{--            $.get({url: "example.js", success: function(resp){--}}
{{--                    $("#js-example-here").text(resp.trim());--}}
{{--                    addEventListener('load', function(event) { PR.prettyPrint(); }, false);--}}
{{--                }, dataType: 'html'});--}}
{{--        });--}}
{{--    </script>--}}


<!--<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
<script>
    var config = {
        // replace the publicKey with yours
        "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a390234",
        "productIdentity": "1234567890",
        "productName": "Dragon",
        "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
        "paymentPreference": [
            "KHALTI",
            "EBANKING",
            "MOBILE_BANKING",
            "CONNECT_IPS",
            "SCT",
        ],
        "eventHandler": {
            onSuccess (payload) {
                // hit merchant api for initiating verfication
                console.log(payload);
            },
            onError (error) {
                console.log(error);
            },
            onClose () {
                console.log('widget is closing');
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("payment-button");
    btn.onclick = function () {
        // minimum transaction amount must be 10, i.e 1000 in paisa.
        checkout.show({amount: 1000});
    }
</script>-->
@endsection
<!--<button id="payment-button">Pay with Khalti</button>-->
