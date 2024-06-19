@extends('web.layouts.app')
@section('content')
  <div id="nt_content mt__10">

    <x-site.def.breadcrumbs>
      {{ Breadcrumbs::render('search',$meta) }}
    </x-site.def.breadcrumbs>

    <div class="container mb__20">
      <livewire:site.serach type="off_page"/>
    </div>


    <div class="container mt__30 mb__20">
      <x-temp.footer-icon/>
    </div>

  </div>
@endsection
