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
                    <a href="{{route('admin.compilation.create')}}" class="btn btn-primary waves-effect waves-light">
                        <i class="mdi mdi-plus-circle me-1"></i> إضافة تصنيف </a>
                </div>
                <h4 class="page-title">التصنيفات</h4>
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
                        </div>
                        <!-- end col-->
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
                                <th>ID</th>
                                <th>اسم التصنيف</th>
                                <th>وصف التصنيف</th>
                                <th>الحالة</th>
                                <th style="width: 85px;">الإجراء</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($compilations as $compilation)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheck2">
                                        <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                    </div>
                                </td>
                                <td>{{$compilation->id}}</td>
                                <td>{{$compilation->title}}</td>
                                <td>
                                    <span class="media align-items-center">
                                            <img class="avatar avatar-lg mr-3 avatar--3-1" src="{{$compilation['image_url']}}"
                                                 onerror="this.src='{{asset('public/assets/admin/img/900x400/img1.jpg')}}'" alt="{{$compilation->title}} image">
                                            <div class="media-body">
                                                <h5 class="text-hover-primary mb-0">{{Str::limit($compilation['title'], 25, '...')}}</h5>
                                            </div>
                                        </span>
                                    <span class="d-block font-size-sm text-body">

                                        </span> </td>
                                <td>
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" />
                                </td>
                                <td>
                                    <a href="{{route('admin.compilation.edit',['id'=>$compilation->id])}}" class="action-icon">
                                        <i class="mdi mdi-square-edit-outline"></i>
                                    </a>
                                    <a data-bs-toggle="modal" href="#exampleModalToggle" role="button" class="action-icon">
                                        <i class="mdi mdi-delete"></i>
                                    </a>
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
                        <li class="page-item active">
                            <a class="page-link" href="javascript: void(0);">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);">5</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- end card-body-->
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
