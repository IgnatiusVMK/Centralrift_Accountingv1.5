<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CashBook Email Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        p {
            margin: 0 0 10px;
        }
    </style>
</head>

<body>
    <p>Dear {{ isset(Auth::user()->name) ? Auth::user()->name : 'Sir/Madam' }},</p><br>
    
{{--  <p>Dear {{ $mailData['user_name'] }},</p><br>
 --}}
    <p>{{ $mailData['message'] }}</p>

    <p>Regards,</p><br>
    <p>IT Support,</p>
    <p>Centralrift FreshPKL.</p>
</body>

</html>
