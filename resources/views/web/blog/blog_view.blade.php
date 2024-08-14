@extends('web.layouts.app')
@section('AddStyle')
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/single-blog.css',$cssMinifyType,$cssReBuild) !!}
@endsection
@section('content')

    <div id="nt_content mb__50">

        <x-site.def.breadcrumbs>
            {{ Breadcrumbs::render('BlogView',$blog) }}
        </x-site.def.breadcrumbs>

        <div class="container mt__20 mb__50">
            <div class="row nt_single_blog">

                <div class="col-lg-3 order-lg-1 order-12 col-xs-12 sidebar">
                    <x-temp.blog.side-bar-widget/>
                </div>

                <div class="col-md-9 col-xs-9">
                    <div id="kalles-section-article-template" class="kalles-section type_carousel">
                        <div class="post-content inl_cnt_js">

                            <article class="post type-post">
                                <h1 class="headline__title">{{$blog->name}}</h1>
                                <div class="blog_main_photo"><img src="{{getPhotoPath($blog->photo_thum_1,"blog","photo")}}"></div>
                                <div class="main_des_view blog_des_view_div">{!! $blog->des !!}</div>
                            </article>

                            <x-temp.blog.blog-tags :row="$blog"/>
                        </div>

                        <x-temp.social-share :row="$blog"/>

                        <x-temp.products.recently-slider :products="$related_products" :col="4" :title="__('web/blog.blog_related_products')"/>

                    </div>
                </div>
            </div>
        </div>
        {!! $printSchema->Article($blog,'BlogView') !!}
        <x-temp.blog.related-posts :row="$RelatedBlog"/>
    </div>

@endsection
