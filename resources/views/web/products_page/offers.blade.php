@extends('web.layouts.app')
@section('content')
  <div id="nt_content" class="mt__5">
    <x-site.def.breadcrumbs>
      {{ Breadcrumbs::render('Offers',$meta) }}
    </x-site.def.breadcrumbs>

    <x-site.def.h-title :title="$meta->name" :p="$meta->des"/>

    <div class="container container_body mb__50 ">

    </div>

  </div>
@endsection
