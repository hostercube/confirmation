{{-- @extends('frontend.layouts.app') --}}
{{-- customize and design by Rohan 01751136819 --}}

<!DOCTYPE html>
@if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <title>@yield('meta_title', get_setting('website_name').' | '.get_setting('site_motto'))</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">

    @yield('meta')

    @if(!isset($detailedProduct) && !isset($customer_product) && !isset($shop) && !isset($page) && !isset($blog))
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="{{ get_setting('meta_title') }}">
        <meta itemprop="description" content="{{ get_setting('meta_description') }}">
        <meta itemprop="image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="product">
        <meta name="twitter:site" content="@publisher_handle">
        <meta name="twitter:title" content="{{ get_setting('meta_title') }}">
        <meta name="twitter:description" content="{{ get_setting('meta_description') }}">
        <meta name="twitter:creator" content="@author_handle">
        <meta name="twitter:image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

        <!-- Open Graph data -->
        <meta property="og:title" content="{{ get_setting('meta_title') }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ route('home') }}" />
        <meta property="og:image" content="{{ uploaded_asset(get_setting('meta_image')) }}" />
        <meta property="og:description" content="{{ get_setting('meta_description') }}" />
        <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
        <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
    @endif

    <!-- Favicon -->
    <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    @if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/custom-style.css') }}">
    



    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: '{!! translate('Nothing selected', null, true) !!}',
            nothing_found: '{!! translate('Nothing found', null, true) !!}',
            choose_file: '{{ translate('Choose file') }}',
            file_selected: '{{ translate('File selected') }}',
            files_selected: '{{ translate('Files selected') }}',
            add_more_files: '{{ translate('Add more files') }}',
            adding_more_files: '{{ translate('Adding more files') }}',
            drop_files_here_paste_or: '{{ translate('Drop files here, paste or') }}',
            browse: '{{ translate('Browse') }}',
            upload_complete: '{{ translate('Upload complete') }}',
            upload_paused: '{{ translate('Upload paused') }}',
            resume_upload: '{{ translate('Resume upload') }}',
            pause_upload: '{{ translate('Pause upload') }}',
            retry_upload: '{{ translate('Retry upload') }}',
            cancel_upload: '{{ translate('Cancel upload') }}',
            uploading: '{{ translate('Uploading') }}',
            processing: '{{ translate('Processing') }}',
            complete: '{{ translate('Complete') }}',
            file: '{{ translate('File') }}',
            files: '{{ translate('Files') }}',
        }
    </script>

    <style>
        body{
            font-family: 'Open Sans', sans-serif;
            font-weight: 400;
        }
        :root{
            --primary: {{ get_setting('base_color', '#e62d04') }};
            --hov-primary: {{ get_setting('base_hov_color', '#c52907') }};
            --soft-primary: {{ hex2rgba(get_setting('base_color','#e62d04'),.15) }};
        }

        #map{
            width: 100%;
            height: 250px;
        }
        #edit_map{
            width: 100%;
            height: 250px;
        }

        .pac-container { z-index: 100000; }
    </style>

@if (get_setting('google_analytics') == 1)
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('TRACKING_ID') }}"></script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ env('TRACKING_ID') }}');
    </script>
@endif

@if (get_setting('facebook_pixel') == 1)
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{ env('FACEBOOK_PIXEL_ID') }}');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ env('FACEBOOK_PIXEL_ID') }}&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
@endif

@php
    echo get_setting('header_script');
@endphp
@php
// Get the background color customize
    function bgColor( $lending_page, $item_title ) {
        $bgColor = $lending_page->customize()
            ->where('lending_page_item_title', $item_title)
            ->pluck('lending_page_item_bg_color')
            ->first(); // Get the first result
        return $bgColor;
    }
    function textColor( $lending_page, $item_title ) {
        $textColor = $lending_page->customize()
            ->where('lending_page_item_title', $item_title)
            ->pluck('lending_page_item_color')
            ->first(); // Get the first result
        return $textColor;
    }
    function isDisplay( $lending_page, $item_title ) {
        $isDisplay = $lending_page->customize()
            ->where('lending_page_item_title', $item_title)
            ->pluck('lending_page_item_display')
            ->first(); // Get the first result
        return $isDisplay;
    }
@endphp

<style>
    .countdown-container {
        text-align: center;
        /* background: #282a36; */
        padding: 20px;
        color: white;
        border-radius: 10px;
        font-family: 'Arial', sans-serif;
    }

    #countdown {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .time-box {
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    .digit {
        background: white;
        color: red;
        padding: 15px;
        border-radius: 5px;
        font-size: 24px;
        font-weight: bold;
        min-width: 40px;
        text-align: center;
    }

    .label {
        display: block;
        font-size: 12px;
        color: white;
        text-align: center;
        margin-top: 5px;
    }
    .carousel-box {
    padding: 10px;
    box-sizing: border-box; /* Ensure padding doesn't interfere */
}
.aiz-carousel {
    width: 100%; /* Use full width */
    display: flex; /* Flex container to align items */
    overflow: hidden;
}
.carousel-box {
    flex: 0 0 25%; /* Force 4 items per row by setting width to 25% */
    max-width: auto; /* Ensure each item takes up 25% of the container */
}


.slick-prev, .slick-next {
    background-color: black;      /* Black background for arrows */
    color: white;                 /* White arrow icon */
    font-size: 24px;              /* Icon size */
    width: 40px;
    height: 40px;
    border-radius: 50%;           /* Circular shape */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    opacity: 1 !important;
}

.slick-prev:before, .slick-next:before {
    color: white;                 /* Color of the arrow icon */
}



</style>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5C566TSZ');</script>
    <!-- End Google Tag Manager -->
    

    
    
    
</head>
<body><!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5C566TSZ"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="d-flex justify-content-center my-3 p-0">
        <div class="col-md-8 card ">
            <div class="card-body px-0">
                <section class="py-4">
                    <div class="container text-left">
                        <div class="row">
                            <div class="col-xl-8 mx-auto">
                                @php
                                    $first_order = $combined_order->orders->first()
                                @endphp
                                <div class="text-center py-4 mb-4">
                                    @php
                                        $header_logo = get_setting('header_logo');
                                    @endphp
                                    @if($header_logo != null)
                                        <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-40px" height="40">
                                    @else
                                        <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-40px" height="40">
                                    @endif
                                </div>
                                <div class="text-center py-4 mb-4" style="background: #d4cece">
                                    <i class="la la-check-circle la-3x text-success mb-3"></i>
                                    <h1 class="h3 mb-3 fw-600">{{ translate('Thank You for Your Order!')}}</h1>
                                    <!-- <p class="opacity-70 font-italic">{{  translate('A copy or your order summary has been sent to') }} {{ json_decode($first_order->shipping_address)->email }}</p> -->
                                </div>
                                <div class="mb-4 bg-white p-4 rounded shadow-sm">
                                    <h5 class="fw-600 mb-3 fs-17 pb-2">{{ translate('Order Summary')}}</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tr>
                                                    <td class="w-50 fw-600">{{ translate('Order date')}}:</td>
                                                    <td>{{ date('d-m-Y H:i A', $first_order->date) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 fw-600">{{ translate('Name')}}:</td>
                                                    <td>{{ json_decode($first_order->shipping_address)->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 fw-600">{{ translate('Email')}}:</td>
                                                    <td>{{ json_decode($first_order->shipping_address)->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 fw-600">{{ translate('Shipping address')}}:</td>
                                                    <td>{{ json_decode($first_order->shipping_address)->address }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tr>
                                                    <td class="w-50 fw-600">{{ translate('Order status')}}:</td>
                                                    <td>{{ translate(ucfirst(str_replace('_', ' ', $first_order->delivery_status))) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 fw-600">{{ translate('Total order amount')}}:</td>
                                                    <td>{{ single_price($combined_order->grand_total) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 fw-600">{{ translate('Shipping')}}:</td>
                                                    <td>{{ translate('Flat shipping rate')}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-50 fw-600">{{ translate('Payment method')}}:</td>
                                                    <td>{{ translate(ucfirst(str_replace('_', ' ', $first_order->payment_type))) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                @foreach ($combined_order->orders as $order)
                                    <div class="card shadow-sm border-0 rounded">
                                        <div class="card-body">
                                            <div class="text-center py-4 mb-4">
                                                <h2 class="h5">{{ translate('Order Code:')}} <span class="fw-700 text-primary">{{ $order->code }}</span></h2>
                                            </div>
                                            <div>
                                                <h5 class="fw-600 mb-3 fs-17 pb-2">{{ translate('Order Details')}}</h5>
                                                <div>
                                                    <table class="table table-responsive-md">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th width="30%">{{ translate('Product')}}</th>
                                                                <th>{{ translate('Variation')}}</th>
                                                                <th>{{ translate('Quantity')}}</th>
                                                                <th>{{ translate('Delivery Type')}}</th>
                                                                <th class="text-right">{{ translate('Price')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->orderDetails as $key => $orderDetail)
                                                                <tr>
                                                                    <td>{{ $key+1 }}</td>
                                                                    <td>
                                                                        @if ($orderDetail->product != null)
                                                                            <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank" class="text-reset">
                                                                                {{ $orderDetail->product->getTranslation('name') }}
                                                                                @php
                                                                                    if($orderDetail->combo_id != null) {
                                                                                        $combo = \App\ComboProduct::findOrFail($orderDetail->combo_id);

                                                                                        echo '('.$combo->combo_title.')';
                                                                                    }
                                                                                @endphp
                                                                            </a>
                                                                        @else
                                                                            <strong>{{  translate('Product Unavailable') }}</strong>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if(json_decode($orderDetail->variation)->color != null)
                                                                            <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="">
                                                                                <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                                                    <span class="size-15px d-inline-block rounded" style="background: {{ json_decode($orderDetail->variation)->color }};"></span>
                                                                                </span>
                                                                            </label>
                                                                        @endif
                                                                        @if (json_decode($orderDetail->variation)->size != null)
                                                                            <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="">
                                                                                <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                                                    <span class="d-inline-block rounded text-center">{{ json_decode($orderDetail->variation)->size }}</span>
                                                                                </span>
                                                                            </label>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        {{ $orderDetail->quantity }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($order->shipping_type != null && $order->shipping_type == 'home_delivery')
                                                                            {{  translate('Home Delivery') }}
                                                                        @elseif ($order->shipping_type != null && $order->shipping_type == 'carrier')
                                                                            {{  translate('Carrier') }}
                                                                        @elseif ($order->shipping_type == 'pickup_point')
                                                                            @if ($order->pickup_point != null)
                                                                                {{ $order->pickup_point->getTranslation('name') }} ({{ translate('Pickip Point') }})
                                                                            @endif
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-right">{{ single_price($orderDetail->price) }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-5 col-md-6 ml-auto mr-0">
                                                        <table class="table ">
                                                            <tbody>
                                                                <tr>
                                                                    <th>{{ translate('Subtotal')}}</th>
                                                                    <td class="text-right">
                                                                        <span class="fw-600">{{ single_price($order->orderDetails->sum('price')) }}</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>{{ translate('Shipping')}}</th>
                                                                    <td class="text-right">
                                                                        <span class="font-italic">{{ single_price(($order->grand_total - ($order->orderDetails->sum('price')+$order->orderDetails->sum('tax'))+$order->coupon_discount)) }}</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>{{ translate('Tax')}}</th>
                                                                    <td class="text-right">
                                                                        <span class="font-italic">{{ single_price($order->orderDetails->sum('tax')) }}</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>{{ translate('Coupon Discount')}}</th>
                                                                    <td class="text-right">
                                                                        <span class="font-italic">{{ single_price($order->coupon_discount) }}</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th><span class="fw-600">{{ translate('Total')}}</span></th>
                                                                    <td class="text-right">
                                                                        <strong><span>{{ single_price($order->grand_total) }}</span></strong>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <hr>
                                <br>
                            </div>
                        </div>

                        <!--<div class="row">-->
                        <!--    <div class="col-md-12 text-center">-->
                        <!--        <span class="h3">{{ translate('RELATED PRODUCTS') }}</span>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>-->

                        <!--    @foreach ($products_in_same_categories as $key => $product)-->
                        <!--        <div class="carousel-box">-->
                        <!--            @include('backend.website_settings.lending_pages.components.product_box_1',['product' => $product])-->
                        <!--        </div>-->
                        <!--    @endforeach-->
                        <!--</div>-->
                        
                        <div class="row">
    <div class="col-md-12 text-center">
        <span class="h3">{{ translate('RELATED PRODUCTS') }}</span>
    </div>
</div>
<div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
    @foreach ($products_in_same_categories as $key => $product)
        <div class="carousel-box">
            @include('backend.website_settings.lending_pages.components.product_box_1', ['product' => $product])
        </div>
    @endforeach
</div>


                        
                        


                        
                        
                        
                        
                        
                        

                        <div class="text-center p-5 display-4 h3">
                            <span>GO TO</span> <span><a href="{{ url('/') }}" style="color: rgb(57, 34, 162)">SHOP</a></span>
                        </div>

                        <div class="text-center">
                            <a href="{{ get_setting('facebook_link') }}"><img class="w-50 image-responsive" src="{{ static_asset('facebook.gif') }}" alt=""></a>
                        </div>
                    </div>
                </section>
            </div>

            <footer class="pt-3 pb-7 pb-xl-3 bg-black text-light row">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <div class="text-center text-md-left" current-verison="6.5.0">
                                <div class="pt-1 ml-5 pl-5 text-left">
                                    <a href="{{ url('/terms') }}" class="text-white">terms and conditions</a><br>
                                    <a href="{{ url('/return-policy') }}" class="text-white">return policy</a><br>
                                    <a href="{{ url('/privacy-policy') }}" class="text-white">privacy policy</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                                            <ul class="list-inline my-3 my-md-0 social colored text-center">
                                                    <li class="list-inline-item">
                                    <a href="https://www.facebook.com/glotexbd" target="_blank" class="facebook"><i class="lab la-facebook-f"></i></a>
                                </li>
                                                                        <li class="list-inline-item">
                                    <a href="#" target="_blank" class="twitter"><i class="lab la-twitter"></i></a>
                                </li>
                                                                        <li class="list-inline-item">
                                    <a href="#" target="_blank" class="instagram"><i class="lab la-instagram"></i></a>
                                </li>
                                                                        <li class="list-inline-item">
                                    <a href="#" target="_blank" class="youtube"><i class="lab la-youtube"></i></a>
                                </li>
                                                                        <li class="list-inline-item">
                                    <a href="#" target="_blank" class="linkedin"><i class="lab la-linkedin-in"></i></a>
                                </li>
                                                </ul>
                                        </div>
                        <div class="col-lg-4">
                            <div class="text-center text-md-right">
                                <div class="pt-1 text-left">
                                    <h5 class="text-warning text-center">HOTLINE :
                                        <span>{{ get_setting('helpline_number') }}</span>
                                    </h5>
                                </div>
                                {{-- {{$order->orderDetails->sum('shipping_cost')}} --}}
                                <div class="text-center">
                                    All rights reserved by <a href="{{ url('/') }}" class="text-white">GloTex</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>


    <!--<a src="{{ url('/chat') }}" class="position-fixed bottom-right " style="bottom: 30px; right: 35px;">-->
    <!--    <img src="{{ static_asset('messenger.png') }}" alt="Chat Icon" width="40" height="40">-->
    <!--</a>-->

  <a href="https://www.facebook.com/glotexbd" target="_blank" title="24/7 Support" class="position-fixed bottom-right" style="bottom: 30px; right: 35px;">
    <img src="{{ static_asset('massage-chat.png') }}" alt="Chat Icon" width="50" height="50">
    </a>

    <!-- SCRIPTS -->
    <script src="{{ static_asset('assets/js/vendors.js') }}"></script>
    <script src="{{ static_asset('assets/js/aiz-core.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function getvariantprice() {
                var total = 0;
                $('.per-product-total').each(function () {
                    total += parseInt($(this).val());
                });

                $('#subtotal').val(total);
                $('#subtotal_price').text(total);
                if($('input[name="shipping"]').is(':checked')){
                    var shipping = $('input[name="shipping"]:checked').val();
                    $('#total').val(parseInt(total) + parseInt(shipping));
                    $('.total').text(parseInt(total) + parseInt(shipping));
                }else{
                    $('#total').val(parseInt(total));
                    $('.total').text(parseInt(total));
                }
            }
            $('input[name="products"]').on('click', function () {
                var item_value = $(this).val();
                if ($(this).is(':checked')) {
                    var img_src = $('#product-image-' + item_value).attr('src');
                    var product_name = $('#product-name-' + item_value).text();
                    var product_price = $('#product-price-' + item_value).text();

                    var color = $("input[name='color-"+item_value+"']:checked").val();
                    var size = $("input[name='size-"+item_value+"']:checked").val();

                    var div = document.createElement('div');
                        div.classList.add('col-md-12');
                        div.setAttribute('id', 'product_details_id_' + item_value);
                        div.innerHTML = "<div class='row'><div class='col-md-7'><input type='hidden' name='product_id[]' class='form-control m-1' value='"+item_value+"'><input type='hidden' name='color[]' class='form-control m-1' id='color-"+item_value+"' value='"+color+"'><input type='hidden' name='size[]' class='form-control m-1' id='size-"+item_value+"' value='"+size+"'></div><div class='col-md-2'></div></div><div class='row'><div class='col-md-7'><img src='"+img_src+"' alt='' style='width: 50px;height: 50px;'><span>"+product_name+"</span></div><div class='col-md-2 p-0'><div class='row'><i class='las la-minus-circle h4' id='minus-"+item_value+"'></i><input type='number' name='quantity[]' class='' min='1' style='width: 30%; background: #e4b2d2; border: none; text-align: center; outline: none;' id='quantity-"+item_value+"' value='1'><i class='las la-plus-circle h4' id='plus-"+item_value+"'></i></div></div><div class='col-md-3'><input type='hidden' name='price[]' class='form-control m-1 per-product-total' id='price-"+item_value+"' value='"+product_price+"'>৳<span id='product_price_id_"+item_value+"'>"+product_price+"</span></div></div>";
                        $('#product_details').append(div);
                        getvariantprice();

                    $('#plus-' + item_value).on('click', function () {
                        var quantity = parseInt($('#quantity-' + item_value).val());
                        quantity++;
                        $('#quantity-' + item_value).val(quantity);
                        $('#product_price_id_' + item_value).text(quantity * product_price);
                        $('#price-'+item_value).val(quantity * product_price);
                        getvariantprice();
                    });
                    $('#minus-' + item_value).on('click', function () {
                        var quantity = parseInt($('#quantity-' + item_value).val());
                        if (quantity > 1) {
                            quantity--;
                            $('#quantity-' + item_value).val(quantity);
                            $('#product_price_id_' + item_value).text(quantity * product_price);
                            $('#price-'+item_value).val(quantity * product_price);
                            getvariantprice();
                        }
                    });

                    $("input[name='size-"+item_value+"']").on('change', function () {
                        $('#size-'+item_value).val($(this).val());
                        getvariantprice();
                    });

                    $("input[name='color-"+item_value+"']").on('change', function () {
                        $('#color-'+item_value).val($(this).val());
                        getvariantprice();
                    });
                }else{
                    $('#product_details_id_' + item_value).remove();
                    getvariantprice();
                }
            });

            $('input[name="shipping"]').on('change', function () {
                var item_value = $(this).val();
                var total_value = parseInt($('#subtotal').val()) + parseInt(item_value);
                $('#total').val(total_value);
                $('.total').text(total_value);
            });
        });
    </script>
    
    
    
   



<!-- Include Slick CSS and JS files if not already included -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
    console.log("Initializing Slick Carousel..."); // Logging to confirm initialization
    $('.aiz-carousel').slick({
        slidesToShow: 4,
        slidesToScroll: 4,
        arrows: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 1000,
        responsive: [
            { breakpoint: 1200, settings: { slidesToShow: 4, slidesToScroll: 4 }},
            { breakpoint: 992, settings: { slidesToShow: 3, slidesToScroll: 3 }},
            { breakpoint: 768, settings: { slidesToShow: 2, slidesToScroll: 2 }},
            { breakpoint: 576, settings: { slidesToShow: 1, slidesToScroll: 1 }}
        ]
    });
});

// Reinitialize on window load
$(window).on('load', function() {
    console.log("Reinitializing Slick on window load...");
    $('.aiz-carousel').slick('setPosition');
});
</script>



    

</body>
<script src="https://chir.ag/projects/ntc/ntc.js"></script>

<script type="text/javascript">
    // Customized and designed by Rohan 01751136819
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        'event': 'purchase',
        'transaction_id': '{{ $order->code }}',
        'currency': 'BDT',
        'value': {{ $order->grand_total }},
        'coupon': {{ $order->coupon_discount ?? 0 }}, // Coupon null hole 0 hobe
        'tax': {{ $order->orderDetails->sum('tax') }},
        'shipping': {{ $order->grand_total - ($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) + ($order->coupon_discount ?? 0) }},
        'customer_name': '{{ $order->user->name }}',
        'customer_email': '{{ $order->user->email }}',
        'customer_phone': '{{ $order->user->phone }}',
        'customer_address': '{{ json_decode($first_order->shipping_address)->address }}',
        'items': [
            @foreach ($order->orderDetails as $key => $orderDetail)
                @php
                    $colorName = \App\Models\Color::where('code', json_decode($orderDetail->variation)->color)->pluck('name')->first();
                @endphp
                {
                    'item_id': '{{ $orderDetail->product_id }}',
                    'item_name': '{{ $orderDetail->product->name }}',
                    'item_category': '{{ $orderDetail->product->category->name }}',
                    'brand': '{{ $orderDetail->product->brand->name }}',
                    'discount': '{{ $orderDetail->product->discount ?? 0 }}', // Discount null hole 0 hobe
                    'index': '{{ $orderDetail->product->tags }}',
                    'item_variant_color': '{{ $colorName }}',
                    'item_variant_size': '{{ json_decode($orderDetail->variation)->size }}',
                    'main_price': '{{ $orderDetail->price }}',
                    'price': '{{ $orderDetail->price }}',
                    'quantity': '{{ $orderDetail->quantity }}'
                }@if(!$loop->last),@endif
            @endforeach
        ]
    });
</script>










{{--
<script type="text/javascript">
    // # customize and design by Rohan 01751136819
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        'event': 'Purchase',
        'transaction_id': '{{$order->code}}',
        'currency': 'BDT',
        'value': {{$order->grand_total}},
        'coupon': {{$order->coupon_discount}},
        'tax': {{$order->orderDetails->sum('tax')}},
        'shipping': {{$order->orderDetails->sum('shipping_cost')}},
        'customer_name': '{{$order->user->name}}',
        'customer_email': '{{$order->user->email}}',
        'customer_phone': '{{$order->user->phone}}',
        'customer_address': '{{json_decode($first_order->shipping_address)->address}}',
        'items': [
            @foreach ($order->orderDetails as $key => $orderDetail)
            {
                'item_id': '{{$orderDetail->product_id}}',
                'item_name': '{{$orderDetail->product->name}}',
                'item_category': '{{$orderDetail->product->category->name}}',
                'brand': '{{$orderDetail->product->brand->name}}',
                'discount': '{{$orderDetail->product->discount}}',
                'index': '{{$orderDetail->product->tags}}',
                'item_variant_color': '{{json_decode($orderDetail->variation)->color}}',
                'item_variant_size': '{{json_decode($orderDetail->variation)->size}}',
                'mian_price': '{{$orderDetail->price}}',
                'price': '{{$orderDetail->price}}',
                'quantity': '{{$orderDetail->quantity}}'
            },
            @endforeach
        ]
    });
</script> --}}
</html>
