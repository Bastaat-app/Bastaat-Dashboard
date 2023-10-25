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
                    <a href="{{route('admin.place.index')}}" class="btn btn-primary waves-effect waves-light">
                        <i class="mdi mdi-plus-circle me-1"></i> إضافة صاحب محل </a>
                </div>
                <h4 class="page-title">أصحاب المحلات</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div>
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-primary">
                                    <i class="dripicons-store font-24 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1">
                                        <span data-plugin="counterup">58,947</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">الاماكن</p>
                                </div>
                            </div>
                        </div>
                        <!-- end row-->
                    </div>
                </div>
                <!-- end widget-rounded-circle-->
            </div>
            <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-success">
                                    <i class="dripicons-store font-24 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1">
                                        <span data-plugin="counterup">1,845</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">الاماكن المفعلة</p>
                                </div>
                            </div>
                        </div>
                        <!-- end row-->
                    </div>
                </div>
                <!-- end widget-rounded-circle-->
            </div>
            <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-info">
                                    <i class="dripicons-store font-24 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1">
                                        <span data-plugin="counterup">825</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate"> غير مفعلة</p>
                                </div>
                            </div>
                        </div>
                        <!-- end row-->
                    </div>
                </div>
                <!-- end widget-rounded-circle-->
            </div>
            <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-warning">
                                    <i class="dripicons-store font-24 avatar-title text-warning"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1">
                                        <span data-plugin="counterup">2,430</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">اماكن جديدة</p>
                                </div>
                            </div>
                        </div>
                        <!-- end row-->
                    </div>
                </div>
                <!-- end widget-rounded-circle-->
            </div>
            <!-- end col-->
        </div>
        <!-- end row -->
    </div>
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
                                <th>اسم المكان</th>
                                <th>صاحب المكان</th>
                                <th>العنوان</th>
                                <th>التصنيف</th>
                                <th>تاريخ الإنشاء</th>
                                <th>عدد المنتجات</th>
                                <th>المحفظة</th>
                                <th>الحالة</th>
                                <th style="width: 85px;">الإجراء</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($places as $place)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheck2">
                                        <label class="form-check-label" for="customCheck2">&nbsp;{{$place->id}}</label>
                                    </div>
                                </td>
                                <td class="table-user">
                                    <img src="{{asset($place->image_url)}}" alt="table-user" class="me-2 rounded-circle">
                                    <a href="javascript:void(0);" class="text-body fw-semibold">{{$place->name}}</a>
                                </td>
                                <td> {{$place->name}} </td>
                                <td> {{$place->address}} </td>
                                <td> {{$place->compilation_id}} </td>
                                <td> {{$place->created_at}} </td>
                                <td>٤٣٢ منتج</td>
                                <td>٢٣٤ ريال</td>
                                <td>
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" />
                                </td>
                                <td>
                                    <a href="./place-detail.html" class="action-icon">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                    <a href="./create-place.html" class="action-icon">
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
