@if(count($articles)>0)
@foreach($articles as $article)
    <!-- Post preview-->
    <div class="post-preview">

        <a href="{{ route('single', [$article->id]) }}">
            <h2 class="post-title">
                {{$article->text}}
            </h2>
            <img src="{{$article->image}}">
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
    </div>
    @else
        <div class="alert alert-danger">
            <h1>Bu kategoriye ait makale bulunamadı.</h1>
    @endif

