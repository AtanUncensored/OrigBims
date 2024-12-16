@extends('lgu.lgu-template.navigation-bar')

@section('content')

<div class=" px-4">
    
    <div class="bg-white rounded-lg py-2 px-4 shadow-lg">
        <h1 class="text-xl font-bold text-blue-500 mb-4">AVAILABLE BARANGAYS:</h1>

        <div class="max-h-[40vh] lg:max-h-[28vh] overflow-y-auto">
            <div class="flex flex-wrap">
                @foreach($barangays as $barangay)
                    <div class="w-full md:w-1/4 py-2 px-4">
                        <div class="bg-white border border-[2px] border-gray-200 rounded-lg p-4">
                            <div class="flex justify-start items-center mb-2">
                                @php
                                    $iconColors = [
                                        'text-blue-500', 'text-green-500', 'text-red-500', 
                                        'text-yellow-500', 'text-purple-500', 'text-pink-500', 
                                        'text-indigo-500', 'text-teal-500', 'text-orange-500', 
                                        'text-cyan-500', 'text-amber-500', 'text-lime-500'
                                    ];
                                    $iconColor = $iconColors[$loop->index % count($iconColors)];
                                @endphp
    
                                <i class="fas fa-map-marker-alt {{ $iconColor }} text-2xl mr-2"></i>
                                <p class="text-blue-600 text-[16px] font-semibold">{{ $barangay->barangay_name }}</p>
                            </div>

                            <hr class="border-t-2 mb-3 border-gray-300">

                            <div class="flex justify-between items-center">
                                <h2 class="text-[14px] font-semibold text-gray-500">Tubigon, Bohol, Philippines</h2>
                                <div class="flex justify-end w-[50%] items-center">
                                    <p class="text-green-700 font-bold py-1 px-4 text-[13px] rounded-full bg-green-200 mt-4"> <i class="fa-solid fa-angles-up"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-4 bg-white rounded-lg shadow-lg py-2 px-4">
        <h1 class="text-xl font-bold text-blue-500 mb-3">OVERALL RECORD:</h1>

        <!-- Chart only visible on larger devices -->
        <div class="hidden md:block">
            <canvas id="barangayChart" class="w-full h-auto max-h-[200px]"></canvas>
        </div>

        <!-- Statistics list visible on smaller devices -->
        <div class="md:hidden grid grid-cols-1 gap-2 max-h-[22vh] lg:max-h-[28vh] overflow-y-auto">
            <div class="flex justify-between items-center text-[14px] border-b py-2">
                <span class="font-semibold text-gray-700">Total Residents</span>
                <span class="text-blue-500 font-bold">{{ $totalUsers }}</span>
            </div>
            <div class="flex justify-between items-center text-[14px] border-b py-2">
                <span class="font-semibold text-gray-700">Total Males</span>
                <span class="text-blue-500 font-bold">{{ $totalMales }}</span>
            </div>
            <div class="flex justify-between items-center text-[14px] border-b py-2">
                <span class="font-semibold text-gray-700">Total Females</span>
                <span class="text-blue-500 font-bold">{{ $totalFemales }}</span>
            </div>
            <div class="flex justify-between items-center text-[14px] border-b py-2">
                <span class="font-semibold text-gray-700">Total Adults</span>
                <span class="text-blue-500 font-bold">{{ $totalAdults }}</span>
            </div>
            <div class="flex justify-between items-center text-[14px] border-b py-2">
                <span class="font-semibold text-gray-700">Total Seniors</span>
                <span class="text-blue-500 font-bold">{{ $totalSeniors }}</span>
            </div>
            <div class="flex justify-between items-center text-[14px] border-b py-2">
                <span class="font-semibold text-gray-700">Total Youth</span>
                <span class="text-blue-500 font-bold">{{ $totalYouth }}</span>
            </div>
            <div class="flex justify-between items-center text-[14px] border-b py-2">
                <span class="font-semibold text-gray-700">Total Children</span>
                <span class="text-blue-500 font-bold">{{ $totalChildren }}</span>
            </div>
            <div class="flex justify-between items-center text-[14px] border-b py-2">
                <span class="font-semibold text-gray-700">Total Households</span>
                <span class="text-blue-500 font-bold">{{ $householdCount }}</span>
            </div>
            <div class="flex justify-between items-center text-[14px] border-b py-2">
                <span class="font-semibold text-gray-700">Married Residents</span>
                <span class="text-blue-500 font-bold">{{ $marriedCount }}</span>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('barangayChart').getContext('2d');
        let barangayChart;

        const data = {
            labels: [
                'Total Residents', 
                'Total Males', 
                'Total Females', 
                'Total Adults', 
                'Total Seniors', 
                'Total Youth', 
                'Total Children', 
                'Total Households', 
                'Married Residents'
            ],
            datasets: [{
                label: 'Population Statistics',
                data: [
                    {{ $totalUsers }},
                    {{ $totalMales }},
                    {{ $totalFemales }},
                    {{ $totalAdults }},
                    {{ $totalSeniors }},
                    {{ $totalYouth }},
                    {{ $totalChildren }},
                    {{ $householdCount }},
                    {{ $marriedCount }}
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        };

        barangayChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    });
</script>
@endsection
