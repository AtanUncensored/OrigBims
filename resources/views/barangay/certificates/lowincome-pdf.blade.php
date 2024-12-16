<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate Request ( Low Income Certificate)</title>
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
            margin-right: 200px;
        }

        .last-info2 {
            text-align: right;
            font-size: 16px;
            text-transform: capitalize;
            margin-right: 200px;
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
                    <h2 class="info-title">Certificate of Low Income</h2>
                </div>
                <br>
                <br>
                <br>
                <p><b>TO WHOM IT MAY CONCERN:</b></p>
                <br>
                <br>
                <p class="text">
                    This is to certify that 
                    <span class="name">
                        @if($certificateRequest->resident->gender == 'male')
                            Mr. 
                        @elseif($certificateRequest->resident->gender == 'female' && $certificateRequest->resident->civil_status == 'married')
                            Mrs. 
                        @elseif($certificateRequest->resident->gender == 'female' && $certificateRequest->resident->civil_status != 'married')
                            Miss. 
                        @endif
                        {{ $certificateRequest->resident->first_name }} {{ $certificateRequest->resident->last_name }} {{ $certificateRequest->resident->suffix }}
                    </span>, 
                    {{ \Carbon\Carbon::parse($certificateRequest->resident->birth_date)->age }} years old, 
                    {{ $certificateRequest->resident->citizenship }}, 
                    {{ $certificateRequest->resident->civil_status }}
                </p>
                <p>and a bona fide resident of 
                    Purok {{ $certificateRequest->resident->purok->purok_number}} {{ $barangay->barangay_name }}, Tubigon, Bohol.</p>
                <br>
                <p class="text">This is to certify further that 
                    <span class="name">
                        @if($certificateRequest->resident->gender == 'male')
                            Mr. 
                        @elseif($certificateRequest->resident->gender == 'female' && $certificateRequest->resident->civil_status == 'married')
                            Mrs. 
                        @elseif($certificateRequest->resident->gender == 'female' && $certificateRequest->resident->civil_status != 'married')
                            Miss. 
                        @endif
                        {{ $certificateRequest->resident->first_name }} {{ $certificateRequest->resident->last_name }} {{ $certificateRequest->resident->suffix }}
                    </span>
                    is earning a
                </p>
                <p> @if(isset($monthly_ave_income))
                    Monthly Average Income of {{ number_format($monthly_ave_income, 2) }} pesos.
                @else
                    No income data available.
                @endif</p>
                <br>
                <p class="text">This certification is being issued upon the request of <b class="name">{{$certificateRequest->requester_name}}</b>
                    for the purpose of
                </p>
                <p>{{ $certificateRequest->purpose }}.</p>
                <br>
                <p class="text">Issued this {{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('j') }}
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
                    at {{ $barangay->barangay_name }}, Tubigon, Bohol.</p>
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
                <div class="line-break-last"></div>
                <p class="last-info2">punong barangay</p>
                <br>
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
                <p>Not Valid without official seal.</p>
            </div>
        </div>
    </div>
</body>
</html>
