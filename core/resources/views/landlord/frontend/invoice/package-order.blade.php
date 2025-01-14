<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Package Invoice')}}</title>
    <style>

        body * {
            font-family: 'Open Sans', sans-serif;
        }
        table, td, th {
            border: 1px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 15px;
        }

        /* cart page */
        .cart-wrapper table .thumbnail {
            max-width: 50px;
        }

        .cart-wrapper table .product-title {
            font-size: 16px;
            line-height: 26px;
            font-weight: 600;
            transition: 300ms all;
        }

        .cart-wrapper table .quantity {
            max-width: 80px;
            border: 1px solid #e2e2e2;
            height: 40px;
            padding-left: 10px;
        }

        .cart-wrapper table {
            color: #656565;
        }

        .cart-wrapper table th {
            color: #333;
        }

        .cart-total-wrap .title {
            font-size: 30px;
            line-height: 40px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .cart-total-table table td {
            color: #333;
        }

        .billing-details-wrapper .login-form {
            max-width: 450px;
        }

        .billing-details-wrapper {
            margin-bottom: 80px;
        }

        .billing-details-fields-wrapper .title {
            font-size: 30px;
            line-height: 40px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .product-orders-summery-warp .title {
            font-size: 24px;
            text-align: left;
            margin-bottom: 7px;
        }

        #pdf_content_wrapper {
            max-width: 1000px;
        }

        .cart-wrapper table .thumbnail img {
            width: 80px;
        }

        .cart-total-table-wrap .title {
            font-size: 25px;
            line-height: 34px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .billing-and-shipping-details div:first-child {
            margin-bottom: 30px;
        }

        .billing-and-shipping-details div ul {
            margin: 0;
            padding: 0;
        }

        .billing-and-shipping-details div ul li {
            font-size: 16px;
            line-height: 30px;
        }

        .billing-and-shipping-details div .title {
            font-size: 22px;
            line-height: 26px;
            font-weight: 600;
        }

        .billing-and-shipping-details {
            margin-top: 40px;
        }

        .billing-wrap ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .cart-wrapper img{
            max-height: 150px;
        }
    </style>
</head>
<body>
<div id="pdf_content_wrapper">

    <div class="cart-table-wrapper cart-wrapper">
        <div class="logo-wrapper" style="max-width: 200px;">
            {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
        </div>
        <div class="package-info-wrap">
            @if(!empty($payment_details))
                <h2 class="main_title">{{__('Package Information')}}</h2>
                <ul>
                    <li><strong>{{__('Order ID')}}</strong> #{{$payment_details->id }}</li>
                    <li><strong>{{__('Order Date')}}</strong> {{date_format($payment_details->created_at,'d M Y')}}</li>
                    <li><strong>{{__('Package Name')}}</strong> {{$payment_details->package_name ?? ''}}</li>
                    <li><strong>{{__('Amount')}}</strong> {{amount_with_currency_symbol($payment_details->package_price ?? '')}}</li>
                </ul>
            @endif
        </div>
    </div>

    @php
        $tenantHelper = \App\Helpers\TenantHelper\TenantHelpers::init()->setTenantId($payment_details->tenant_id);
    @endphp

    <div class="cart-total-table-wrap">
        <h4 class="title">{{__('Billing Summery')}}</h4>
        <div class="cart-total-table table-responsive">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>{{__('Billing Name')}}</th>
                    <td>{{$payment_details->name ?? ''}}</td>
                </tr>
                <tr>
                    <th>{{__('Billing Email')}}</th>
                    <td>{{$payment_details->email ?? ''}}</td>
                </tr>

                <tr>
                    <th><strong>{{__('Package Start Date : ')}}</strong></th>
                    <td>{{ $tenantHelper->getTenantStartDate() }}</td>
                </tr>
                <tr>
                    <th><strong>{{__('Package Expire Date : ')}}</strong></th>
                    <td>{{ $tenantHelper->getTenantExpiredDate() }}</td>
                </tr>
                <tr>
                    <th>{{__('Payment Gateway')}}</th>
                    <td>{{str_replace('_',' ',$payment_details->package_gateway ?? '')}}</td>
                </tr>
                <tr>
                    <th>{{__('Payment Status')}}</th>
                    <td>{{$payment_details->payment_status ?? ''}}</td>
                </tr>
                <tr>
                    <th>{{__('Transaction ID')}}</th>
                    <td>{{$payment_details->transaction_id ?? ''}}</td>
                </tr>

                <tr>
                    <th>{{__('Package Price')}}</th>
                    <td>{{amount_with_currency_symbol($payment_details->package?->price ?? '')}}</td>
                </tr>
                @if(!empty($payment_details->coupon_discount))
                    <tr>
                        <th>{{__('Coupon Discount')}}</th>
                        <td> - {{amount_with_currency_symbol($payment_details->coupon_discount ?? '')}}</td>
                    </tr>
                @endif
                <tr>
                    <th>{{__('Total')}}</th>
                    <td>{{amount_with_currency_symbol($payment_details->package_price ?? '')}}</td>
                </tr>

                </tbody>
            </table>

        </div>
    </div>
</div>
</body>
</html>
