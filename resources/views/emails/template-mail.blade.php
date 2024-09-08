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
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 150px;
            margin-right: 5px; /* Further reduced margin */
            padding-right: 5px; /* Reduced padding for smaller gap */
            border-right: 2px solid #ddd; /* Horizontal line between logo and text */
        }

        .header h6 {
            font-size: 18px;
            /* color: #4caf50; */ /* Green theme color */
            margin: 0;
            padding-left: 5px; /* Further reduced padding to bring it closer to the line */
            white-space: nowrap;
        }

        .content {
            padding: 20px;
            background-color: #e6f4e7;
            border: 1px solid #000000;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        h2 {
            color: #4caf50; /* Green theme color */
            font-size: 22px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }

        .footer a {
            color: #4caf50; /* Green theme color */
            text-decoration: none;
        }

        .footer .social-icons {
            margin-top: 10px;
        }

        .social-icons img {
            width: 25px;
            margin-right: 10px;
        }

        .info-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        .info-table td:first-child {
            font-weight: bold;
        }

        .button {
            background-color: #4caf50; /* Green theme color */
            color: #fff;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('/images/marley.png') }}" alt="Company Logo">
            <h6>Centralrift Fresh Produce Kenya LTD</h6>
        </div>

        <h2>Monthly Cashbook Report</h2>

        <p>Dear, {{-- {{ Auth::user()->name }} --}}</p>

        <div class="content">
            <p>{{ $mailData['message'] }}</p>

            <table class="info-table">
                <tr>
                    <td>IP Address:</td>
                    <td>{{ request()->ip() }}</td>
                </tr>
                <tr>
                    <td>Location:</td>
                    <td>Nairobi, Nairobi County KE</td>
                </tr>
                <tr>
                    <td>Date | Time:</td>
                    <td>{{ now()->format('jS M, Y | h:i A T') }}</td>
                </tr>
            </table>
        </div>

        <p>If you did not authorise this activity, change your password immediately and contact <a href="mailto:support@centralrift-fpkl.com">support@centralrift-fpkl.com</a>.</p>

        <div class="footer">
            <p>Why this email? We are committed to preserving your security and updating you on account activity.</p>

            <div class="social-icons">
                <img src="https://image.shutterstock.com/image-vector/facebook-icon-260nw-1243472888.jpg" alt="Facebook">
                <img src="https://image.shutterstock.com/image-vector/twitter-icon-260nw-1243472890.jpg" alt="Twitter">
                <img src="https://image.shutterstock.com/image-vector/instagram-icon-260nw-1243472891.jpg" alt="Instagram">
            </div>

            <p>Centralrift Fresh Produce Kenya LTD <br> Nairobi, Kenya</p>
            <p>Contact us at: <a href="mailto:support@centralrift-fpkl.com">support@centralrift-fpkl.com</a></p>
        </div>
    </div>
</body>

</html>

{{-- <!DOCTYPE html>
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
    <h2>Centralrift Fresh Produce Kenya LTD</h2>
    <hr>
    <p>Dear, {{ isset(Auth::user()->name) ? Auth::user()->name : 'Sir/Madam' }}</p><br>
    
    <p>{{ $mailData['message'] }}</p>

    <p>Regards,</p><br>
    <p>IT Support,</p>
    <p>Centralrift FreshPKL.</p>

    <footer>
        Contact us at: support@centralrift-fpkl.com
    </footer>
</body>

</html>
 --}}