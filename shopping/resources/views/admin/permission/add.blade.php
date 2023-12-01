<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
    <title>trang chu</title>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header',['name'=>'Permission', 'key'=> 'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('permissions.store')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <label>Chọn tên module</label>
                                <select class="form-control" name="module_parent">
                                    <option value="">Chọn tên module</option>
                                    @foreach(config('permissions.table_module') as $moduleItem)
                                        <option value={{$moduleItem}}>{{$moduleItem}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    @foreach(config('permissions.module_childrent') as $moduleChilrent)
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" value="{{$moduleChilrent}}" name="module_chilrent[]">
                                                {{$moduleChilrent}}
                                            </label>


                                        </div>
                                    @endforeach
                                </div>


                                <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection


