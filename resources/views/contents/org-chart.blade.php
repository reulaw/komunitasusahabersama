<head>
        <title>Chart - Komunitas Usaha Bersama</title>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
        <script type="text/javascript">
            google.charts.load('current', {packages:["orgchart"]});
            google.charts.setOnLoadCallback(drawChart);

            let treeData = [
                @foreach($treeUsers as $treeUser)
                    {
                        referral_code: '{{ e($treeUser->referral_code) }}',
                        referred_code: '{{ $treeUser->referred_code ? e($treeUser->referred_code) : "" }}',
                        user_id: '{{ e($treeUser->user_id) }}',
                        nama: '{{ e($treeUser->nama) }}'
                    },
                @endforeach
            ];

            function drawChart(selectedReferralCode = '') {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Referral Code');
                data.addColumn('string', 'Referred Code');
                data.addColumn('string', 'ToolTip');

                let filteredData = selectedReferralCode ? treeData.filter(item => item.referral_code === selectedReferralCode || item.referred_code === selectedReferralCode) : treeData;
                
                let rows = filteredData.map(item => [
                    { 
                        v: item.referral_code, 
                        f: `<div class="org-card">
                                <strong>${item.user_id}</strong><br>
                                <small>${item.referral_code}</small><br>
                                <small>${item.nama}</small><br>
                            </div>` 
                    }, 
                    item.referred_code, 
                    item.user_id
                ]);
                
                data.addRows(rows);
                var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
                chart.draw(data, {allowHtml: true, compactRows:true});
            }

            function updateChart() {
                let selectedReferral = document.getElementById('referralFilter').value;
                drawChart(selectedReferral);
            }
        </script>

        <style>
            body {
                background-color: #f8f9fa;
            }
            .chart-container {
                max-width: 900px;
                margin: 30px auto;
                padding: 20px;
                background: white;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .org-card {
                padding: 10px;
                border-radius: 8px;
                background: linear-gradient(135deg, #4CAF50, #388E3C);
                color: white;
                text-align: center;
                font-size: 14px;
                box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            }
            .org-card small {
                font-size: 12px;
                display: block;
                opacity: 0.8;
            }
            td.google-visualization-orgchart-node {
                background: transparent !important;
                border: none !important;
                box-shadow: none !important;
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
                <label for="referralFilter">Filter by Referral Code:</label>
                <select id="referralFilter" class="form-select" onchange="updateChart()">
                    <option value="">All</option>
                    @foreach($treeUsers as $treeUser)
                        <option value="{{ e($treeUser->referral_code) }}">{{ e($treeUser->referral_code) }} - {{ e($treeUser->nama) }}</option>
                    @endforeach
                </select>
                <br>
                <div id="chart_div"></div>
            </div>
        </div>
    </div>
    @endsection
