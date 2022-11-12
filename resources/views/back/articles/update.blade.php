@extends('back.layout.master')

@section('title',$article->title . ' Makalesini Güncelle')

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
        <form action="{{route('admin.makaleler.update',$article->id)}}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @csrf
            <div class="form-group">
                <label for="">Makale Başlığı</label>
                <input type="text" name="title" class="form-control" value="{{$article->title}}" required>
            </div>
            <div class="form-group">
                <label for="">Makale Kategori</label>
                <select name="category" class="form-control" required>
                    <option value="">Seçim Yapınız</option>
                    @foreach ($categories as $category)
                    <option @if ($article->category_id==$category->id) selected @endif value="{{$category->id}}">
                      {{$category->name}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Makale Fotoğrafı</label><br>
                <img class="img-fluid img-thumbnail rounded mb-2" width="300" src="{{asset($article->image)}}" alt="Responsive image">
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Makale İçeriği</label>
                <textarea name="content" id="editor" class="ckeditor form-control" rows="8" >{!! $article->content !!}</textarea>
            </div>
                <button type="submit" class="btn btn-primary btn-block" >Makale'yi Güncelle</button>
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
