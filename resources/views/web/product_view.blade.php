@extends('web.layouts.app')
@section('AddStyle')
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/single-masonry-theme.css',$cssMinifyType,$cssReBuild) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/single-product.css',$cssMinifyType,$cssReBuild) !!}
@endsection
@section('TempScript')
    {!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/photoswipe.min.js',"Web",false) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/photoswipe-ui-default.min.js',"Web",false) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/drift.min.js',"Web",false) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/isotope.pkgd.min.js',"Web",false) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/resize-sensor.min.js',"Web",false) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/theia-sticky-sidebar.min.js',"Web",false) !!}
@endsection
@section('content')
    <div id="nt_wrapper">
        <div id="nt_content mt__10">
            <x-site.def.breadcrumbs>
                {{ Breadcrumbs::render('ProductView',$product) }}
            </x-site.def.breadcrumbs>
            <div class="container mt-5">
                <textarea style="direction: ltr">{!! $printSchema->Product($product,"") !!}</textarea>
            </div>



            <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "sku": "trinket-12345",
        "image": [
        "https://example.com/photos/16x9/trinket.jpg",
        "https://example.com/photos/4x3/trinket.jpg",
        "https://example.com/photos/1x1/trinket.jpg"
        ],
        "name": "Nice trinket",
        "description": "Trinket with clean lines",
        "brand": {
        "@type": "Brand",
        "name": "MyBrand"
    },
        "offers": {
        "@type": "Offer",
        "url": "https://www.example.com/trinket_offer",
        "itemCondition": "https://schema.org/NewCondition",
        "availability": "https://schema.org/InStock",
        "price": 39.99,
        "priceCurrency": "USD",
        "priceValidUntil": "2024-11-20",
       "hasMerchantReturnPolicy": {
        "@type": "MerchantReturnPolicy",
        "applicableCountry": "CH",
        "returnPolicyCategory": "https://schema.org/MerchantReturnFiniteReturnWindow",
        "merchantReturnDays": 60,
        "returnMethod": "https://schema.org/ReturnByMail",
        "returnFees": "https://schema.org/FreeReturn"
    },
        "shippingDetails": {
        "@type": "OfferShippingDetails",
        "shippingRate": {
        "@type": "MonetaryAmount",
        "value": 3.49,
        "currency": "USD"
    },

        "shippingDestination": {
        "@type": "DefinedRegion",
        "addressCountry": "US"
    },
        "deliveryTime": {
        "@type": "ShippingDeliveryTime",
        "handlingTime": {
        "@type": "QuantitativeValue",
        "minValue": 0,
        "maxValue": 1,
        "unitCode": "DAY"
    },
        "transitTime": {
        "@type": "QuantitativeValue",
        "minValue": 1,
        "maxValue": 5,
        "unitCode": "DAY"
    }
    }
    }
    },
        "review": {
        "@type": "Review",
        "reviewRating": {
        "@type": "Rating",
        "ratingValue": 4,
        "bestRating": 5
    },
        "author": {
        "@type": "Person",
        "name": "Fred Benson"
    }
    },
        "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": 4.4,
        "reviewCount": 89
    }

    }

</script>


            {{--            <script type="application/ld+json">--}}
{{--{--}}
{{--  "@context": "https://schema.org/",--}}
{{--  "@type": "Product",--}}
{{--  "name": "https://cottton.shop/",--}}
{{--  "image": "https://freestyle4u.net/cottonShop/public/wp-content/uploads/2021/07/%D9%85%D8%B1%D8%AA%D8%A8%D8%A9-%D8%AC%D9%88%D9%84%D8%AF%D9%86-%D8%A7%D9%84%D9%85%D8%A3%D9%85%D9%88%D9%86.jpg",--}}
{{--  "description": "description",--}}
{{--  "brand": {--}}
{{--    "@type": "Brand",--}}
{{--    "name": "barnd"--}}
{{--  },--}}
{{--  "sku": "555555",--}}
{{--  "offers": {--}}
{{--    "@type": "Offer",--}}
{{--    "url": "url",--}}
{{--    "priceCurrency": "EGP",--}}
{{--    "price": "1500",--}}
{{--    "priceValidUntil": "2024-07-31",--}}
{{--"shippingDetails": {--}}
{{--          "@type": "OfferShippingDetails",--}}
{{--          "shippingRate": {--}}
{{--            "@type": "MonetaryAmount",--}}
{{--            "value": 3.49,--}}
{{--            "currency": "USD"--}}
{{--          },--}}
{{--          "shippingDestination": {--}}
{{--            "@type": "DefinedRegion",--}}
{{--            "addressCountry": "US"--}}
{{--          },--}}
{{--          "deliveryTime": {--}}
{{--            "@type": "ShippingDeliveryTime",--}}
{{--            "handlingTime": {--}}
{{--              "@type": "QuantitativeValue",--}}
{{--              "minValue": 0,--}}
{{--              "maxValue": 1,--}}
{{--              "unitCode": "DAY"--}}
{{--            },--}}
{{--            "transitTime": {--}}
{{--              "@type": "QuantitativeValue",--}}
{{--              "minValue": 1,--}}
{{--              "maxValue": 5,--}}
{{--              "unitCode": "DAY"--}}
{{--            }--}}
{{--          }--}}
{{--        }--}}
{{--      },--}}

{{--    "availability": "https://schema.org/InStock",--}}
{{--    "itemCondition": "https://schema.org/NewCondition"--}}
{{--  }--}}
{{--}--}}


{{--            </script>--}}


            <div class="sp-single sp-single-1 des_pr_layout_1 mb__60">
                <div class="container container_cat cat_default  d-noneX">
                    <div class="row product mt__10">
                        <div class="col-md-12 col-12 thumb_left">
                            <div class="row mb__10 pr_sticky_content this_product_view">
                                <x-temp.products.product-slider :product="$product" :product-info="$productInfo"/>


                                <div class="col-md-6 col-12 product-infors pr_sticky_su ">
                                    <div class="theiaStickySidebar">
                                        <div class="kalles-section-pr_summary kalles-section summary entry-summary">

                                            <h1 class="headline__title">{{$product->name}}</h1>

                                            <livewire:site.cart.add-to-cart-but :product="$product" :key="$product->id" :product-info="$productInfo"/>

                                            <x-temp.products.product-meta :product="$product"/>

                                            <x-temp.social-share :row="$product"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-temp.products.description-tab :product="$product"/>

                <div class="clearfix"></div>
                <x-temp.products.recently-slider :products="$related" :title="__('web/product.slider_related_product')"/>
                <x-temp.products.recently-slider :products="$recently" :title="__('web/product.slider_recently')"/>
            </div>
        </div>
    </div>
@endsection
