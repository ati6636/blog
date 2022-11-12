@extends('back.layout.master')

@section('title','Sayfa Oluştur')

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
        <form action="{{route('admin.page.create.post')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <label for="">Sayfa Başlığı</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Sayfa Fotoğrafı</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Sayfa İçeriği</label>
                <textarea name="content" id="editor" class="ckeditor form-control" rows="8"></textarea>
            </div>
                <button type="submit" class="btn btn-primary btn-block" >Sayfayı Oluştur</button>
        </form>
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
