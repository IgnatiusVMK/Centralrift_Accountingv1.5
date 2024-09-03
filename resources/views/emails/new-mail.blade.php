<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Mail</title>
</head>

<body>
    <p>Dear {{ isset(Auth::user()->name) ? Auth::user()->name : 'Sir/Madam' }},</p><br>
    {{-- <p>Dear {{ $mailData['user_name'] }},</p><br> --}}


    <p>{{$mailData['message']}}</p>

    <p>Regards,</p><br>
    <p>IT Support,</p>
    <p>Centralrift FreshPKL.</p>
</body>

</html>