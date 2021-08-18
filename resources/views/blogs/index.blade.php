@extends('layouts.frontend.layout')
@section('title', 'Pen-It')
@section('page-level-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css"/>
@endsection
@section('header')
    <header class="pt100 pb100 parallax-window-2" data-parallax="scroll" data-speed="0.5"
        data-image-src="{{ asset('frontend/assets/img/bg/img-bg-17.jpg') }}" data-positiony="1000">
        <div class="intro-body text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 pt50">
                        <h1 class="brand-heading font-montserrat text-uppercase color-light" data-in-effect="fadeInDown">
                            Pen-It
                            <small class="color-light alpha7">Heaven for Bloggers!</small>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('main-content')
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-6 col-sm-6 col-xs-12 mb50">
                <h4 class="blog-title"><a href="{{route('blogs.show', $post->id)}}">{{ $post->title }}</a></h4>
                <div class="blog-three-attrib">
                    <span class="icon-calendar"></span> {{ $post->published_at->diffForHumans() }} |
                    <span class=" icon-pencil"></span><a href="#">{{ $post->author->name }}</a> |
                    {{ $post->views_count }} views
                </div>
                <img src={{ asset("$post->image_path") }} class="img-responsive" alt="image blog">
                <p class="mt25">
                    {{ $post->excerpt }}
                </p>
                <a href="{{route('blogs.show', $post->id)}}" class="button button-gray button-xm">Read More <i class="fa fa-long-arrow-right"></i></a>
            </div>
        @endforeach
    </div>
    {{ $posts->appends(['search' => request('search')])->links('vendor.pagination.simple-default') }}

@endsection
