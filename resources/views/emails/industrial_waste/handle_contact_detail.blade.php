
{{--@php--}}
{{--echo '<pre>';--}}
{{--print_r($data); die;--}}
{{--@endphp--}}

<html>
<head>
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/pdf/handle_contact_detail.css') }}">
</head>
<body>
<div class="header">
    <ul class="info_left">
        <li>Base name: {{ $data->logistic_location_name or '    ' }}  Main charge name: {{ $data->logistic_main_charge_name or '' }}</li>
        <li>TEL:         ADDRESS:   </li>
    </ul>

    <ul class="info_right">
        <li>{{ date('d/m/Y') }}</li>
        <li>Environment Tecsis, limited company</li>
        <li>Aichi Prefecture Toyokawa City Shiratori cho Yamanami 5 1</li>
        <li>TEL 0533-87-5512 FAX　0533-95-5570</li>
        <li>Person in charge: Miyuki Takahashi</li>
    </ul>
</div>

<div class="clearfix"></div>

<div class="content">
    <div class="head-content">
        <h4 class="head-title">Information on taking over details</h4>
        <p class="description">Dear Sirs, We would like to extend my sincere gratitude to you for your kindness and properity. <br/>
            Thank you very much for your continued patronage. <br/>
            The matter of taking over, we are planning the following contents.
            As you can confirm, thank you.</p>
        <p class="foot-content">Best regards</p>
    </div>
    <table class="main-content">
        <tr>
            <td>Industrial waste type</td>
            <td>:</td>
            <td>{{ $data->type or '' }}</td>
        </tr>
        <tr>
            <td>Manifest No</td>
            <td>:</td>
            <td>{{ $data->manifest_no or '' }}</td>
        </tr>
        <tr>
            <td>Acquisition quantity</td>
            <td>:</td>
            <td>{{ !empty($data->quantity) ? $data->quantity . $data->unit : '' }}</td>
        </tr>
        <tr>
            <td>Shipping company</td>
            <td>:</td>
            <td>{{ $data->logistic_customer_name or '' }}</td>
        </tr>
        <tr>
            <td>Transportation method</td>
            <td>:</td>
            <td>{{ $data->method_disposal or '' }}</td>
        </tr>
        <tr>
            <td>Recovery date</td>
            <td>:</td>
            <td>{{ $data->take_off_at or '' }}</td>
        </tr>
        <tr>
            <td>Take-off time</td>
            <td>:</td>
            <td>{{ $data->take_off_time or '' }}</td>
        </tr>
        <tr>
            <td>Car number</td>
            <td>:</td>
            <td>{{ $data->car_number or '' }}</td>
        </tr>
        <tr>
            <td>Driver name</td>
            <td>:</td>
            <td>{{ $data->driver_name or '' }}</td>
        </tr>
        <tr>
            <td>Remarks</td>
            <td>:</td>
            <td>{{ $data->remarks or '' }}</td>
        </tr>
    </table>
</div>
</body>

</html>