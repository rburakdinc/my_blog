@extends('front.layouts.master')
@section('title',$category->name. ' Kategorisi')
@section('content')

    <div class="col-md-9 mx-auto">
        @if(count($articles)>0)

            @foreach($articles as $article)
                <!-- Post preview-->
                    <div class="post-preview">

                        <a href="{{ route('single', [$article->id]) }}">
                            <h2 class="post-title">
                                {{$article->text}}
                            </h2>
                            <img src="{{asset($article->image)}}">
                            <h3 class="post-subtitle">
                                {{($article->content)}}
                            </h3>
                        </a>
                        <p class="post-meta">Kategori:
                            <a href="#">{{$article->getCategory->name}}</a>
                            <span class="float-right"> {{$article->created_at->diffForHumans()}}</span></p>

                    </div>
                    <hr>

            @endforeach
                {{$articles->links('pagination::bootstrap-4')}}
       @else
        <div class="alert alert-danger">
            <h1>Bu kategoriye ait makale bulunamadı.</h1>
            @endif
    </div>
    <!-- Divider-->
    <hr class="my-4" />
    <!-- Pager-->

    </div>
@endsection
