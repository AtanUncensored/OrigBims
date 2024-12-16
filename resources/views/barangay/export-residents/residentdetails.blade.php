<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <h1>Resident List</h1>
    <table>
        <thead>
            <tr>
                <th style="font-weight: bold;">First Name</th>
                <th style="font-weight: bold;">Last Name</th>
                <th style="font-weight: bold;">Middle Name</th>
                <th style="font-weight: bold;">Suffix</th>
                <th style="font-weight: bold;">Purok</th>
                <th style="font-weight: bold;">Birth Date</th>
                <th style="font-weight: bold;">Birth Place</th>
                <th style="font-weight: bold;">Gender</th>
                <th style="font-weight: bold;">Civil Status</th>
                <th style="font-weight: bold;">Phone Number</th>
                <th style="font-weight: bold;">Citizenship</th>
                <th style="font-weight: bold;">Nickname</th>
                <th style="font-weight: bold;">Email</th>
                <th style="font-weight: bold;">Current Address</th>
                <th style="font-weight: bold;">Permanent Address</th>
                <th style="font-weight: bold;">Household</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($residents as $resident)
                <tr>
                    <td>{{ $resident->first_name }}</td>
                    <td>{{ $resident->last_name }}</td>
                    <td>{{ $resident->middle_name }}</td>
                    <td>{{ $resident->suffix }}</td>
                    <td>{{ $resident->purok->purok_name ?? 'N/A' }}</td>
                    <td>{{ $resident->birth_date }}</td>
                    <td>{{ $resident->place_of_birth }}</td>
                    <td>{{ $resident->gender }}</td>
                    <td>{{ $resident->civil_status }}</td>
                    <td>{{ $resident->phone_number }}</td>
                    <td>{{ $resident->citizenship }}</td>
                    <td>{{ $resident->nickname }}</td>
                    <td>{{ $resident->email }}</td>
                    <td>{{ $resident->current_address }}</td>
                    <td>{{ $resident->permanent_address }}</td>
                    <td>
                        @foreach ($resident->households as $household)
                            {{ $household->household_name }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
