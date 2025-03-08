<head>
        <title>Registered Users - Komunitas Usaha Bersama</title>
        <style>
            #datatablesRegisteredUsers th:first-child, 
            #datatablesRegisteredUsers td:first-child {
                width: 50px;
                text-align: center;
            }
            /* .btn-no-bg:hover, 
            .btn-no-bg:focus {
                background-color: transparent !important; 
                border: none !important; 
                outline: none !important; 
                box-shadow: none !important; 
                color:#189cd8 !important; 
            } */

            /* Pastikan baris detail disembunyikan */
/* Pastikan baris detail tersembunyi saat halaman dimuat */
        </style>
    </head>


@extends('layouts.base')

@section('content')
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Registered Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Registered Users List</li>
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
                                Registered Users
                            </div>
                            <div class="card-body">
                                <table id="datatablesRegisteredUsers">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User ID</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Tanggal Registrasi</th>
                                            <th>Referral</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Tanggal Registrasi</th>
                                            <th>Referral</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($registeredUsers as $user)
                                        <tr data-referral="{{$user->referral_code}}">
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary border-0 btn-no-bg toggle-btn">
                                                    <i class="fas fa-plus-circle"></i>
                                                </button>
                                            </td>
                                            <td>{{ $user->user_id }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ \Carbon\Carbon::parse($user->created)->format('d-m-Y H:i:s') }}</td>
                                            <td onclick="copyReferralLink('{{ $user->referral_code }}')" style="cursor: pointer;">
                                                {{ $user->referral_code }}
                                            </td>
                                        </tr>
                                        <!-- <tr class="details-row">
                                            <td>test
                                            </td>
                                        </tr> -->
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
        <script src="{{asset('js/datatables-simple.js')}}?v={{ time() }}"></script>
        @endsection

