@extends('front.layouts.master')
@section('title')
    Dinç Blog Sitesi
@endsection

@section('content')

        <div class="col-md-9 mx-auto-">

        @foreach($articles as $article)
            <!-- Post preview-->


            <div class="post-preview">


                <a href="{{ route('single', [$article->id]) }}">
                    <h2 class="post-title">
                        {{$article->text}}
                    </h2>
                    <img src="{{$article->image}}">

                    <h3 class="post-subtitle">
                       {!! Str::Limit($article->content,50)!!}
                    </h3>
                </a>
                <p class="post-meta">Kategori:
                    <a href="#">{{$article->getCategory->name}}</a>
                    <br>
                    <span class="float-right"> {{$article->created_at->diffForHumans()}}</span></p>

            </div>
                <hr>
        @endforeach
            {{$articles->links('pagination::bootstrap-4')}}
            </div>

@endsection
