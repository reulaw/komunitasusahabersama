<head>
        <title>Chart - Komunitas Usaha Bersama</title>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <style>
            
            .org-card {
                background: #f8f9fa;
                border-radius: 10px;
                padding: 10px;
                text-align: center;
                font-size: 14px;
                font-weight: bold;
                border: 1px solid #ddd;
                box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease-in-out;
            }

            /* Efek saat node muncul */
            .fade-in {
                opacity: 0;
                transform: scale(0.8);
                animation: fadeInScale 0.3s forwards;
            }

            @keyframes fadeInScale {
                from {
                    opacity: 0;
                    transform: scale(0.8);
                }
                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            .hidden {
                display: none;
                
            }
            /* .expand-hint {
                font-size: 12px;
                color: #6c757d;
                font-weight: bold;
                display: inline-block;
                margin-top: 5px;
                transition: color 0.3s;
            } */
            .org-card:hover{
                color: #007bff;
                background: #e9ecef;
            }


        </style>
    </head>

    @extends('layouts.base')

    @section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tree View</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tree View</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Referral Hierarchy
            </div>
            <div class="card-body">
                @if(Auth::user()->is_admin == 'Y')
                    <label for="referralFilter">Filter by Referral Code:</label>
                    <select id="referralFilter" class="form-select">
                    <option value="">All</option>
                    @foreach($allReferralCodes as $code => $name)
                        <option value="{{ $code }}">
                            {{ $code }} - {{ $name }}
                        </option>
                    @endforeach
                    </select>
                    <br>
                @endif
                <div class="table-responsive">
                    <div id="chart_div" class="d-flex justify-concent-center"></div>
                </div>
                
            </div>
        </div>
    </div>
    @endsection
