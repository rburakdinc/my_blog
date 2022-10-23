@extends('back.layouts.master')
@section('title','Tüm Makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>{{$article->count()}}</strong> Makale Bulundu.</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğrafı</th>
                        <th>Makale Adı</th>
                        <th>Kategorisi</th>
                        <th>Görüntülenme Sayısı</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durumu</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($article as $article)
                    <tr>
                        <td>
                            <img src="{{asset($article->image)}}" width="200">
                        </td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->created_at}}</td>
                        <td>
                            <input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktif" data-off="Pasif"  data-onstyle= "info" data-offstyle="danger" @if($article->status==1) checked @endif data-toggle="toggle">
                        </td>
                        <td>
                            <a href="{{route('admin.makaleler.edit',$article->id)}}" class="btn btn-sm btn-primary"><i class="fa fab-pen"></i>Düzenle</a>
                            <br>
                            <br>
                            <a href="{{route('admin.delete.article',$article->id)}}" class="btn btn-sm btn-danger"><i class="fa fab-times"></i>Sil</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.switch').change(function() {
                id=$(this)[0].getAttribute('article-id');
                statu=$(this).prop('checked');
                $.get("{{route('admin.switch')}}",{id:id,statu:statu}, function(data, status){
                });

            })
        })
    </script>
@endsection
