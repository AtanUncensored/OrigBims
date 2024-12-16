<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate Request ( Residency Certificate / Unifast Application )</title>
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
            margin-top: 40px;
            margin-right: 115px;
        }

        .last-info2 {
            text-align: right;
            font-size: 16px;
            text-transform: capitalize;
            margin-right: 130px;
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
        .and {
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
                <p class="text">This is to certify that <span class="name">{{ $certificateRequest->resident->first_name }} {{ $certificateRequest->resident->middle_name }} {{ $certificateRequest->resident->last_name }}</span>, {{ $certificateRequest->resident->citizenship }}, {{ \Carbon\Carbon::parse($certificateRequest->resident->birth_date)->age }} years old, {{ $certificateRequest->resident->gender }} is a</p>
                <p>bona fide resident of Purok {{ $certificateRequest->resident->purok->purok_number}}, {{ $certificateRequest->resident->purok->purok_name}}, {{ $barangay->barangay_name }}, Tubigon, Bohol.  
                        @if($certificateRequest->resident->gender == 'male')
                            He
                        @elseif($certificateRequest->resident->gender == 'female')
                            She
                        @else
                            They
                        @endif 
                        is the 
                        @if($certificateRequest->resident->gender == 'male')
                            Son
                        @elseif($certificateRequest->resident->gender == 'female')
                            Daughter
                        @else
                            Child
                        @endif 
                        of
                    </p>
                    <p>
                        @if($certificateRequest->resident->father && $certificateRequest->resident->mother)
                        <span class="name">
                            Mr. {{ $certificateRequest->resident->father->first_name }} 
                            {{ $certificateRequest->resident->father->middle_name ?? '' }} 
                            {{ $certificateRequest->resident->father->last_name ?? '' }}
                        </span> 
                        <span class="and">and</span> 
                        <span class="name">
                            Mrs. {{ $certificateRequest->resident->mother->first_name }} 
                            {{ $certificateRequest->resident->mother->middle_name ?? '' }} 
                            {{ $certificateRequest->resident->mother->last_name ?? '' }}
                        </span>. Both are residents of the afore-mentioned barangay.
                    @elseif($certificateRequest->resident->father)
                        <span class="name">
                            Mr. {{ $certificateRequest->resident->father->first_name }} 
                            {{ $certificateRequest->resident->father->middle_name ?? '' }} 
                            {{ $certificateRequest->resident->father->last_name ?? '' }}
                        </span>, who is a resident of the afore-mentioned barangay.
                    @elseif($certificateRequest->resident->mother)
                        <span class="name">
                            Mrs. {{ $certificateRequest->resident->mother->first_name }} 
                            {{ $certificateRequest->resident->mother->middle_name ?? '' }} 
                            {{ $certificateRequest->resident->mother->last_name ?? '' }}
                        </span>, who is a resident of the afore-mentioned barangay.
                    @else
                        no parent information provided.
                    @endif
                    </p>
                    
                <br>
                <p class="text">This certification is issued upon the request of <span class="name">{{ $certificateRequest->requester_name}}</span> for <span class="and">UNIFAST</span></p>
                <p> <span class="and">APPLICATION</span> and for whatever any legal purpose this may serve
                    @if($certificateRequest->resident->gender == 'male')
                    him
                  @elseif($certificateRequest->resident->gender == 'female')
                    her
                  @endif best.  
                </p>
                <br>
                <p class="text">Given this <span class="and">{{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('j') }}
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
                    @endif </span>
                    day of
                     <span class="and">{{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('F, Y') }}</span>
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
                <p class="last-info2">punong barangay</p>
                <br>
                <br>
                <p>Paid under O.R No: <span class="footer">{{$certificateRequest->or_number}}</span>  </p>
                <p>Amount: <span class="footer-5">P{{ $certType->price }}</span> </p>
                <p>Date: <span class="footer-2">{{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('F j, Y') }}</span> </p>
                <p>Doc. Stamp Tax: <span class="footer-4">P30.00</span> </p>
                <p>COR No.</p>
                <br>
                <br>
                <br>
                <p class="and">Not valid without official seal.</p>
            </div>
        </div>
    </div>
</body>
</html>
