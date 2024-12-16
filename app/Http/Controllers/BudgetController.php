<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Export\BudgetDataExport;

class BudgetController extends Controller
{
    public function index()
    {
        // Get the currently logged-in user's barangay
        $userBarangayId = Auth::user()->barangay_id;

        // Fetch budget reports belonging to the user's barangay
        $budgetReports = Budget::where('barangay_id', $userBarangayId)->get();

        //mo calculate sa totalCost
        $totalExpenses = $budgetReports->sum('cost');

        // Return the view with the budget reports for the user
        return view('barangay.budget-report.index', ['budgetReports' => $budgetReports, 'totalExpenses' => $totalExpenses]);
    }

    public function userIndex()
    {
        // Get the currently logged-in user's barangay
        $userBarangayId = Auth::user()->barangay_id;

        // Fetch budget reports belonging to the user's barangay
        $budgetReports = Budget::where('barangay_id', $userBarangayId)->get();

        //calculating the totalcost
        $totalExpenses = $budgetReports->sum('cost');


        // Return the view with the budget reports for the user
        return view('user.budget-report.index', ['budgetReports' => $budgetReports, 'totalExpenses' => $totalExpenses]);
    }

    public function createBudgetReport() {
        return view('barangay.budget-report.create_budget_report');
    }

    public function storeBudgetReport(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'item' => 'required|string|max:255',
            'cost' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'period_from' => 'required|date',
            'period_to' => 'required|date|after:period_from',

        ]);

        // Get the currently logged-in user's barangay
        $userBarangayId = Auth::user()->barangay_id;
        $userId = Auth::user()->id;

        // Create a new budget report and associate it with the user's barangay
        $budgetReport = new Budget($validatedData);
        $budgetReport->user_id = $userId;  // Associate report with user
        $budgetReport->barangay_id = $userBarangayId;  // Associate report with barangay
        $budgetReport->save();

        return redirect()->route('barangay.budget-report.index')->with('success', 'Budget report added successfully.');
    }

    public function editBudgetReport(Budget $budgetReport)
{
    // Ensure the budget report belongs to the logged-in user's barangay
    $userBarangayId = Auth::user()->barangay_id;

    if ($budgetReport->barangay_id !== $userBarangayId) {
        abort(403, 'Unauthorized action.');
    }

    // Return the view with the budget report to edit
    return view('barangay.budget-report.edit_budget_report', ['budgetReport' => $budgetReport]);
}

public function updateBudgetReport(Request $request, Budget $budgetReport)
{
    // Ensure the budget report belongs to the logged-in user's barangay
    $userBarangayId = Auth::user()->barangay_id;

    if ($budgetReport->barangay_id !== $userBarangayId) {
        abort(403, 'Unauthorized action.');
    }

    // Validate the request data
    $validatedData = $request->validate([
        'item' => 'required|string|max:255',
        'cost' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'period_from' => 'required|date',
        'period_to' => 'required|date',
    ]);

    // Update the budget report with the validated data
    $budgetReport->update($validatedData);

    // Redirect back with a success message
    return redirect()->route('barangay.budget-report.index')->with('success', 'Budget report updated successfully.');
}

public function deleteBudgetReport(Budget $budgetReport)
{
    // Ensure that the budget report belongs to the current user's barangay
    $userBarangayId = Auth::user()->barangay_id;

    if ($budgetReport->barangay_id !== $userBarangayId) {
        return redirect()->back()->withErrors('You are not authorized to delete this budget report.');
    }

    // Delete the budget report
    $budgetReport->delete();

    // Redirect back to the index page with a success message
    return redirect()->route('barangay.budget-report.index')->with('success', 'Budget report deleted successfully.');
}

public function exportExcel()
{
    $barangayId = auth()->user()->barangay_id;
    return Excel::download(new BudgetDataExport($barangayId), 'budgets.xlsx');
}

public function userExportExcel()
{
    $barangayId = auth()->user()->barangay_id;
    return Excel::download(new BudgetDataExport($barangayId), 'budgets.xlsx');
}

}
