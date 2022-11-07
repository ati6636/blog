@extends('front.layouts.master')

@section('title',$article->title)
@section('bg', $article->image)

@section('content')
        <!-- Post Content-->
                    <div class="col-md-9 mx-auto">
                        <img src="{{$article->image}}" class="img-fluid" alt="Responsive image"> <br><br>
                        {!! $article->content !!} <br><br>
                        <span class="text-danger">Okunma Sayısı : <b>{{$article->hit}}</b></span>
                    </div>
        @include('front.widgets.categoryWidget')
@endsection
