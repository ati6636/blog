@extends('back.layout.master')

@section('title','Tüm Sayfalar')

@section('content')

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left"><span>@yield('title')</span></h6>
        <h6 class="m-0 font-weight-bold text-primary float-right">
          <span>{{$pages->count()}}</span> Sayfa Bulundu.
            <i class="fa fa-trash"> Silinen Makaleler</i>
          </a>
        </h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Fotoğraf</th>
                          <th>Makale Başlığı</th>
                          <th>Durum</th>
                          <th>İşlemler</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($pages as $page)
                      <tr>
                          <td><img src="{{$page->image}}" width='200'></td>
                          <td>{{$page->title}}</td>
                          <td>
                            <input class="switch" page-id="{{$page->id}}" type="checkbox"  data-toggle="toggle" data-on="Aktif" data-off="Pasif" @if($page->status==1) checked @endif data-onstyle="success" data-offstyle="danger">
                          </td>
                          <td>
                            <a target="_blank" href="{{route('page',$page->slug)}}" title="Görüntüle" class="btn btn-md btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('admin.page.edit',$page->id)}}" title="Düzenle" class="btn btn-md btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{route('admin.page.delete',$page->id)}}" title="Sil" class="btn btn-md btn-danger"><i class="fa fa-trash"></i></a>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@4.3.4/css/bootstrap5-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@4.3.4/js/bootstrap5-toggle.min.js"></script>
<script>
    $(function () {
        $('.switch').change(function () {
            id = $(this)[0].getAttribute('page-id');
            statu=$(this).prop('checked');
            $.get("{{route('admin.page.switch')}}", {id:id,statu:statu} , function(data, status){});
        })
    })
</script>
@endsection
