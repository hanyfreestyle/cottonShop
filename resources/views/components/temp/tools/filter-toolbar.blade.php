<div class="cat_toolbar row fl_center al_center">
  @if($filterby)
    <div class="cat_filter col op__0 pe_none">
      <a href="#" data-opennt="#kalles-section-nt_filter" data-pos="left" data-remove="true" data-class="popup_filter" data-bg="hide_btn" class="has_icon btn_filter mgr">
        <i class="iccl fwb iccl-filter fwb mr__5"></i>{{__('web/filter.but_filter')}}</a>
      <a href="#" data-id="#kalles-section-nt_filter" class="btn_filter js_filter dn mgr"><i class="iccl fwb iccl-filter fwb mr__5"></i>{{__('web/filter.but_filter')}}</a>
    </div>
  @else
    <div class="cat_filter col op__0 pe_none"></div>
  @endif

  @if($colby)
    <div class="cat_view col-auto on_list_view_false">
      <div class="dn dev_desktop">
        <a href="#" data-mode="grid" data-dev="dk" data-col="6" class="pr mr__10 cat_view_page view_6"></a>
        <a href="#" data-mode="grid" data-dev="dk" data-col="4" class="pr mr__10 cat_view_page view_4 active"></a>
        <a href="#" data-mode="grid" data-dev="dk" data-col="3" class="pr mr__10 cat_view_page view_3"></a>
      </div>
      <div class="dn dev_tablet dev_view_cat">
        <a href="#" data-dev="tb" data-col="6" class="pr mr__10 cat_view_page view_6"></a>
        <a href="#" data-dev="tb" data-col="4" class="pr mr__10 cat_view_page view_4"></a>
        <a href="#" data-dev="tb" data-col="3" class="pr cat_view_page view_3"></a>
      </div>
      <div class="flex dev_mobile dev_view_cat">
        <a href="#" data-dev="mb" data-col="12" class="pr mr__10 cat_view_page view_12"></a>
        <a href="#" data-dev="mb" data-col="6" class="pr cat_view_page view_6"></a>
      </div>
    </div>
  @endif


  @if($sortby)
    <div class="cat_sortby cat_sortby_js col tr kalles_dropdown kalles_dropdown_container">
      <a class="in_flex fl_between al_center sortby_pick kalles_dropDown_label" href="#">
        <span class="lbl-title sr_txt dn">{{__('web/sort.sort_by')}}</span>
        <span class="lbl-title sr_txt_mb">{{__('web/sort.sort_by')}}</span>
        <i class="ml__5 mr__5 facl facl-angle-down"></i>
      </a>
      <div class="nt_sortby dn">
        <svg class="ic_triangle_svg" viewBox="0 0 20 9" role="presentation">
          <path
           d="M.47108938 9c.2694725-.26871321.57077721-.56867841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z"
           fill="#ffffff"></path>
        </svg>
        <div class="h3 mg__0 tc cd tu ls__2 dn_lg db">{{__('web/sort.sort_by_title')}}<i class="pegk pe-7s-close fs__50 ml__5"></i>
        </div>


        <x-temp.tools.sort-by-list/>

      </div>
    </div>
  @endif

</div>

@if($filterby)



  <div class="filter_area_jsX filter_area lazyload">
    <div id="kalles-section-nt_filter" class="kalles-section nt_ajaxFilterX section_nt_filter">
      <div class="h3 mg__0 tu bgb cw visible-sm fs__16 pr">{{__('web/filter.but_filter')}}<i class="close_pp pegk pe-7s-close fs__40 ml__5"></i></div>
      <div class="cat_shop_wrap">
        <div class="cat_fixcl-scroll">
          <div class="cat_fixcl-scroll-content css_ntbar">

            <form method="post" id="FilterBuilder" action="{{route('FilterBuilder')}}">
              @csrf
              <input type="hidden" name="url" dir="ltr" value="{{Request::Url()}}">
              <input type="hidden" name="url_filter" dir="ltr" value="{{serialize(Request::all())}}">
              <div class="row wrap_filter">

                <div class="col-12 col-md-3 widget">
                  <h5 class="widget-title">{{__('web/filter.title_price')}}</h5>
                  <div class="loke_scroll">
                    <ul class="nt_filter_block nt_filter_styleck css_ntbar" data-filter_condition="or">
                      <x-temp.tools.check-box type="3" name="rang" :row="$priceRang_Arr"/>
                    </ul>
                  </div>
                </div>

                @if(isset($filterData['brand']) and count($filterData['brand']) > 0 )
                  <div class="col-12 col-md-3 widget">
                    <h5 class="widget-title">{{__('web/filter.title_brand')}}</h5>
                    <div class="loke_scroll">
                      <ul class="nt_filter_block nt_filter_styleck css_ntbar" data-filter_condition="or">
                        @foreach($filterData['brand'] as $id => $count)
                          <x-temp.tools.check-box type="2" name="brand" :id="$id" :count="$count" :label="$CashBrandMenuList->where('id',$id)->first()->name ?? '' "/>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                @endif


                @if(isset($filterData['categories']) and count($filterData['categories']) > 0 )
                  <div class="col-12 col-md-3 widget">
                    <h5 class="widget-title">{{__('web/filter.title_category')}}</h5>
                    <div class="loke_scroll">
                      <ul class="nt_filter_block nt_filter_styleck css_ntbar" data-filter_condition="or">
                        @foreach($filterData['categories'] as $category)
                          <x-temp.tools.check-box type="1" name="category" :row="$category"/>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                @endif

                <div class="col-12 tc mt__20 mb__20 dnx">
                  <button class="mb__15" type="submit">{{__('web/filter.but_filter')}}</button>
                  @if(isset($_GET['filter']))
                    <button class="mb__15" type="submit" value="1" name="ClearFilter">{{__('web/filter.but_filter_clear')}}</button>
                  @endif
                </div>
              </div>
            </form>


          </div>
        </div>
      </div>
    </div>
  </div>


@endif
