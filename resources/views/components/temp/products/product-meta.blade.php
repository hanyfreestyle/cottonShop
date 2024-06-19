<div class="product_meta {{$from}}">

    <div class="meta_line mb__5">
        <span class="title">{{__('web/product.title_sku')}}</span>
        <span class="info">{{$product->sku}}</span>
    </div>

    @if(isset($product->brand->name))
        <div class="meta_line mb__5">
            <span class="title">{{__('web/product.title_brand')}}</span>
            <span class="info"><a href="{{route('BrandView',$product->brand->slug)}}" class="cg" title="{{$product->brand->name}}">{{$product->brand->name}}</a></span>
        </div>
    @endif

    @if(count($product->categories) > 0)
        <div class="meta_line mb__5">
            <span class="title">{{__('web/product.title_categories')}}</span>
            @foreach($product->categories as $category)
                <span class="info"><a href="{{route('ProductsCategoriesView',$category->slug)}}" class="cg" title="{{$category->name}}">{{$category->name}}</a></span>,
            @endforeach
        </div>
    @endif

    @if(count($product->tags) > 0)
        <div class="meta_line mb__5">
            <span class="title">{{__('web/product.title_tags')}}</span>
            @foreach($product->tags as $tag)
                <span class="info"><a href="{{route('ProductsTagView',$tag->slug)}}" class="cg" title="{{$tag->name}}">#{{$tag->name}}</a></span>,
            @endforeach
        </div>
    @endif

</div>