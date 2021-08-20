@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            @include('forms.search')
            @foreach($articles as $article)
                <div class="mb-3">
                    <h2>{{ $article->title }}</h2>
                    <p class="m-0">{{ $article->body }}</p>
                    @isset($article->tags)
                        <div style="display: flex;">
                            @foreach($article->tags as $tag)
                                <p style="margin-right: 10px">{{ $tag->name }}</p>
                            @endforeach
                        </div>
                    @endisset
                </div>
            @endforeach
        </div>
    </div>
@endsection
