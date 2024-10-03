<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(Route::currentRouteName() == "BlogTagView" or  Route::currentRouteName() == 'ProductsTagView')
        <meta name="robots" content="noindex, nofollow">
    @else
        <meta name="robots" content="index, follow">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEO::generate() !!}
    <x-site.def.fav-icon/>
{!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/drift-basic.min.css',$cssMinifyType,$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/flickity-fade.css',$cssMinifyType,$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/font-icon.min.css',$cssMinifyType,$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/bootstrap.min.css',$cssMinifyType,$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/reset.css',$cssMinifyType,$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/defined.css',$cssMinifyType,$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/base.css',$cssMinifyType,$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/style.css',$cssMinifyType,$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/home-bags.css',$cssMinifyType,$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/shop.css',"Seo",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('css/home_page.css',"Seo",$cssReBuild) !!}
@yield('AddStyle')
@stack('StyleFile')

@if(thisCurrentLocale() == 'ar')
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/rtl.css',$cssMinifyType,$cssReBuild) !!}
@endif
{!! (new \App\Helpers\MinifyTools)->MinifyCss('css/style_edit.css',"Seo",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('css/profile.css',"Seo",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('css/form.css',"Seo",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('css/products_view.css',"Seo",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('css/cart_view.css',"Seo",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('css/blog_view.css',"Seo",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyCss('css/style_lang_'.thisCurrentLocale().'.css',"Seo",$cssReBuild) !!}
@livewireStyles

<!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PG7D4NS');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body class="{{htmlBodyStyle($pageView)}}">

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PG7D4NS"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="nt_wrapper">
    <header id="ntheader" class="ntheader header_3 h_icon_la">
        <div class="kalles-header__wrapper ntheader_wrapper pr z_200">
            @include('web.layouts.inc.header_top')
            @include('web.layouts.inc.header_menu')
        </div>
    </header>
    @yield('content')
    @include('web.layouts.inc.footer')
</div>

<div class="mask-overlay ntpf t__0 r__0 l__0 b__0 op__0 pe_none"></div>

@if(issetArr($WebConfig,"serach",1))
    @if(issetArr($WebConfig,"serach_type",null))
        <div id="nt_search_canvas" class="nt_fk_full dn tl tc_lg">
            <livewire:site.serach/>
        </div>
    @endif
@endif

<div id="nt_cart_canvas" class="nt_fk_canvas dn">
    <div class="nt_mini_cart nt_js_cart flex column h__100 btns_cart_1">
        <div class="mini_cart_header flex fl_between al_center">
            <div class="h3 fwm tu fs__16 mg__0">{{__('web/cart.title_h1')}}</div>
            <i class="close_pp pegk pe-7s-close ts__03 cd"></i>
        </div>
        <livewire:site.cart.sidebar-cart/>
    </div>
</div>

@include('web.layouts.quick.login')
@include('web.layouts.quick.mobile_toolbar')
@include('web.layouts.quick.mobile_menu')
{{--@include('web.layouts.quick.promo')--}}

{{--<a id="nt_backtop" class="pf br__50 z__100 des_bt2" href="#"><span class="tc br__50 db cw"><i class="pr pegk pe-7s-angle-up"></i></span></a>--}}

@if( Route::currentRouteName() == 'ProductView')
    <x-temp.footer-call :config="$WebConfig" :product="$product"/>
@else
    <x-temp.footer-call :config="$WebConfig"/>
@endif


{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/jquery-3.5.1.min.js',"Web",false) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/bootstrap.min.js',"Web",false) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/nouislider.min.js',"Web",false) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('js/lazy/jquery.lazy.min.js',"SeoWeb",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('js/lazy/lazy_fun.js',"Seo",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/jarallax.min.js',"Web",false) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/packery.pkgd.min.js',"Web",false) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/jquery.hoverIntent.min.js',"Web",false) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/magnific-popup.min.js',"Web",false) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/flickity.pkgd.min.js',"Web",false) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/lazysizes_new.min.js',"Web",false) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/js-cookie.min.js',"Web",false) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/jquery.countdown.min.js',"Web",false) !!}
@yield('TempScript')
{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/interface_new_2.js',"Web",false) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('share/share-buttons.js',"Seo",$cssReBuild) !!}

<x-site.js.load-web-font/>
@livewireScripts
<script>
    document.addEventListener('livewire:load', () => {
        Livewire.onPageExpired((response, message) => {
        })
    })
</script>
@yield('AddScript')
@stack('ScriptCode')
{!! $printSchema->Businesses() !!}
</body>
</html>
