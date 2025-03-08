<head>
        <title>Commissions - Komunitas Usaha Bersama</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>


@extends('layouts.base')

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Commissions</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Commissions</li>
                        </ol>
                        <!-- <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div> -->
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Users Commissions
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <!-- <th>#</th> -->
                                            <th>User ID</th>
                                            <th>Nama</th>
                                            <th>Kode Referral</th>
                                            <th>No. Rek</th>
                                            <th>Nama Rek</th>
                                            <th>Nama Bank</th>
                                            <th>Pendapatan</th>
                                            <th>Pendapatan Mengendap</th>
                                            <th>Pendapatan Selesai Transfer</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Nama</th>
                                            <th>Kode Referral</th>
                                            <th>No. Rek</th>
                                            <th>Nama Rek</th>
                                            <th>Nama Bank</th>
                                            <th>Pendapatan</th>
                                            <th>Pendapatan Mengendap</th>
                                            <th>Pendapatan Selesai Transfer</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($userCommissions as $user)
                                        <tr>
                                            <!-- <td>
                                                <button class="btn btn-sm btn-outline-primary border-0 btn-no-bg toggle-btn">
                                                    <i class="fas fa-plus-circle"></i>
                                                </button> -->
                                            <!-- </td> -->
                                            <td>{{ $user->user_id }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td onclick="copyReferralLink('{{ $user->referral_code }}')" style="cursor: pointer;">
                                                {{ $user->referral_code }}
                                            </td>
                                            <td>{{ $user->acc_number }}</td>
                                            <td>{{ $user->acc_name }}</td>
                                            <td>Rp&nbsp;{{ number_format($user->pendapatan ?? 0,2) }}</td>
                                            <td>Rp&nbsp;{{ number_format($user->pendapatan_mengendap ?? 0,2) }}</td>
                                            <td>Rp&nbsp;{{ number_format($user->pendapatan_sudah_dibayar ?? 0,2) }}</td>
                                            <td class="text-center align-middle" style="vertical-align: middle;">
                                                <a href="#" class="btn btn-success d-inline-flex btn-sm align-items-center" data-bs-toggle="modal" 
                                                data-bs-target="#transferModal" onclick="setModalData('{{ $user->id }}','{{$user->user_id}}', '{{ $user->bank_name }}', '{{ $user->acc_number }}', 
                                                '{{ $user->acc_name }}', '{{ number_format($user->pendapatan_mengendap ?? 0, 2) }}')">
                                                <i class="fas fa-money-bill-transfer me-2"></i> Transfer
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- <tr class="details-row">
                                            <td>test
                                            </td>
                                        </tr> -->
                                        @endforeach
                                    </tbody>
                                    <!-- Modal -->
                                    <div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content shadow-lg">
                                            <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="transferModalLabel">
                                                            <i class="fas fa-money-bill-wave me-2"></i> Konfirmasi Transfer
                                                        </h5>
                                                        <div id="errorAlert" class="alert alert-danger d-none">
                                                            <strong>Error:</strong> <span id="modalErrorMessage"></span>
                                                        </div>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                <form action="{{route('commission.transfer')}}" method="POST" id="transferForm">
                                                @csrf
                                                <input type="hidden" name="id" id="modalId">
                                                <input type="hidden" name="user_id" id="modalUserId">
                                                <input type="hidden" name="bank_name" id="hiddenBankName">
                                                <input type="hidden" name="acc_number" id="hiddenNoRek">
                                                <input type="hidden" name="acc_name" id="hiddenRekName">
                                                    <div class="modal-body p-4">
                                                        <div class="card border-0 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="mb-3">
                                                                    <h6 class="text-muted">Detail Transfer</h6>
                                                                </div>
                                                                
                                                                    <!-- Menggunakan Grid untuk Sejajarkan ":" -->
                                                                    <div class="row mb-2 align-items-center">
                                                                        <div class="col-7 fw-bold text-secondary">
                                                                            <i class="fas fa-university me-2"></i> Nama Bank
                                                                        </div>
                                                                        <div class="col-auto">:</div>
                                                                        <div class="col text-end text-dark fw-semibold" id="modalBankName">BCA</div>
                                                                    </div>

                                                                    <div class="row mb-2 align-items-center">
                                                                        <div class="col-7 fw-bold text-secondary">
                                                                            <i class="fas fa-credit-card me-2"></i> No Rekening
                                                                        </div>
                                                                        <div class="col-auto">:</div>
                                                                        <div class="col text-end text-dark fw-semibold" id="modalNoRek">1234567890</div>
                                                                    </div>

                                                                    <div class="row mb-2 align-items-center">
                                                                        <div class="col-7 fw-bold text-secondary">
                                                                            <i class="fas fa-user me-2"></i> Nama Rekening
                                                                        </div>
                                                                        <div class="col-auto">:</div>
                                                                        <div class="col text-end text-dark fw-semibold" id="modalRekName">John Doe</div>
                                                                    </div>

                                                                    <div class="row mb-3 align-items-center">
                                                                        <div class="col-7 fw-bold text-secondary">
                                                                            <i class="fas fa-wallet me-2"></i> Pendapatan Mengendap
                                                                        </div>
                                                                        <div class="col-auto">:</div>
                                                                        <div class="col text-end text-success fw-bold" id="modalPendapatanMengendap">Rp 5,000,000.00</div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        
                                                                        <h6 class="text-muted">Jumlah Transfer</h6>
                                                                        <div class="row align-items-center mb-3">
                                                                            <div class="col-7 fw-bold text-secondary">
                                                                                <i class="fas fa-money-check-alt me-2"></i> Nominal
                                                                            </div>
                                                                        </div>

                                                                            <div class="mb-3">
                                                                                <input type="text" name="amount" class="form-control text-end fw-bold border-2" id="modalAmount" placeholder="0" 
                                                                                inputmode="numeric">
                                                                            </div>
                                                                        
                                                                    </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            <i class="fas fa-times"></i> Batal
                                                        </button>
                                                        <button type="submit" class="btn btn-success" id="confirmTransfer">
                                                            <i class="fas fa-paper-plane"></i> Transfer
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>



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

