@extends('front.layouts.master')

@section('title','iletişim')
@section('bg',asset('front/assets/img/contact-bg.jpg'))

@section('content')

        <div class="col-md-8">
          @if(session('success'))
          <div class="alert alert-success">
            {{session('success')}}
          </div>
          @endif
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>
          @endif
            <p>Bizimle İletişime Geçebilirsiniz.</p>
                <form method="post" action="{{route('contact.post')}}">
                  @csrf
                    <div class="form-floating">
                        <input class="form-control" name="name" value="{{old('name')}}" id="name" type="text" placeholder="Adınız ve Soyadınız...." data-sb-validations="required" />
                        <label for="name">Adınız Soyadınız</label>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" name="email" value="{{old('email')}}" id="email" type="email" placeholder="Email Adresiniz..." data-sb-validations="required,email" />
                        <label for="email">Email Adresiniz</label>
                    </div>
                    <div class="form-floating">
                         <select class="form-select" name="topic" id="floatingSelect" aria-label="Floating label select example">
                          <option></option>
                          <option @if(old('topic')=='Bilgi') selected @endif>Bilgi</option>
                          <option @if(old('topic')=='Destek') selected @endif>Destek</option>
                          <option @if(old('topic')=='Genel') selected @endif>Genel</option>
                        </select>
                        <label for="topic" class="fs-3">Konu</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="message" id="message" placeholder="Mesajınız..." style="height: 12rem" data-sb-validations="required">{{old('message')}}</textarea>
                        <label for="message">Mesajınız</label>
                    </div>
                    <br />
                    <button class="btn btn-primary text-uppercase" type="submit">Gönder</button>
                </form>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              This is some text within a card body.
            </div>
          </div>
        </div>
@endsection
