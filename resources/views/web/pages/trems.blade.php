@extends('web.layouts.app')
@section('content')
  <div id="nt_content" class="mt__5">
    <x-site.def.breadcrumbs>
      {{ Breadcrumbs::render('Trems',$meta) }}
    </x-site.def.breadcrumbs>

    <x-site.def.h-title :title="$meta->name" :p="$meta->des"/>

    <div class="container container_body mb__50">

      @foreach($webPrivacy as $privacy)
        <div class="webPrivacy">
          @if($privacy->h1)
            <h2> {!! ChangeText($privacy->h1) !!}</h2>
          @endif
          @if($privacy->h2)
            <h3> {!! ChangeText($privacy->h2) !!}</h3>
          @endif

          @if($privacy->des)
            <p> {!! nl2br(ChangeText($privacy->des)) !!}</p>
          @endif

          @if($privacy->lists)
            <ul>
              @foreach(explode(PHP_EOL, $privacy->lists) as $list)
                <li> {!! ChangeText($list) !!}</li>
              @endforeach
            </ul>
          @endif

        </div>
      @endforeach
    </div>
  </div>
@endsection
