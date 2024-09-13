@extends('web.layouts.app')
@section('content')
    <div id="nt_content" class="mt__5">
        <x-site.def.breadcrumbs>
            {{ Breadcrumbs::render('Trems',$page) }}
        </x-site.def.breadcrumbs>

        <x-site.def.h-title :title="$page->name"/>

        <div class="container container_body mb__50">
            {!! $page->des !!}
        </div>

    </div>
@endsection
