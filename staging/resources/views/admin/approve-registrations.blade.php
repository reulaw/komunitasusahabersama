<head>
    <title>Approval - Komunitas Usaha Bersama</title>
    <!-- <style>
            #datatablesSimple th:first-child, 
            #datatablesSimple td:first-child {
                width: 50px;
                text-align: center;
            }
        </style> -->
</head>


@extends('layouts.base')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Approval</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Dashboard</a></li>
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
            Data Pengguna yang Perlu Disetujui
        </div>
        <div class="card-body">
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <!-- <th data-sortable="false"><input type="checkbox" id="selectAll"></th> -->
                        <th>User ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Registrasi</th>
                        <th>Referral</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>User ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Registrasi</th>
                        <th>Referral</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <!-- <td><input type="checkbox" class="row-checkbox"></td> -->
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->created)->format('d-m-Y H:i:s') }}</td>
                        <td onclick="copyReferralLink('{{ $user->referral_code }}')" style="cursor: pointer;">
                            {{ $user->referral_code }}
                        </td>
                        <td>
                            <a href="{{ route('approve.registration', $user->id) }}" class="btn btn-success btn-sm">
                                Approve
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- <div class="d-flex align-items-center gap-3 mt-4 mb-0">
                                    <a class="small" href="password.html">Forgot Password?</a>
                                    <a class="btn btn-primary" href="index.html">Approve</a>
                                    <a class="btn btn-danger" href="#">Reject</a>
                                </div> -->
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{asset('js/datatables-simple.js')}}"></script>
@endsection