<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate Request ( Business Permit )</title>
    <style>

        * {
            padding: 0;
            margin: 0;
        }

        .heading {
            text-align: center;
            margin-top: -95px;
        }

        .last-title {
            padding-bottom: 40px;
        }

        .details {
            margin: 15px;
        }

        .info-heading {
            width: 100%;   
            font-size: 13px; 
            margin-top: 25px;
            margin-left: 150px;
        }

        .info-title {
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            width: 500px;
            text-transform: uppercase;
        }

        .name, .purpose {
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .text {
            margin-left: 120px;
        }

        .text-last {
            margin-bottom: 
        }
        .last-info {
            font-weight: bold;
            text-align: right;
            text-transform: uppercase;
            margin-right: 130px;
        }

        .last-info2 {
            text-align: right;
            font-size: 16px;
            text-transform: capitalize;
            margin-right: 130px;
        }

        .logo {
            margin-left: 130px;
            margin-top: 90px;
        }

        .barangay-office {
            font-weight: bold;
            text-transform: uppercase;
        }

        .barangay-name {
            text-transform: uppercase;
        }

        .purok {
            font-weight: bold;
            text-transform: capitalize;
        }
        p {
            margin-left: 70px;
        }
        .footer {
            font-weight: bold;
            text-transform: capitalize;
            margin-left: 2px;
        }
        .footer-2 {
            font-weight: bold;
            text-transform: capitalize;
            margin-left: 95px;
        }
        .footer-3 {
            font-weight: bold;
            text-transform: capitalize;
            margin-left: 45px;
        }
        .footer-4 {
            font-weight: bold;
            text-transform: capitalize;
            margin-left: 20px;
        }
        .footer-5 {
            font-weight: bold;
            text-transform: capitalize;
            margin-left: 73px;
        }
        .name2 {
            font-weight: bold;
            text-transform: capitalize;
        }
        .date {
            font-weight: bold;
        }
    </style>
</head>
<body> 
    <div class="container">
        <div class="logo">
            <img src="{{ public_path('storage/images/' . $barangay->logo) }}" style="width: 120px; height:auto" alt="">
        </div>
        <div class="heading">
            <header>Republic of the Philippines</header>
            <header>Province of Bohol</header>
            <header>Municipality of Tubigon</header>
            <header class="barangay-name">OFFICE OF THE BARANGAY CAPTAIN</header>
            <br>
        </div>
        <div class="content">  
            <div class="information-detail">
                <div class="info-heading">
                    <h2 class="info-title">Business Permit</h2>
                </div>
                <br>
                <br>
                <br>
                <p class="text">Permit is hereby granted to <span class="name">{{ $certificateRequest->resident->first_name }} {{ strtoupper(substr($certificateRequest->resident->middle_name, 0, 1)) }}. {{ $certificateRequest->resident->last_name }}</span>, {{ $certificateRequest->resident->citizenship }} , of legal age, is a resident of</p>
                <p>{{ $barangay->barangay_name }}, Tubigon, Bohol to open/operate "A {{ $certificateRequest->business_name}} located at <span class="purok">Purok {{ $certificateRequest->resident->purok->purok_number}}, {{ $certificateRequest->resident->purok->purok_name}}, {{ $barangay->barangay_name }},Tubigon, Bohol.</span></p>
                <br>
                <br>
                <p class="text">Provided that peace and order should be maintained always.</p>
                <br>
                <br>
                <p>This certification is issued upon request of 
                    <span class="name2">
                    @if($certificateRequest->resident->gender == 'male')
                       Mr.
                    @elseif($certificateRequest->resident->gender == 'female')
                       Ms.
                    @endif
                    {{ $certificateRequest->resident->first_name }} {{ strtoupper(substr($certificateRequest->resident->middle_name, 0, 1)) }}. {{ $certificateRequest->resident->last_name }}</span>, for whatever any legal purpose
                </p>
                <p>this may serve @if($certificateRequest->resident->gender == 'male')
                    him
                 @elseif($certificateRequest->resident->gender == 'female')
                    her
                 @endif best.</p>
                <br>
                <p class="text">Given this <span class="date">{{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('j') }}
                   @php
                        $day = \Carbon\Carbon::parse($certificateRequest->date_needed)->format('j');
                    @endphp
                    @if(in_array($day, [1, 21, 31]))
                    st
                    @elseif(in_array($day, [2, 22]))
                    nd
                    @elseif(in_array($day, [3, 23]))
                    rd
                    @else
                    th
                    @endif
                    day of
                     {{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('F, Y') }}
                    </span>
                    at Barangay {{ $barangay->barangay_name }}, Tubigon, Bohol.</p>
                <br>
                <br>
                <br>
                <br>
                @foreach ($barangayOfficials as $official)
                    @if ($official->position === 'Barangay Captain')
                        <p class="last-info">{{ $official->resident->first_name }} {{ strtoupper(substr($official->resident->middle_name, 0, 1)) }}. {{ $official->resident->last_name }}</p>
                    @endif
                @endforeach
                <div class="line-break-last"></div>
                <p class="last-info2">barangay captain</p>
                <br>
                <br>
                <br>
                <br>
                <p>Paid under O.R No: <span class="footer">{{$certificateRequest->or_number}}</span>  </p>
                <p>Date: <span class="footer-2">{{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('F j, Y') }}</span> </p>
                <p>Amount: <span class="footer-5">P{{ $certType->price }}</span> </p>
                <p>Doc. Stamp Tax: <span class="footer-4">P30.00</span> </p>
                <br>
                <br>
                <br>
                <p class="barangay-office ">Not valid without an official seal.</p>
            </div>
        </div>
    </div>
</body>
</html>
