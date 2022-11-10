@extends('back.layout.master')

@section('title','Tüm Makaleler')

@section('content')

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left"><span>@yield('title')</span></h6>
        <h6 class="m-0 font-weight-bold text-primary float-right"><span>{{$articles->count()}}</span> Makale Bulundu... </h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Fotoğraf</th>
                          <th>Makale Başlığı</th>
                          <th>Kategori</th>
                          <th>Hit</th>
                          <th>Oluşturma Tarihi</th>
                          <th>Durum</th>
                          <th>İşlemler</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($articles as $article)
                      <tr>
                          <td><img src="{{$article->image}}" width='200'></td>
                          <td>{{$article->title}}</td>
                          <td>{{$article->getCategory->name}}</td>
                          <td>{{$article->hit}}</td>
                          <td>{{$article->created_at->diffForHumans()}}</td>
                          <td>
                            <input class="switch" article-id="{{$article->id}}" type="checkbox" checked data-toggle="toggle" data-on="Aktif" data-off="Pasif" @if($article->status==1) checked @endif data-onstyle="success" data-offstyle="danger">
                          </td>
                          <td>
                            <a href="#" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('admin.makaleler.edit',$article->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="#" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
            id = $(this)[0].getAttribute('article-id');
            statu=$(this).prop('checked');
            $.get("{{route('admin.switch')}}", {id:id,statu:statu} , function(data, status){
                console.log(data);
  });
        })
    })
</script>
@endsection
