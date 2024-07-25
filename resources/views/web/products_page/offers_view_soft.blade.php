@extends('web.layouts.app_soft')
@section('content')

    <div id="nt_content mt__10">

        <x-site.def.breadcrumbs>
            {{ Breadcrumbs::render('OffersView',$offer) }}
        </x-site.def.breadcrumbs>




        <div class="container container_cat pop_default cat_default mb__20">

            <div class="row">


                <div class="col-lg-12 col-12 mt-3">
                    <x-site.def.h-title :title="$offer->name"/>

                    <div class="kalles-section tp_se_cdt">
                        @if($offer->desup)
                            <div class="products-footer BrandDesView">
                                {!! cleanDes($offer->desup)  !!}
                            </div>
                        @endif
                        <div class="{{$proStyle['cardStyleHolder']}}">
                            @foreach($products as $product)
                                <x-temp.products.card :product="$product" :quick-view="false" col="3"/>
                            @endforeach
                        </div>
                        @if($offer->des)
                            <div class="products-footer BrandDesView mt-5">
                                {!! cleanDes($offer->des)  !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="nt_content" class="mt__50">
        <x-temp.footer-icon/>
    </div>

@endsection
