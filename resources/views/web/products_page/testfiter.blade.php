@extends('web.layouts.app')
@section('content')
  <div id="nt_content" class="mt__5">
    <x-site.def.breadcrumbs>
      {{ Breadcrumbs::render('Shop',$meta) }}
    </x-site.def.breadcrumbs>

    <x-site.def.h-title :title="$meta->name"/>

    <div class="container container_cat pop_default cat_default mb__20">
      <div class="row mt__20">
        <div class="col-lg-12 order-2 col-12">

          <form method="post" action="{{route('FilterBuilder')}}">
            @csrf
            <input type="text" name="url" dir="ltr" value="{{Request::Url()}}">
            <input type="text" name="url_filter" dir="ltr" value="{{serialize(Request::all())}}">

            <div class="row">
              <div class="col-12 col-md-3 widget">
                <h5 class="widget-title">{{__('web/filter.by_price')}}</h5>
                <div class="loke_scroll">
                  <ul class="nt_filter_blockX nt_filter_styleckX css_ntbarX" data-filter_condition="or">

                    <x-temp.tools.check-box  type="3" name="rang" :row="$priceRang_Arr" />

{{--                    <input type="checkbox" name="rang" onclick="onlyOne(this)">--}}
{{--                    <input type="checkbox" name="rang" onclick="onlyOne(this)">--}}

                  </ul>
                </div>
              </div>
              <div class="col-12 col-md-3 widget">
                <h5 class="widget-title">{{__('web/filter.by_size')}}</h5>
                <div class="loke_scroll">
                  <ul class="nt_filter_block nt_filter_styleck css_ntbar" data-filter_condition="and">
                    <li><a href="#" aria-label="Narrow selection to products matching tag size s">s</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag size s">s</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag size s">s</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag size s">s</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag size s">s</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag size s">s</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag size s">s</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag size s">s</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag size s">s</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag size m">m</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag size l">l</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag size xs">xs</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag size xl">xl</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag size xxl">xxl</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-12 col-md-3 widget">
                <h5 class="widget-title">{{__('web/filter.by_brand')}}</h5>
                <div class="loke_scroll">
                  <ul class="nt_filter_block nt_filter_styleck css_ntbar" data-filter_condition="and">
                    <li><a href="#" aria-label="Narrow selection to products matching tag vendor ck">ck</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag vendor h&amp;m">h&amp;m</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag vendor kalles">kalles</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag vendor levi's">levi's</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag vendor monki">monki</a></li>
                    <li><a href="#" aria-label="Narrow selection to products matching tag vendor nike">nike</a></li>
                  </ul>
                </div>
              </div>

              <div class="col-12 tc mt__20 mb__20">
                <a class="button clear_filter_js" href="#">Clear All Filter</a>
                <button type="submit">Filter </button>
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>


  </div>
@endsection
