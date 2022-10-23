@extends('back.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kategori Ekle</h6>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('admin.category.create')}}">
                    @csrf
                    <div class="form-group">
                        <label>Kategori Adı</label>
                        <input type="text" class="form-control" name="category" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary btn-md">Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class= "col-md-8 ">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Kategori Adı</th>
                        <th>Makale Sayısı</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->articleCount()}}</td>

                            <td>
                                <a category-id="{{$category->id}}" class="btn btn-sm btn-primary edit-click" title="Kategoriyi Düzenle"><i class="fa fa-edit"></i>Düzenle</a>
                                <br>
                                <br>
                                <a category-id="{{$category->id}}" category-name="{{$category->name}}" category-count="{{$category->articleCount()}}" class="btn btn-sm btn-danger remove-click" title="Kategoriyi Sil"><i class="fa fa-times"></i>Sil</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
<div>
    <div id="editModal" class="modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Kategoriyi Düzenle</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.category.update')}}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input id="category" type="text" class="form-control" name="category">
                            <input type="hidden" name="id" id="category_id">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Değişikleri Kaydet</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div id="deleteModal" class="modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Kategoriyi Sil</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.category.delete')}}">
                        @csrf
                        <input type="hidden" name="id" id="deleteId">
                    <div class="alert alert-danger" id="articleAlert"></div>
                </div>
                <div class="modal-footer">
                    <button id="deleteButton" type="submit" class="btn btn-success">Sil</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                </div>
                </form>
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
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr("content")
            }
        });
        $('.remove-click').click(function(){
            id=$(this)[0].getAttribute('category-id');
            count=$(this)[0].getAttribute('category-count');
            name=$(this)[0].getAttribute('category-name');

            if(id == 1){
                $('#articleAlert').html(name+ ' kategorisi silinemez! Var olan kategorilerden silinen makaleler buraya aktarılacaktır.');
                $('#body').show();
                $('#deleteButton').hide();
                $('#deleteModal').modal();
                return;
            }

            $('#deleteButton').show();
            $('#deleteId').val(id);

            if(count>0){
                $('#articleAlert').html('Bu kategoride '+count+' makale bulunmaktadır.Silmek istediğinize emin misiniz ?');
            }
        else{
                $('#articleAlert').html('Bu kategoride hiç makale bulunmamaktadır.Silmek istediğinize emin misiniz ?');
            }
            $('#deleteModal').modal();
        });
            $('.edit-click').click(function(){
                id=$(this)[0].getAttribute('category-id');
                $.ajax({
                    type:'GET',
                    url:'{{route('admin.category.getdata')}}',
                    data:{id:id},
                    success:function(data){
                        $('#category').val(data.name);
                        $('#category_id').val(data.id);
                        $('#editModal').modal();
                        $('.data-table').dataTable().ajax.reload();
                    }
                });
            });
    </script>
@endsection
