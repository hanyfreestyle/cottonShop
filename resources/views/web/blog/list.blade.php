@extends('web.layouts.app')
@section('AddStyle')
  {!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/blog.css',$cssMinifyType,$cssReBuild) !!}
@endsection
@section('content')
  <div id="nt_content">

    <x-temp.blog.top-slider :row="$postForBanner"/>


    <div class="container container_cat cat_default mt__60 mb__20">
      <div class="row nt_single_blog">

        <div class="col-lg-3 order-lg-1 order-12 col-xs-12 sidebar">
          <x-temp.blog.side-bar-widget/>
        </div>

        <div class="col-lg-9 order-lg-12 order-1 col-xs-12">
          <div class="kalles-section nt_section type_isotope">
            <div class="articles products art_des2 nt_products_holder row des_cnt_1 nt_cover ratio4_3 position_8 equal_nt">
              @foreach($posts as $post)
                <x-temp.blog.card :row="$post"/>
              @endforeach
            </div>
            <x-site.def.pagination :rows="$posts"/>
          </div>
        </div>

      </div>
    </div>

  </div>
@endsection
