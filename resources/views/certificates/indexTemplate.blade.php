@extends('user.templates.navigation-bar')

@section('title', 'Request Certificate')

@section('content')

<div class="max-w-6xl mx-auto my-8 bg-white rounded-lg shadow-lg overflow-hidden">

    @if($residents->isEmpty())
        <p class="text-center text-gray-500 mt-6 text-lg">No residents found.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-3 px-6 text-left font-medium text-gray-700 border-b">Full Name</th>
                        <th class="py-3 px-6 text-left font-medium text-gray-700 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($residents as $resident)
                        <tr class="border-t hover:bg-gray-50 transition duration-300">
                            <td class="py-4 px-6">{{ $resident->first_name }} {{ $resident->last_name }}</td>
                            <td class="py-4 px-6">
                                <a 
                                    href="{{ route('certificates.createTemplate', ['resident_id' => $resident->id]) }}"
                                    class="inline-block bg-green-500 text-white font-bold rounded-lg px-4 py-2 hover:bg-green-600 transition-all duration-300"
                                >
                                    Generate Custom Certificate
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
