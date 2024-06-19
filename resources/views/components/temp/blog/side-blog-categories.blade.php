@if($isactive)
    <div class="col-12 col-md-12 widget widget_product_categories cat_count_true nt_filter_block">
        <h5 class="headline__title">{{__('web/blog.side_blog_categories')}}</h5>
        <ul class="product-categories">
            @foreach($categories as $category)
                @if($category->blogs_count > 0)
                    <li class="cat-item">
                        <a href="{{route('BlogCategoryView',$category->slug)}}">{{$category->name}}<span class="cat_count"> ({{$category->blogs_count}}) </span></a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif