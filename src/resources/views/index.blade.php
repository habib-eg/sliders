@extends('dashboard::layouts.layout')
@push('css')
    <style>
        .custom-toggle input:checked + .custom-toggle-slider:before {
            transform: translateX(28px);
            background: #2dce89;
        }
        .custom-toggle input:checked + .custom-toggle-slider:after {
            right: auto;
            left: 0;
            content: attr(data-label-on);
            color: #2dce89;
        }
        .custom-toggle input:checked + .custom-toggle-slider {
            border: 1px solid #2dce89;
        }
        .custom-toggle-slider:after{
            color: #f5365c;
        }
        .custom-toggle-slider {

            border: 1px solid #f5365c;
            background-color: transparent;
        }
        .custom-toggle-slider:before {
            background-color: #f5365c;
        }
    </style>
@endpush
@push('js')
    <script>
        $(function(){
            $('.slider-status').change(function () {
                var slider=$(this);
                var form=slider.parent().parent('form')[0] || null;
                if(!form) return ;

                if (slider.is(':checked')) {
                    console.log(slider,slider.is(':checked'));
                }

                $.ajax({
                    url:form.action,
                    success:(res) => {
                        slider.attr('checked',res.status);
                    }
                })
            });
        })
    </script>
@endpush

@push('header')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{url(config('dashboard.dashboard_url'))}}"><i class="fas fa-home"></i></a></li>
{{--                                <li class="breadcrumb-item"><a href="#">sliders</a></li>--}}
                                <li class="breadcrumb-item active" aria-current="page">sliders</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Sliders</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('dashboard.sliders.create')}}" class="btn btn-sm btn-primary">create</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">title</th>
                            <th scope="col">status</th>
                            <th scope="col">sortable</th>
                            <th scope="col">creator</th>
                            <th scope="col">Url</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($sliders as $slider)
                            <tr>
                                <th scope="row">{{$slider->id }}</th>
                                <td>
                                    {{$slider->title}}
                                </td>
                                <td>

                                    <form action="{{route('dashboard.sliders.toggle.status',$slider)}}" method="post">@csrf
                                        <label class="custom-toggle">
                                            <input type="checkbox" {{$slider->active ? ' checked ':''}} name="active" class="slider-status">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                        </label>
                                    </form>

                                </td>
                                <td>
                                    {{$slider->sortable}}
                                </td>
                                <td>
                                    {{$slider->user->name}}
                                </td>

                                <td>
                                    {{$slider->linkable ? ' linkable ': 'not linkable'}}
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            {{--                                            <a class="dropdown-item" href="#">show</a>--}}
                                            <a class="dropdown-item" href="{{route('dashboard.sliders.edit',$slider)}}"><i class="fa fa-edit"></i> Edit</a>
                                            <a class="dropdown-item"data-toggle="modal" data-target="#modal-default{{$loop->index}}" href="#"><i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="modal-default{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">{{$slider->title}}</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <p> Are you sure Delete ? </p>

                                        </div>

                                        <div class="modal-footer">
                                            <form action="{{route('dashboard.sliders.destroy',$slider)}}" method="post">@csrf @method('DELETE')
                                                <button type="submit" class="btn btn-white text-danger">Delete</button>
                                                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                        </tbody>
                    </table>
                    {{$sliders->withQueryString()->links()}}
                </div>
            </div>
        </div>
    </div>
@stop
