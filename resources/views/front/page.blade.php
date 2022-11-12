@extends('front.layouts.master')

@section('title',$page->title)
    @section('bg', $page->image)

    @section('content')
        <div class="col-md-9 mx-auto">
            <div class="d-flex justify-content-center text-break">
              {!! $page->content !!}
            </div>
        </div>
    @include('front.widgets.categoryWidget')
    @endsection
