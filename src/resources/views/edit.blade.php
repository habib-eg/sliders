@extends('dashboard::layouts.layout')

@push('header')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{action([\Habib\Dashboard\Http\Controllers\DashboardController::class,'home'])}}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{route('dashboard.sliders.index')}}">Sliders</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit : {{$slider->id}}</li>
                            </ol>
                        </nav>
                    </div>
{{--                    <div class="col-lg-6 col-5 text-right">--}}
{{--                        <a href="#" class="btn btn-sm btn-neutral">New</a>--}}
{{--                        <a href="#" class="btn btn-sm btn-neutral">Filters</a>--}}
{{--                    </div>--}}
                </div>

            </div>
        </div>
    </div>
@endpush
@section('content')
    <!-- Page content -->
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">

                        <div class="col-8">
                            <h3 class="mb-0">Slider {{$slider->id}} </h3>
                        </div>

{{--                        <div class="col-4 text-right">--}}
{{--                            <a href="#!" class="btn btn-sm btn-primary">Settings</a>--}}
{{--                        </div>--}}

                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('dashboard.sliders.update',$slider)}}" enctype="multipart/form-data">@csrf @method('put')
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-title">title</label>
                                        <input type="text" id="input-title" class="form-control" name="title" placeholder="title" value="{{old('title',$slider->title)}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-sorting">sorting</label>
                                        <input type="number" min="1" required id="input-sorting" class="form-control" value="{{old('sortable',$slider->sortable)}}" name="sortable" placeholder="sorting">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-file">Image</label>
                                        <input type="file" id="input-file" onchange="readURL(this,'imagePreview')" name="image" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 border p-2">
                                    <img src="{{$slider->image_Path}}" alt="" id="imagePreview" class="w-100">
                                </div>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">content</label>
                                <textarea rows="4" class="form-control" name="content" placeholder="content">{{old('content',$slider->content)}}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
