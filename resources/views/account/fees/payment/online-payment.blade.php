@if(isset($paymentGatewayStatus))
    @php($manageSettingStatus = collect(array_pluck($paymentGatewayStatus,'status','identity')))
    @php($manageSetting = array_pluck($paymentGatewayStatus,'config','identity'))


    @if( isset($manageSettingStatus['Paypal']) && $manageSettingStatus['Paypal'] == 'active')
        @php($stripe = json_decode($manageSetting['Paypal'],true))
        @include('account.fees.payment.paypal')
    @endif


    @if(isset($manageSettingStatus['Stripe']) == 'active')
        @php($stripe = json_decode($manageSetting['Stripe'],true))
        @include('account.fees.payment.stripe')
    @endif

    @if(isset($manageSettingStatus['Instamojo']) == 'active')
        @php($instamojo  = json_decode($manageSetting['Instamojo'],true))
        @include('account.fees.payment.instamojo')
    @endif

    @if(isset($manageSettingStatus['PayUMoney']) == 'active')
        @php($payumoney = json_decode($manageSetting['PayUMoney'],true))
        @include('account.fees.payment.payumoney.payumoney')
    @endif

    @if(isset($manageSettingStatus['RozorPay']) == 'active')
        @php($stripe = json_decode($manageSetting['RozorPay'],true))
        @include('account.fees.payment.rozorpay')
    @endif

    @if(isset($manageSettingStatus['PayStack']) == 'active')
        @php($paystack = json_decode($manageSetting['PayStack'],true))
        @include('account.fees.payment.paystack')
    @endif

    @if(isset($manageSettingStatus['Khalti']) == 'active')
        @php($khalti = json_decode($manageSetting['Khalti'],true))
        @include('account.fees.payment.khalti')
    @endif

    {{--@include('account.fees.payment.stripe')
    @include('account.fees.payment.rozorpay.rozorpay')--}}
    {{--
    @include('account.fees.payment.pesapal.pesapal')--}}

    @permission('fees-online-payment-pay')

    @endability


@endif