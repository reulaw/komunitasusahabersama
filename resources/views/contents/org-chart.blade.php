<head>
        <title>Chart - Komunitas Usaha Bersama</title>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
