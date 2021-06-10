@extends('layouts.master')

@section('metas')
  <meta property="og:site_name" content="{{ config('app.name') }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">
  <meta property="og:title" content="{{ $article->title }}">
  <meta property="og:description" content="{{ $article->text }}">
  <meta property="og:image" content="{{ asset('uploads/'.$article->image) }}">
@stop

@section('content')
  <div class="container">
    <div class="row article">
      <h1>{{ $article->title }}</h1>
      @if(!empty($article->date)
        <h5>{{ $article->formatDate() }}</h5>
      @endif
      <div class="image">
        <img src="{{ asset('uploads/' . $article->image) }}" alt="">
        {!! $article->text !!}
      </div>
      
     
    </div>
  </div>
@endsection


