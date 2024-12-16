@extends('barangay.templates.navigation-bar')

@section('title', 'Logs')

@section('content')
    <div class="bg-white py-2 px-4 rounded-lg shadow-lg mr-4 ml-4">
            <h2 class="text-xl font-bold text-blue-500 mb-4">ACTIVITY LOGS:</h2>
      
        <div class="max-h-[70vh] overflow-y-auto border border-[2px] border-gray-200">
            @if($logs->isEmpty())
                <p class="text-center text-gray-500 py-4">Currently no Admin activity logs available yet.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200 ">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-2 px-4 text-center text-[12px] font-medium bg-gray-600 text-white uppercase tracking-wider">Activity Done</th>
                            <th class="px-6 py-3 text-center text-[12px] font-medium bg-gray-600 text-white uppercase tracking-wider">Timestamp</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                         @foreach($logs as $log)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="px-4 py-2 text-gray-800 whitespace-nowrap">{{$log->log_entry}}</td>
                            <td class="px-4 py-2 text-green-800 text-center whitespace-nowrap">{{$log->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
