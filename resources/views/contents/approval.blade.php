
    <head>
        <title>Approval - Komunitas Usaha Bersama</title>
        <style>
            #datatablesSimple th:first-child, 
            #datatablesSimple td:first-child {
                width: 50px;
                text-align: center;
            }
        </style>
    </head>
    @extends('layouts.base')
    @section('content')
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Approval</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Approval</li>
                        </ol>
                        <!-- <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div> -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                New User List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th data-sortable="false"><input type="checkbox" id="selectAll"></th>
                                            <th>Name</th>
                                            <th>NIK</th>
                                            <th>No WA</th>
                                            <th>Email</th>
                                            <th>User ID</th>
                                            <th>Referral Code</th>
                                            <th>Referrence</th>
                                            <th>Created</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>NIK</th>
                                            <th>No WA</th>
                                            <th>Email</th>
                                            <th>User ID</th>
                                            <th>Referral Code</th>
                                            <th>Referrence</th>
                                            <th>Created</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($unpaidUsers as $unpaidUser)
                                        <tr>
                                            <td><input type="checkbox" class="row-checkbox"></td>
                                            <td>{{$unpaidUser->nama}}</td>
                                            <td>{{$unpaidUser->nik}}</td>
                                            <td>{{$unpaidUser->wa_number}}</td>
                                            <td>{{$unpaidUser->email}}</td>
                                            <td>{{$unpaidUser->user_id}}</td>
                                            <td>{{$unpaidUser->referral_code}}</td>
                                            <td>{{$unpaidUser->mapped_referral_code}}</td>
                                            <td>{{$unpaidUser->created}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex align-items-center gap-3 mt-4 mb-0">
                                    <!-- <a class="small" href="password.html">Forgot Password?</a> -->
                                    <a class="btn btn-primary" href="index.html">Approve</a>
                                    <a class="btn btn-danger" href="#">Reject</a>
                                </div>
                            </div>
                        </div>
                    </div>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('js/datatables-simple.js')}}"></script>
        @endsection

