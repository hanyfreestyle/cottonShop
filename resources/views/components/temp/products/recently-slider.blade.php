<div class="kalles-section tp_se_cdt">
    <div class="related product-extra mt__30 lazyload">
        <div class="container">
            <h3 class="headline__title">{{$title}}</h3>
            <div class="{{$proStyle['cardStyleHolder']}} prev_next_0 btn_owl_1 dot_owl_1 dot_color_1 btn_vi_1 is-draggable"
                 data-flickity="{&quot;imagesLoaded&quot;: 0,&quot;adaptiveHeight&quot;: 0, &quot;contain&quot;: 1, &quot;groupCells&quot;: &quot;100%&quot;, &quot;dragThreshold&quot; : 5, &quot;cellAlign&quot;: &quot;left&quot;,&quot;wrapAround&quot;: true,&quot;prevNextButtons&quot;: false,&quot;percentPosition&quot;: 1,&quot;pageDots&quot;: false, &quot;autoPlay&quot; : 0, &quot;pauseAutoPlayOnHover&quot; : true, &quot;rightToLeft&quot;: false }">
                @foreach($products as  $product)
                  <x-temp.products.card :col="$col" :quick-view="false" :quick-shop="false" :product="$product"/>
                @endforeach
            </div>
        </div>
    </div>
</div>