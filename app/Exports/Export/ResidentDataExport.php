<?php

namespace App\Exports\Export;

use App\Models\Resident;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Carbon\Carbon;

class ResidentDataExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $residents;

    public function __construct($barangayId, $search = null, $purokFilter = null, $genderFilter = null, $ageFilter = null, $isAliveFilter = null)
    {
        // Build the query for residents based on filters
        $residentsQuery = Resident::with(['households', 'purok'])  // Eager load households and purok relationships
            ->where('barangay_id', $barangayId);  // Only fetch residents from the given barangay

        // Apply search filtering if a search term is provided
        if ($search) {
            $residentsQuery->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        // Apply Purok filter if selected
        if ($purokFilter) {
            $residentsQuery->where('purok_id', $purokFilter);
        }

        // Apply Gender filter if selected
        if ($genderFilter) {
            $residentsQuery->where('gender', $genderFilter);
        }

        // Apply Age filter if selected
        if ($ageFilter) {
            switch ($ageFilter) {
                case 'children':
                    $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 0 AND 12');
                    break;
                case 'teens':
                    $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 13 AND 19');
                    break;
                case 'adults':
                    $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 20 AND 39');
                    break;
                case 'middle_aged':
                    $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 40 AND 59');
                    break;
                case 'senior':
                    $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 60');
                    break;
            }
        }

        // Apply "Is Alive" filter if selected
        if ($isAliveFilter !== null) {
            $residentsQuery->where('is_alive', $isAliveFilter);
        }

        // Fetch the residents matching the filters, order them, and calculate their age
        $this->residents = $residentsQuery->orderByRaw('is_alive DESC')
                                          ->orderBy('last_name')
                                          ->get()
                                          ->map(function ($resident) {
                                              // Calculate age based on birth_date
                                              $resident->age = Carbon::parse($resident->birth_date)->age;
                                              return $resident;
                                          });
    }

    public function view(): View
    {
        // Return the view with residents data
        return view('barangay.export-residents.residentdetails', [
            'residents' => $this->residents
        ]);
    }
}
