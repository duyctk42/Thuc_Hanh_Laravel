<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
    <title>trang chu</title>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header',['name'=>'category', 'key'=> 'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class = "col-md-6">
                        <form action="{{route('categories.update',['id' => $category->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       value="{{$category->name}}"
                                       placeholder="nhập tên danh mục">
                                <div class="form-group">
                                    <label >Chọn danh mục cha</label>
                                    <select class="form-control" name = "paren_id" >
                                        <option value = 0>Danh mục cha</option>
                                        {!! $htmlOption !!}
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection


