@extends('barangay.templates.navigation-bar')

@section('title', 'Complaints')

@section('content')

<div class="px-4 bg-gray-100">
    
        <!-- Search bar -->
        <div class="bg-white py-2 px-4 rounded-lg shadow-lg mb-4">
            <h2 class="text-xl font-bold text-blue-500 mb-3">LOOK FOR A COMPLAINT:</h2>
            <div class="flex justify-center mb-6">
                <form class="inline-flex items-center" method="GET" action="{{ route('barangay.complaints.index')}}">
                    <input type="text" name="search" placeholder="Search a record..." class="py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-gray-500">
                    <button type="submit" class="py-2 px-4 bg-gray-600 text-white rounded-r-md hover:bg-gray-600 transition"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>

        <div class="flex justify-between space-x-4">
            <div class="w-full bg-white p-4 rounded-lg shadow-lg max-h-[56vh] overflow-y-auto">
                <h3 class="text-xl text-center text-blue-600 font-semibold mb-4">-Latest Pending Complaints-</h3>
                <table class="min-w-full bg-white border border-gray-300 mb-6">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-300 text-gray-600">
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Complain Type</th>
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Date of Incident</th>
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($complaints->whereNull('reply')->sortByDesc('created_at') as $complaint)
                        <tr class="border-b">
                            <td class="py-3 px-6">{{ $complaint->complain_type }}</td>
                            <td class="py-3 px-6">{{ $complaint->date_of_incident }}</td>
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('barangay.complaints.view', $complaint->id) }}" class="text-blue-500 hover:underline mx-2">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-gray-500">No pending complaints.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="w-full bg-white p-4 rounded-lg shadow-lg max-h-[56vh] overflow-y-auto">
                    <h3 class="text-xl text-center text-green-600 font-semibold mb-4">-Replied Complaints-</h3>
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-300 text-gray-600">
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Complain Type</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Date of Incident</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($complaints->whereNotNull('reply')->sortByDesc('created_at') as $complaint)
                            <tr class="border-b">
                                <td class="py-3 px-6">{{ $complaint->complain_type }}</td>
                                <td class="py-3 px-6">{{ $complaint->date_of_incident }}</td>
                                <td class="py-3 px-6 text-center">
                                    <a href="{{ route('barangay.complaints.view', $complaint->id) }}" class="text-blue-500 hover:underline mx-2">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-4 text-center text-gray-500">No replied complaints.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
            </div>
        </div>
</div>

@endsection
