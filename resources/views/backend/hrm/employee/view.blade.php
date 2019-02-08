<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Employee Profile @endsection
<!-- End block -->

<!-- Page body extra css -->
@section('extraStyle')
    <style>
        @media print {
            @page {
                size:  A4 landscape;
                margin-top: 10mm;
                margin-left: 0.10in;
                margin-right: 0;
                margin-bottom: 0;
            }
        }
    </style>
@endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
    <!-- Section header -->
    <section class="content-header">
        <div class="btn-group">
            <a href="#"  class="btn-ta btn-sm-ta btn-print btnPrintInformation"><i class="fa fa-print"></i> Print</a>
        </div>
        <div class="btn-group">
            <button class="btn-ta btn-sm-ta" data-toggle="modal" data-target="#idCard"><span class="fa fa-floppy-o"></span> ID Card </button>
        </div>
        <div class="btn-group">
            <a href="{{URL::route('teacher.edit',$employee->id)}}" class="btn-ta btn-sm-ta"><i class="fa fa-edit"></i> Edit</a>
        </div>

        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{URL::route('hrm.employee.index')}}"><i class="fa icon-teacher"></i> Employee</a></li>
            <li class="active">View</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content main-contents">
        <div class="row">
            <div class="col-md-12">
                <div id="printableArea">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="box box-info">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="@if($employee->photo ){{ asset('storage/employee')}}/{{ $employee->photo }} @else {{ asset('images/avatar.jpg')}} @endif">
                                    <h3 class="profile-username text-center">{{$employee->name}}</h3>
                                    <p class="text-muted text-center">{{$employee->designation}}</p>
                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item" style="background-color: #FFF">
                                            <b>ID Card No.</b> <a class="pull-right">{{$employee->id_card}}</a>
                                        </li>
                                        <li class="list-group-item" style="background-color: #FFF">
                                            <b>Phone</b> <a class="pull-right">{{$employee->phone_no}}</a>
                                        </li>
                                        <li class="list-group-item" style="background-color: #FFF">
                                            <b>Email</b> <a class="pull-right">{{$employee->email}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Profile</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <strong><i class="fa fa-info margin-r-5"></i> Gender</strong>
                                    <p class="text-muted">{{$employee->gender}}</p>

                                    <hr>
                                    <strong><i class="fa fa-clock-o margin-r-5"></i> Date of Birth</strong>
                                    <p class="text-muted">{{$employee->dob}}</p>

                                    <hr>
                                    <strong><i class="fa fa-book margin-r-5"></i> Qualification</strong>
                                    <p class="text-muted">{{$employee->qualification}}</p>

                                    <hr>

                                    <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                                    <p class="text-muted">{{$employee->address}}</p>

                                    <hr>

                                    <strong><i class="fa fa-info margin-r-5"></i> Religion</strong>
                                    <p class="text-muted">{{$employee->religion}}</p>

                                    <hr>

                                    <strong><i class="fa fa-calendar margin-r-5"></i> Join Date</strong>
                                    <p class="text-muted">{{$employee->joining_date}}</p>

                                    <hr>
                                    <strong><i class="fa fa-sign-in margin-r-5"></i> Username</strong>
                                    <p class="text-muted">{{$employee->user->username}}</p>

                                    <hr>
                                    <strong><i class="fa fa-pencil margin-r-5"></i> Signature</strong>
                                    @if($employee->signature )
                                        <img class="img-responsive" src="{{ asset('storage/employee/signature')}}/{{ $employee->signature }}">
                                    @endif

                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>

                        <div class="col-sm-9">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    {{--<li><a href="#routine" data-toggle="tab">Routine</a></li>--}}
                                    <li class="active"><a href="#attendance" data-toggle="tab">Attendance</a></li>
                                    {{--<li><a href="#salary" data-toggle="tab">Salary</a></li>--}}
                                    {{--<li><a href="#payment" data-toggle="tab">Payment</a></li>--}}
                                    <li><a href="#document" data-toggle="tab">Document</a></li>
                                </ul>

                                <div class="tab-content">
                                    {{--<div class="tab-pane" id="routine">--}}
                                    {{--</div>--}}

                                    <div class="tab-pane" id="attendance">

                                    </div>

                                    {{--<div class="tab-pane" id="salary">--}}
                                    {{----}}
                                    {{--</div>--}}
                                    {{--<div class="tab-pane" id="payment">--}}
                                    {{----}}
                                    {{--</div>--}}


                                    <div class="tab-pane" id="document">
                                        {{--<input class="btn btn-success btn-sm" style="margin-bottom: 10px" type="button" value="Add Document" data-toggle="modal" data-target="#documentupload">--}}
                                        {{--<div id="hide-table">--}}
                                        {{--<table class="table table-striped table-bordered table-hover">--}}
                                        {{--<thead>--}}
                                        {{--<tr>--}}
                                        {{--<th>#</th>--}}
                                        {{--<th>Title</th>--}}
                                        {{--<th>Date</th>--}}
                                        {{--<th>Action</th>--}}
                                        {{--</tr>--}}
                                        {{--</thead>--}}
                                        {{--<tbody>--}}
                                        {{--<tr>--}}
                                        {{--<td data-title="#">--}}
                                        {{--1                                                    </td>--}}

                                        {{--<td data-title="Title">--}}
                                        {{--Computer                                                    </td>--}}

                                        {{--<td data-title="Date">--}}
                                        {{--05 Jun 2018                                                    </td>--}}
                                        {{--<td data-title="Action">--}}
                                        {{--<a href="" class="btn btn-success btn-xs mrg" data-placement="top" data-toggle="tooltip" data-original-title="Download"><i class="fa fa-download"></i></a>--}}
                                        {{--<a href="" onclick="return confirm('you are about to delete a record. This cannot be undone. are you sure?')" class="btn btn-danger btn-xs mrg" data-placement="top" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>  --}}
                                        {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--</tbody>--}}
                                        {{--</table>--}}
                                        {{--</div>--}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE JS-->
@section('extraScript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.btnPrintInformation').click(function () {
                window.print();
            });
        });
    </script>
@endsection
<!-- END PAGE JS-->
