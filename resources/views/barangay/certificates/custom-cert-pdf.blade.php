<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate Request ( Customized Certificate )</title>
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

        .certificate-title {
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            width: 100%;
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
        p {
            margin-left: 70px;
        }

        .concern {
            font-weight: bold;
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
        .seal {
            font-weight: bold;
            text-transform: capitalize;
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
            <br>
        </div>
    
        <div>
            <!-- Certificate Information Section -->
            <div class="information-detail">
                <h3 class="certificate-title">{{ $certificateName ?? 'Certificate' }}</h3>
                <br>
                <br>
                <br>
                <p class="ml-[15px] concern">TO WHOM IT MAY CONCERN:</p>
                <br>
                <br>
                <p class="text">
                    This is to certify that 
                    <span class="name">
                        {{ $resident->first_name }} {{ $resident->last_name }} {{ $resident->suffix }}
                    </span>, 
                    {{ \Carbon\Carbon::parse($resident->birth_date)->age }} years old,
                    {{ $resident->gender }}, {{ $resident->civil_status }} is 
                </p>
                <p>a bona fide resident of 
                    Purok {{ $resident->purok->purok_number }}, Barangay {{ $barangay->barangay_name }}, Tubigon, Bohol.</p>
                <br>



                <p>{{ $purpose ?? null }}.</p>
                <br>
                <p class="text">
                    {{ $secondpurpose ?? null }}
                </p>
                <br>
                <p class="text">Issued this {{ \Carbon\Carbon::now()->format('d') }}
                    @php
                        $day = \Carbon\Carbon::now()->format('d');
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
                     {{ \Carbon\Carbon::now()->format('F, Y') }}
                    at {{ $barangay->barangay_name }}, Tubigon, Bohol.</p>
                <p class="text-last">Tubigon, Bohol, Philippines.</p>
                <br>
                <br>
                <p>
                @foreach ($barangayOfficials as $official)
                    @if ($official->position === 'Barangay Captain')
                        <p class="last-info">{{ $official->resident->first_name }} {{ strtoupper(substr($official->resident->middle_name, 0, 1)) }}. {{ $official->resident->last_name }}</p>
                    @endif
                @endforeach
                </p>
                <p class="last-info2">punong barangay</p>
                <br>
                <p>Paid under OR No: <span class="footer">{{$or_number}}</span>  </p>
                <p>Date: <span class="footer-2">{{ \Carbon\Carbon::now()->format('F j, Y') }}</span> </p>
                <p>Place Issued: <span class="footer-3">{{ $barangay->barangay_name }}, Tubigon, Bohol</span> </p>
                <br>
                <br>
                <br>
                <p class="seal">Not Valid without official seal.</p>
            </div>
        </div>
    </div>
</body>
</html>

