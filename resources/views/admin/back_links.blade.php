@extends('admin.layouts.app')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">



      </div>
    </div>
  </div>

  <x-admin.hmtl.section>
      <div class="row mb-3 dir_button">
          <div class="col-12">
              <x-admin.form.action-button url="{{route('admin.listBackLink')}}" print-lable=" العلامات التجارية" :tip="false" />
              <x-admin.form.action-button url="{{route('admin.listBackLinkBlog')}}" print-lable="المقالات" :tip="false" />
              <x-admin.form.action-button url="{{route('admin.listBackLinkProduct')}}" print-lable="المنتجات" :tip="false" />
              <x-admin.form.action-button url="{{route($newScan)}}" bg="d" print-lable="New Scan {{ count($links) }}" :tip="false" />
          </div>
      </div>
  </x-admin.hmtl.section>

  <x-admin.hmtl.section>
      <div class="card">
          <div class="card-header">
              <h3 class="card-title">Back Links</h3>
          </div>

          <div class="card-body p-0">
              <table class="table table-striped">
                  <thead>
                  <tr>
                      <th style="width: 600px">Url</th>
                      <th>Type</th>
                      <th>Category</th>
                      <th>Id</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($links as $link)
                      <tr>
                          <td style="direction: ltr">{{urldecode($link->href)}}</td>
                          <td style="direction: ltr">{{urldecode($link->type)}}</td>
                          <td style="direction: ltr">{{urldecode($link->cat)}}</td>
                          <td style="direction: ltr"><a href="{{route($editRoute,$link->href_id)}}">{{$link->href_id}} تعديل </a></td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>

      </div>
  </x-admin.hmtl.section>
@endsection

