@extends('web.layouts.app')
@section('content')

    <div id="nt_content mt__10">

        <x-site.def.breadcrumbs>
            {{ Breadcrumbs::render('BrandView',$brand) }}
        </x-site.def.breadcrumbs>

        <div class="container container_cat pop_default cat_default mb__20">

            <x-temp.tools.filter-toolbar :filter-data="$filterData"/>

            <div class="row">

                <div class="js_sidebar sidebar sidebar_nt col-lg-3 order-1  col-12 space_30 hidden_false lazyload">
                    <x-temp.tools.side-bar :category-view="false" :brand-limit="40"/>
                </div>

                <div class="col-lg-9 order-2 col-12">
                    <x-temp.tools.filte-result :products="$products"/>

                    <div class="kalles-section tp_se_cdt">

                        <h1 class="headline__title">{{$brand->name}}</h1>
                        <div class="{{$proStyle['cardStyleHolder']}}">
                            @foreach($products as $product)
                                <x-temp.products.card :product="$product"/>
                            @endforeach
                        </div>


                        <div class="products-footer tc mt__40">
                            <x-site.def.pagination :rows="$products"/>
                        </div>

                    <div class="products-footer BrandDesView">
                        {!! cleanDes($brand->des)  !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>


    <div id="nt_content" class="mt__50">
        <x-temp.footer-icon/>
    </div>


@endsection
