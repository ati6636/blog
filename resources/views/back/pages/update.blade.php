@extends('back.layout.master')

@section('title',$page->title . ' Sayfasını Güncelle')

@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left"><span>@yield('title')</span></h6>
    </div>
    <div class="card-body">
      @if($errors->any())
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </div>
      @endif
        <form action="{{route('admin.page.edit.post',$page->id)}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <label for="">Sayfa Başlığı</label>
                <input type="text" name="title" class="form-control" value="{{$page->title}}" required>
            </div>
            <div class="form-group">
                <label for="">Sayfa Fotoğrafı</label><br>
                <img class="img-fluid img-thumbnail rounded mb-2" width="300" src="{{asset($page->image)}}" alt="Responsive image">
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Sayfa İçeriği</label>
                <textarea name="content" id="editor" class="ckeditor form-control" rows="8" >{!! $page->content !!}</textarea>
            </div>
                <button type="submit" class="btn btn-primary btn-block" >Sayfayı Güncelle</button>
        </form>
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection
