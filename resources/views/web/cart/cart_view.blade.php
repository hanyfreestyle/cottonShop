@extends('web.layouts.app')
@section('AddStyle')
  {!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/shopping-cart.css',"Seo",$cssReBuild) !!}
@endsection
@section('content')
  <div id="nt_content" class="mt__5">
    <x-site.def.breadcrumbs>
      {{ Breadcrumbs::render('Shop',$meta) }}
    </x-site.def.breadcrumbs>

    <livewire:site.cart.page-cart/>

  </div>
@endsection
