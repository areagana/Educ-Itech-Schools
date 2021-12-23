@Extends('layouts.app')
@section('crumbs')
    {{Breadcrumbs::render('categories')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col p-2">
                <h3 class="header">Categories
                    <span class="right">
                        <button class="btn btn-sm btn-light">
                            <i class="fa fa-plus-circle"></i>
                            Category
                        </button>
                    </span>
                </h3>
            </div>
        </div>
        <div class="row p-2">
            <div class="col">
                @foreach($categories as $category)
                    <div class="p-2 category mx-2 border-bottom row">
                        <div class="col p-2">
                            {{$category->category_name}}
                        </div>
                        <div class="col-md-2 text-muted">
                            schools ({{$category->schools->count()}})
                        </div>
                        <div class="col-md-4 p-2">
                            <span class="right category-more hidden">
                                <i class="fa fa-edit mx-2 btn btn-sm btn-light btn-circle text-info"></i>
                                <i class="fa fa-trash mx-2 btn btn-sm btn-light btn-circle text-danger" onclick="xdialog.confirm('Confirm to delete this category',function(){deleteItem({{$category->id}},'/category/delete')})"></i>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4 p-2 border-left">
                <form action="{{route('store.category')}}" method='POST'>
                    @csrf
                    <div class="form-group">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="custom-input p-2" name='category_name' id="category_name">
                    </div>
                    <div class="form-group">
                        <label for="category_level" class="form-label">Category Level</label>
                        <input type="text" class="custom-input p-2" name='category_level' id="category_level">
                    </div>
                    <div class="form-group row">
                        <div class="col p-2">
                            <button class="btn btn-primary btn-sm right" type='submit'>Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection