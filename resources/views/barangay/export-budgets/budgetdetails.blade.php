<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Budget Details Export</title>
</head>
<body>
    <!-- Title Section -->
    <table>
        <tr>
            <td colspan="4" style="font-size: 18px; font-weight: bold; text-align: center;">
                Barangay Budget Report
            </td>
        </tr>
        <tr>
            <td colspan="4" style="font-size: 14px; text-align: center;">
                Barangay Name: {{ $barangayName }}
            </td>
        </tr>
        <tr>
            <td colspan="4" style="font-size: 14px; text-align: center;">
                Generated on: {{ now()->format('F d, Y') }}
            </td>
        </tr>
        <tr><td colspan="4">&nbsp;</td></tr> <!-- Empty row for spacing -->
    </table>

    <!-- Table Headers -->
    <table border="1">
        <thead>
            <tr>
                <th style="font-weight: bold;">Item</th>
                <th style="font-weight: bold;">Cost</th>
                <th style="font-weight: bold;">Period From</th>
                <th style="font-weight: bold;">Period To</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($budgets as $budget)
            <tr>
                <td >{{ $budget->item }}</td>
                <td style="color: red;">₱ {{ $budget->cost }}</td>
                <td>{{ $budget->period_from }}</td>
                <td>{{ $budget->period_to }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1" style="text-align: left; font-weight: bold;">Total Expenses:</td>
                <td style="color: red">₱ {{ number_format($totalExpenses, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
