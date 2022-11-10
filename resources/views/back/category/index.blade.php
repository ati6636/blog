@extends('back.layout.master')

@section('title','Tüm Kategoriler')

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
            </div>
            <div class="card-body">
              <form  action="{{route('admin.category.create')}}" method="post">
                @csrf
                <div class="form-group">
                  <label for="">Kategori Adı</label>
                  <input type="text" class="form-control" name="category" required>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-md btn-primary btn-block">Ekle</button>
                </div>
              </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                              <th>Kategori Adı</th>
                              <th>Makale Sayısı</th>
                              <th>Durum</th>
                              <th>İşlemler</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                          <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->articleCount()}}</td>
                              <td>
                                <input class="switch" category-id="{{$category->id}}" type="checkbox" checked data-toggle="toggle" data-on="Aktif" data-off="Pasif" @if($category->status==1) checked @endif data-onstyle="success" data-offstyle="danger">
                              </td>
                              <td>
                              </td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@4.3.4/css/bootstrap5-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@4.3.4/js/bootstrap5-toggle.min.js"></script>
<script>
    $(function () {
        $('.switch').change(function () {
            id = $(this)[0].getAttribute('category-id');
            statu=$(this).prop('checked');
            $.get("{{route('admin.category.switch')}}", {id:id,statu:statu} , function(data, status){
                console.log(data);
  });
        })
    })
</script>
@endsection
