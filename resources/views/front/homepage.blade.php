@extends('front.layouts.master')

@section('title','Anasayfa')

@section('content')
            <div class="col-md-9 mx-auto">
                @foreach ($articles as $article )

                <!-- Post preview-->
                <div class="post-preview">
                    <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
                        <h2 class="post-title">{{$article->title}}
                        </h2>
                        <img src="{{$article->image}}" class="img-fluid" alt="Responsive image">
                        <h3 class="post-subtitle">{!!Str::limit($article->content,50)!!}
                        </h3>
                    </a>
                    <p class="post-meta">
                        Kategori :
                        <a href="#">
                            {{$article->getCategory->name}}
                        </a>
                        <span class="float-end">
                            {{$article->created_at->diffForHumans()}}
                        </span>
                    </p>
                </div>
                @if (!$loop->last)

                <!-- Divider-->
                <hr class="my-4" />

                @endif
                @endforeach
            </div>
    @include('front.widgets.categoryWidget')
@endsection
