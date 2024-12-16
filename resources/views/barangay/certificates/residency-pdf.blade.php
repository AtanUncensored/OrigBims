<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate Request ( Residency Certificate )</title>
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
            margin-right: 150px;
        }

        .last-info2 {
            text-align: right;
            font-size: 16px;
            text-transform: capitalize;
            margin-right: 150px;
        }

        .logo {
            margin-left: 155px;
            margin-top: 90px;
        }

        .barangay-name , .barangay-office {
            font-weight: bold;
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
            <header class="barangay-name">BARANGAY OF {{ $barangay->barangay_name }}</header>
            <br>
            <header class="barangay-office">OFFICE OF THE PUNONG BARANGAY</header>
            <div class="line-break"></div>
        </div>
        <div class="content">  
            <div class="information-detail">
                <div class="info-heading">
                    <h2 class="info-title">Certificate of Residency</h2>
                </div>
                <br>
                <br>
                <br>
                <p class="text">This is to certify that <span class="name">{{ $certificateRequest->resident->first_name }} {{ strtoupper(substr($certificateRequest->resident->middle_name, 0, 1)) }}. {{ $certificateRequest->resident->last_name }}</span> , {{ $certificateRequest->resident->citizenship }}, {{ \Carbon\Carbon::parse($certificateRequest->resident->birth_date)->age }} years old, {{ $certificateRequest->resident->gender }}, is a bona fide </p>
                <p>resident of <span class="purok">Purok {{ $certificateRequest->resident->purok->purok_number}}, {{ $certificateRequest->resident->purok->purok_name}}, {{ $barangay->barangay_name }}, Tubigon, Bohol.</span></p>
                <br>
                <p class="text">This certification is being issued upon the request of the above-named person in
                    @if($certificateRequest->resident->gender == 'male')
                      his
                    @elseif($certificateRequest->resident->gender == 'female')
                      her
                    @endif
                    desire 
                </p>
                <p> to {{ $certificateRequest->purpose }} 
               and for whatever any legal purposes this may serve
                    @if($certificateRequest->resident->gender == 'male')
                    him
                  @elseif($certificateRequest->resident->gender == 'female')
                    her
                  @endif best.  
                </p>
                <br>
                <p class="text">Given this {{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('j') }}
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
                    at Barangay {{ $barangay->barangay_name }}, Tubigon, Bohol.</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                @foreach ($barangayOfficials as $official)
                    @if ($official->position === 'Barangay Captain')
                        <p class="last-info">{{ $official->resident->first_name }} {{ strtoupper(substr($official->resident->middle_name, 0, 1)) }}. {{ $official->resident->last_name }}</p>
                    @endif
                @endforeach
                <p class="last-info2">punong barangay</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p>Paid under O.R No: <span class="footer">{{$certificateRequest->or_number}}</span>  </p>
                <p>Date: <span class="footer-2">{{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('F j, Y') }}</span> </p>
                <p>Amount: <span class="footer-5">P{{ $certType->price }}</span> </p>
                <p>Place Issued: <span class="footer-3">{{ $barangay->barangay_name }}, Tubigon, Bohol</span> </p>
                <p>Doc. Stamp Tax: <span class="footer-4">P30.00</span> </p>
                <br>
                <br>
                <br>
                <p>Not valid without an official seal.</p>
            </div>
        </div>
    </div>
</body>
</html>
