@extends('back.layout.master')

@section('title','Silinen Makaleler')

@section('content')

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left"><span>@yield('title')</span></h6>
        <h6 class="m-0 font-weight-bold text-primary float-right">
          <span>{{$articles->count()}}</span> Silinmiş Makale Bulundu.
          <a href="{{route('admin.makaleler.index')}}" class="btn btn-outline-info btn-sm">
            <i class="fa fa-chevron-left"> Makalelere Dön</i>
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
                          <th>Kategori</th>
                          <th>Hit</th>
                          <th>Oluşturma Tarihi</th>
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
                            <a href="{{route('admin.recovery.article',$article->id)}}" title="Kurtar" class="btn btn-md btn-primary"><i class="fa fa-recycle"></i></a>
                            <a href="{{route('admin.hard.delete.article',$article->id)}}" title="Sil" class="btn btn-md btn-danger"><i class="fa fa-trash"></i></a>
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
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection
