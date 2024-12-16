@extends('user.templates.navigation-bar')

@section('title', 'Budget Reports')

@section('content')

<div class="px-4">

    <div class="flex justify-end items-center mb-4">
        <form action="{{ route('user.budgets.download-excel')}}" method="POST" target="__blank">
            @csrf
            <div>
                <button class="py-2 px-3 text-white bg-green-500 rounded-lg  hover:bg-green-600 shadow-lg transition">
                    <i class="fa-solid fa-file-export"></i> Export
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white py-2 px-4 rounded-lg shadow-lg">
        <div class="flex justify-center items-center">
            @if(session('success'))
                <div class="alert alert-success mb-4 bg-green-100 text-green-800 border border-green-300 rounded-lg py-2 px-4">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="flex justify-between mb-4">
        
            <h2 class="text-xl font-bold text-blue-500 mb-3">BUDGET LOGS:</h2>
        
        </div>
        
        <div class="max-h-[45vh] overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200 border border-[2px] border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 text-start text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Expense Used</th>
                        <th class="px-6 py-3 text-start text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Cost</th>
                        <th class="px-6 py-3 text-start text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-center text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">DateTime</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if($budgetReports->isEmpty())
                    <tr>
                        <td colspan="4" class="py-4 px-6 text-center text-gray-500">
                            Currently no budget reports available yet.
                        </td>
                    </tr>
                    @else
                    @foreach ($budgetReports as $report)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="py-2 px-4 border-b border-gray-200">{{ $report->item }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $report->cost }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $report->description }}</td>
                        <td class="py-2 px-4 border-b text-center border-gray-200">{{ $report->period_from }} | {{ $report->period_to }}</td>
                    </tr>
                @endforeach
                    @endif
                </tbody>
            </table>
        </div>     
        <div class="text-end mt-3">
            <p class="font-semibold text-gray-700">Total Expenses:<span class="text-red-500">₱{{ number_format($totalExpenses, 2) }}</span></p>
        </div>
    </div>
</div>

@endsection