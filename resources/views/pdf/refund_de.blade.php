<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rückerstattung</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>

        body {
            font-size: 14px;
            width: 100%;
        }

        p {
            padding: 0px;
            margin: 0px;
        }

        .slim-font {
            font-size: 12px;
        }

        .first-table {
            padding-top: 50px;
        }
        .second-table {
            padding-top: 50px;            
        }
        .second-table td{
            border-top:1px solid #ddd;
            border-bottom: 1px solid #ddd;
            height: 30px;
        }
        .third-table {
            padding-top: 70px;            
        }
        
        .third-table td {
            border-top:1px solid #ddd;           
            height: 25px;    
        }
        .bold-bottom {
            border-bottom: 1px solid black;
        }

        .bottom-table {            
            border-top:1px solid #ddd;  
            position: absolute;
            bottom:0px;     
            font-size: 12px; 
        }

    </style>
</head>

<body>
    <table class="w-100" cellpadding="0" cellspacing="0" >
        <tr>
            <td style="width:80px">
                <img height="60" width="60" src="{{ public_path('img/logo-500px.png') }}" />
            </td>
            <td class="text-left align-top">
                <p>{{ $booking->gw_company_name }}</p>
                <p>{{ $booking->gw_street }}</p>
                <p>{{ $booking->gw_postal_code }} {{ $booking->gw_city }}</p>
            </td>
            <td></td>
            <td></td>
            <td colspan="2" class="text-right align-top slim-font text-muted">
                <p>Telefon: {{ config('greenwiperz.company.telefon') }}</p>
                <p>email: {{ config('greenwiperz.company.email') }}</p>
                <p>Web: {{ config('greenwiperz.company.web') }}</p>
                <p>Keine MwSt-Pflicht</p>
            </td>
        </tr>
    
        <tr >
            <td class="first-table font-weight-bold align-top"  colspan="2"> Rückerstattungsempfänger</td>
            <td ></td>
            <td ></td>
            <td class="first-table font-weight-bold">Rückerstattung-Nr. </td>
            <td class="text-right align-top first-table font-weight-bold">{{ $booking->refund->refund_nr }}</td>
        </tr>
        <tr >
            <td class="align-top"  colspan="2"> 
                <p> Frau\Herr </p>
                <p>{{ $booking->billingAddress->first_name }} {{ $booking->billingAddress->last_name }}</p>
                <p>{{ $booking->billingAddress->company_name }}</p>
                <p>{{ $booking->billingAddress->street }}</p>
                <p>{{ $booking->billingAddress->postal_code }} {{ $booking->billingAddress->city }}</p>
                <p>{{ $booking->billingAddress->country }}</p>
            </td>
            <td class=""></td>
            <td class=""></td>
            <td class="align-top">
                <p>Rückerstattungsdatum</p>                         
            </td>
            <td class="text-right align-top"> 
                <p>{{ $booking->refund->created_at }}</p>               
            </td>
        </tr>
    </table>
    <table class="w-100 second-table">
        <tr>
            <td>Buchungsnummer</td>
            <td class="text-right">{{ $booking->booking_nr }}</td>
        </tr>
        <tr>
            <td>Leistung</td>
            @if($booking->service_type == 'outside')
            <td class="text-right">Aussen Autoinnenreinigung</td>
            @else
            <td class="text-right">Inner und aussen Autoinnenreinigung</td>
            @endif
            
        </tr>
        <tr>
            <td>Auto</td>
            <td class="text-right">{{ $booking->car->car_model }}, {{ $booking->car->number_plate }}, {{ $booking->car->car_color }}</td>
        </tr>
        <tr>
            <td>Leistungsort </td>
            <td class="text-right">{{ $booking->loc_route }} {{ $booking->loc_street_number }}, {{ $booking->loc_postal_code }} {{ $booking->loc_city }}</td>
        </tr>
        <tr>
            <td >Leistungszeitraum</td>
            <td class="text-right">{{ $booking->booking_datetime }}</td>
        </tr>
    </table>

    <table class="w-100 third-table">
        <tr>
            <th></th>
            <th class="text-right" >Betrag in CHF</th>
        </tr>
        <tr>
            <td>Leistung betrag</td>
            <td class="text-right">{{ $booking->formatedBaseCost }} </td>
        </tr>
        <tr>
            <td class="font-weight-bold bold-bottom">Total  (keine MwSt-Pflicht)</td>
            <td class="text-right font-weight-bold bold-bottom">{{ $booking->formatedTotalCost }}</td>
        </tr>   
        <tr>
            <td class="font-weight-bold bold-bottom">Rückerstattungsbetrag </td>
            <td class="text-right font-weight-bold bold-bottom">{{ $booking->refund->formatedRefundedAmount }}</td>
        </tr>  
    </table>
    <table class="w-100 pt-5">
        <tr>
            <td>Vielen Dank, dass Sie sich für die umweltfreundliche Reinigung Ihres Autos entschieden haben.</td>          
        </tr>    
        <tr>
            <td>Ihre Greenwiperz Team</td>          
        </tr> 

        
    </table>

    <table class="bottom-table w-100 text-muted">
        <tr>    
            <td>Haben Sie Fragen? Kontaktieren Sie {{ config('greenwiperz.company.telefon') }} oder {{ config('greenwiperz.company.email') }}</td>
        </tr>
    </table>
</body>
</html>
