<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate Request ( Jobseekers )</title>
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
        .info-title2 {
            font-weight: bold;
            text-align: center;
            font-size: 20px;
            width: 500px;
            text-transform: capitalize;
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
            margin-right: 170px;
        }

        .last-info2 {
            text-align: right;
            font-size: 16px;
            text-transform: capitalize;
            margin-right: 170px;
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
        .date {
            font-weight: bold;
            text-transform: capitalize;
        }
        .last-date {
            text-align: right;
            margin-right: 220px;
        }
        .last-witness {
            text-align: right;
            margin-right: 180px;
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
                    <h2 class="info-title">Barangay Certification</h2>
                    <h3 class="info-title2">(First Time Jobseekers Assistance Act-RA11261)</h3>
                </div>
                <br>
                <br>
                <br>
                <p class="text">This is to certify that <span class="name">{{ $certificateRequest->resident->first_name }} {{ strtoupper(substr($certificateRequest->resident->middle_name, 0, 1)) }}. {{ $certificateRequest->resident->last_name }}</span>, {{ $certificateRequest->resident->citizenship }}, {{ $certificateRequest->resident->gender }}, {{ $certificateRequest->resident->civil_status }}, of legal age, is a</p>
                <p>bona fide resident of {{ $barangay->barangay_name }}, Tubigon, Bohol.</p>
                <br>
                <p class="text">
                  @if($certificateRequest->resident->gender == 'male')
                    He
                  @elseif($certificateRequest->resident->gender == 'female')
                    She
                  @endif
                     is qualified avilee of RA11261 or the First Time Jobseekers Act of 2019
                </p>
                <br>
                <p class="text">I further certify that the holder/bearer was informed of 
                  @if($certificateRequest->resident->gender == 'male')
                    his
                  @elseif($certificateRequest->resident->gender == 'female')
                    her
                  @endif
                    rights, including the duties
                </p>
                <p>and responsibilities accorded by RA 11261 through the oath of undertaking
                    @if($certificateRequest->resident->gender == 'male')
                    he
                  @elseif($certificateRequest->resident->gender == 'female')
                    she
                  @endif
                    has signed and</p>
                <p>executed in the presence  of our Barangay Official.</p>
                <br>
                <p class="text">Signed this <span class="date">{{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('j') }}
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
                     of Barangay {{ $barangay->barangay_name }}, Tubigon, Bohol.</p>
                <br>
                <p class="text">This certification is valid only until {{ \Carbon\Carbon::now()->addMonths(2)->format('F Y') }}</p>
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
                <p class="last-info2">{{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('F j, Y') }}</p>
                <p class="last-date">Date</p>
                <br>
                <p class="last-witness">Witnessed by:</p>
                <br>
                <p  class="last-witness">{{$certificateRequest->witness_by}}</p>
                <p>Not Valid Without Official Seal</p>
       
                <p class="last-info2">{{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('F j, Y') }}</p>
                <p class="last-date">Date</p>
            </div>
        </div>
    </div>
</body>
</html>
