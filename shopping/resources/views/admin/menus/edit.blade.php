<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
    <title>trang chu</title>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header',['name'=>'menus', 'key'=> 'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class = "col-md-6">
                        <form action="{{route('menus.update',['id' =>$menuFollowIdEdit->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên Menus</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       placeholder="nhập tên Menu"
                                       value= "{{$menuFollowIdEdit->name  }}">

                                <div class="form-group">
                                    <label >Chọn menus cha</label>
                                    <select class="form-control" name = "paren_id" >
                                        <option value = 0>Chon menu cha</option>
                                        {!! $optionSelect !!}
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


