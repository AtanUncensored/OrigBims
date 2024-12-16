<?php

namespace App\Exports\Export;

use App\Models\Budget;
use App\Models\Barangay;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class BudgetDataExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $budgets;
    private $totalExpenses;
    private $barangayName;

    public function __construct($barangayId) {
        // Retrieve barangay name using the barangay_id
        $barangay = Barangay::find($barangayId); // Find the barangay by ID
        $this->barangayName = $barangay ? $barangay->barangay_name : 'Unknown Barangay'; // Handle null cases

        // Retrieve budgets for the barangay
        $this->budgets = Budget::where('barangay_id', $barangayId)->get();

        // Calculate total expenses
        $this->totalExpenses = $this->budgets->sum('cost');
    }

    public function view(): View {
        return view('barangay.export-budgets.budgetdetails', [
            'budgets' => $this->budgets,
            'totalExpenses' => $this->totalExpenses,
            'barangayName' => $this->barangayName, // Pass the barangay name to the view
        ]);
    }
}
