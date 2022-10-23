@isset($categories)
<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Kategoriler
        </div>
        <div class="list-group">
            @foreach($categories as $category)
                <li class="list-group-item">
                    <a href="{{route('category',$category->id)}}" >{{$category->name}}  <span class="badge bg-primary float-right">{{$category->articleCount()}}</span> </a>
                </li>
            @endforeach
        </div>
    </div>
</div>
@endif
