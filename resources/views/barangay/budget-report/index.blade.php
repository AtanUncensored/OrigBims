@extends('barangay.templates.navigation-bar')

@section('title', 'Budget Reports')

@section('content')

<div class="px-4">

    <div class="flex justify-end items-center mb-4">
        <form action="{{ route('budgets.download-excel')}}" method="POST" target="__blank">
            @csrf
            <div>
                <button class="py-2 px-3 text-white bg-green-500 rounded-lg  hover:bg-green-600 shadow-lg transition">
                    <i class="fa-solid fa-file-export"></i> Export
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white py-2 px-4 rounded-lg shadow-lg">
        <div class="flex justify-between mb-4">
        
            <h2 class="text-xl font-bold text-blue-500 mb-3">BUDGET LOGS:</h2>

            @if(session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-2">
                {{ session('success') }}
            </div>
            @endif

            <button onclick="toggleAddModal()" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500">
                <i class="fa-solid fa-plus"></i> Add Expense</a>
            </button>

            <div id="add-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                            
                <!-- Add Form -->
                <div class="mt-[20px] mb-6 w-[400px] mx-auto bg-white p-6 rounded shadow">

                    <div class="flex justify-center items-center mb-4">
                        <div class="flex justify-start items-center">
                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                        </div>
                        <div class="flex justify-center items-center">
                            <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Add New Expense</h1>
                        </div>
                        <div class="flex justify-start items-center">
                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                        </div>
                    </div>

                    <hr class="border-t-2 border-blue-300 mb-4">

                    <form action="{{ route('barangay.store-budgetReport') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="item" class="block text-gray-700 text-sm font-bold mb-2">Item:</label>
                            <input type="text" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="item" name="item" value="{{ old('item') }}">
                            @error('item')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cost" class="block text-gray-700 text-sm font-bold mb-2">Cost:</label>
                            <input type="number" step="0.01" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="cost" name="cost" value="{{ old('cost') }}">
                            @error('cost')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">description:</label>
                            <input type="text" step="0.01" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="description" name="description" value="{{ old('description') }}">
                            @error('description')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="period_from" class="block text-gray-700 text-sm font-bold mb-2">Period From:</label>
                            <input type="date" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="period_from" name="period_from" value="{{ old('period_from') }}">
                            @error('period_from')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="period_to" class="block text-gray-700 text-sm font-bold mb-2">Period To:</label>
                            <input type="date" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="period_to" name="period_to" value="{{ old('period_to') }}">
                            @error('period_to')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="flex justify-end mt-3">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mr-3">Submit</button>
                             
                            <button type="button" onclick="toggleAddModal()" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="max-h-[50vh] overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200 border border-[2px] border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 text-start text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Expense Used</th>
                        <th class="px-6 py-3 text-start text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Cost</th>
                        <th class="px-6 py-3 text-start text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-start text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">DateTime</th>
                        <th class="px-6 py-3 text-center text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Actions</th>
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
                        <td class="py-2 px-4 border-b border-gray-200">{{ $report->period_from }} | {{ $report->period_to }}</td>
                        <td class="px-4 py-2 text-right whitespace-nowrap">
                            <div class="flex gap-2 justify-center items-center">
                                <button onclick="toggleEditModal('{{ $report->id }}')" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <div id="edit-modal-{{ $report->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                                    <!-- Edit Form -->
                                    <div class="mt-[20px] mb-6 w-[400px] mx-auto bg-white p-6 rounded shadow">
                                
                                        <div class="flex justify-center items-center mb-4">
                                            <div class="flex justify-start items-center">
                                                <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                                            </div>
                                            <div class="flex justify-center items-center">
                                                <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Edit Budget Report</h1>
                                            </div>
                                            <div class="flex justify-start items-center">
                                                <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                                            </div>
                                        </div>
                                
                                        <hr class="border-t-2 border-blue-300 mb-4">
                                
                                        <form action="{{ route('barangay.budget-report.update', $report->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                    
                                            <div class="mb-3">
                                                <label for="item" class="block text-start text-gray-700 text-sm font-bold mb-2">Item</label>
                                                <input type="text" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="item" name="item" value="{{ old('item', $report->item) }}" required>
                                            </div>
                                    
                                            <div class="mb-3">
                                                <label for="cost" class="block  text-start text-gray-700 text-sm font-bold mb-2">Cost</label>
                                                <input type="text" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="cost" name="cost" value="{{ old('cost', $report->cost) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="block  text-start text-gray-700 text-sm font-bold mb-2">Description</label>
                                                <input type="text" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="description" name="description" value="{{ old('description', $report->description) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="period_from" class="block  text-start text-gray-700 text-sm font-bold mb-2">Period From</label>
                                                <input type="date" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="period_from" name="period_from" value="{{ old('period_from', $report->period_from) }}" required>
                                            </div>
                                    
                                            <div class="mb-3">
                                                <label for="period_to" class="block  text-start text-gray-700 text-sm font-bold mb-2">Period To</label>
                                                <input type="date" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="period_to" name="period_to" value="{{ old('period_to', $report->period_to) }}" required>
                                            </div>
                                    
                                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mr-3">Update Report</button>

                                            <button type="button" onclick="toggleEditModal('{{ $report->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                Cancel
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <button onclick="toggleDeleteModal('{{ $report->id }}')" class="text-red-700 lg:text-[14px] text-[7px] py-1 px-2 md:px-3 rounded hover:text-red-900">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <div id="delete-modal-{{ $report->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-20">
                                    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3">
    
                                        <p class="text-left text-lg font-bold text-gray-600 uppercase mb-3">Item: 
                                            <span class="text-blue-600">{{ $report->item }}</span>
                                        </p>
                                        <p class="text-left text-lg font-bold text-gray-600 uppercase mb-3">cost: 
                                            <span class="text-blue-600">{{ $report->cost }}</span>
                                        </p>
                                        <hr class="border-t-2 border-gray-300">

                                        <p class="mb-5 mt-2 text-gray-600 text-left text-[17px]">Continue to delete this expense from the report?</p>
                                        <div class="flex justify-end space-x-4">
                                            <form action="{{ route('barangay.budget-report.delete', $report->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                    Delete
                                                </button>
                                            </form>
                                            <button type="button" onclick="toggleDeleteModal('{{ $report->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </td>
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

<script>
      function toggleAddModal() {
        const modal = document.getElementById(`add-modal`);
        modal.classList.toggle('hidden');
    }

    
    function toggleEditModal(reportId) {
        const modal = document.getElementById(`edit-modal-${reportId}`);
        modal.classList.toggle('hidden');
    }

    function toggleDeleteModal(id) {
        const modal = document.getElementById(`delete-modal-${id}`);
        if (modal) {
            modal.classList.toggle('hidden');
        }
    }
</script>
@endsection
