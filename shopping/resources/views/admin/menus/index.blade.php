<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
    <title>trang chu</title>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header',['name'=>'menus', 'key'=> 'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class = "col-md-12">
                        <a href = "{{ route('menus.create') }}" class = "btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class = "col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Menu</th>
                                <th scope="col">action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menus as $menu)


                                <tr>
                                    <th scope="row">{{$menu->id}}</th>
                                    <td>{{$menu->name}}</td>
                                    <td>
                                        <a href="{{route('menus.edit',['id' => $menu->id])}}" class="btn btn-default">Edit</a>
                                        <a href="{{route('menus.delete',['id' => $menu->id])}}"class="btn btn-danger">Detele</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class = "col-md-12">
                        {{$menus -> links()}}
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection


