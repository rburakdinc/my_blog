   @extends('front.layouts.master')
   @section('title',$article->title)
   @section('content')

                <div class="col-md-9 mx-auto">
                    {!! $article->content !!}
                    <br>
                    <span class="text-primary">Okunma Sayısı: <b>{{$article->hit}}</b>  </span>
                </div>

   @endsection
