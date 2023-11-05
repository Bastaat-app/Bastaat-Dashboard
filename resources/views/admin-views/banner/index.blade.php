@extends('layouts.admin.master')
@section('title')
    {{__("index")}}
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{route('admin.banner.create')}}" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i> إضافة إعلان</a>
                </div>
                <h4 class="page-title">إعلانات التطبيق</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <!-- here right -->
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-2 mt-sm-0">
                                <!-- here left -->
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-striped" id="products-datatable">
                            <thead>
                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheck1">
                                        <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th>الترقيم</th>
                                <th>تاريخ إنشاء الإعلان</th>
                                <th>الإعلان</th>

                                <th>تفعيل</th>
                                <th>الإجراء</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($banners as $key=>$banner)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheck2">
                                        <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                    </div>
                                </td>
                                <td class="table-user">
                                    {{$key+1}}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($banner->created_at)->translatedFormat('l j F Y H:i:s') }}</td>
                                <td>
                                        <span class="media align-items-center">
                                            <img class="avatar avatar-lg mr-3 avatar--3-1" src="{{asset($banner['image'])}}"
                                                 onerror="this.src='{{asset('assets/images/logo.png')}}'" alt="{{$banner->name}} image">
                                            <div class="media-body">
                                                <h5 class="text-hover-primary mb-0">{{Str::limit($banner['title'], 25, '...')}}</h5>
                                            </div>
                                        </span>
                                    <span class="d-block font-size-sm text-body">

                                        </span>
                                </td>


                                <td>
                                    <label class="toggle-switch toggle-switch-sm" for="statusCheckbox{{$banner->id}}">
                                        <input type="checkbox" onclick="location.href='{{route('admin.banner.status',[$banner['id'],$banner->status?0:1])}}'" class="toggle-switch-input" id="statusCheckbox{{$banner->id}}" {{$banner->status?'checked':''}}>
                                        <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                    </label>
                                </td>

                                <td>
                                    <a href="{{route('admin.banner.edit', ['banner' => $banner->id])}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="{{route('admin.banner.delete', ['banner' => $banner->id])}}" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <ul class="pagination pagination-rounded justify-content-end mb-0">
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                        <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </li>
                    </ul>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
