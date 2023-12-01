<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
    <title>trang chu</title>
@endsection
@section('css')
    <link href= "{{asset('admins/product/slider/index/index.css')}}" rel="stylesheet" />
@endsection
@section('js')
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script type="text/javascript" src="{{asset("admins/main.js")}}"></script>

@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header',['name'=>'Slider', 'key'=> 'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class = "col-md-12">
                        <a href = "{{route('slider.create')}}" class = "btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class = "col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Slider</th>
                                <th scope="col">Desciption</th>
                                <th scope="col">Hình Ảnh</th>
                                <th scope="col">action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)


                                <tr>
                                    <th scope="row">{{$slider -> id}}</th>
                                    <td>{{$slider -> name}}</td>
                                    <td>{{$slider -> description}}</td>
                                    <td><img class="image_slider_150_100" src=" {{$slider -> image_path}}">
                                       </td>
                                    <td>
                                        <a href="{{route('slider.edit',['id'=>$slider->id])}}" class="btn btn-default">Edit</a>

                                        <a href=""
                                           data-url="{{route('slider.delete',['id'=>$slider->id])}}"
                                           class="btn btn-danger action_delete">Detele</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class = "col-md-12">
                        {{$sliders -> links()}}
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection


