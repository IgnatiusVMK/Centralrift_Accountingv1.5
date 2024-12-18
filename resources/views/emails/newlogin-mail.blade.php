<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Login Notifications</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f5f5f5; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 30px auto; background-color: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        
        <!-- Header Section -->
        <table style="width: 100%; margin-bottom: 20px; border-collapse: collapse;">
            <tr>
                <td style="width: 60px; padding-right: 10px; border-right: 2px solid #ddd; text-align: center;">
                    <img src="{{ asset('https://www.centralriftfpkl.com/images/www-icon.png') }}" alt="Company Logo" style="width: 50px;">
                </td>
                <td style="padding-left: 10px; vertical-align: middle;">
                    <h6 style="font-size: 18px; margin: 0;">Centralrift Fresh Produce Kenya LTD</h6>
                </td>
            </tr>
        </table>

        <!-- Title -->
        <h2 style="color: #4caf50; font-size: 22px; margin-bottom: 20px;">Login Notification</h2>

        <!-- Greeting -->
        <p style="font-size: 16px;">Dear {{ $mailData['user_name'] }},</p>

        <!-- Content Section -->
        <div style="padding: 20px; background-color: #e6f4e7; border: 1px solid #000000; border-radius: 8px; margin-bottom: 20px;">
            <p style="font-size: 16px;">{{ $mailData['message'] }}</p>
            <table style="width: 100%; margin-top: 20px; border-collapse: collapse; text-align: left;">
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd; font-size: 14px; font-weight: bold;">IP Address:</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd; font-size: 14px;">{{ request()->ip() }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd; font-size: 14px; font-weight: bold;">Location:</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd; font-size: 14px;">Nairobi, Nairobi County KE</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd; font-size: 14px; font-weight: bold;">Date | Time:</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd; font-size: 14px;">{{ $mailData['login_time'] }} EAT</td>
                </tr>
            </table>
        </div>

        <!-- Instructions -->
        <p style="font-size: 16px;">If you don’t recognize this login, we recommend you take the following steps:</p>
        <p style="font-size: 14px;"><b>1. Change your password:</b> Choose a strong password you haven’t used before.</p>
        <p style="font-size: 14px;">Immediately contact <a href="mailto:itsupport@centralriftfpkl.com" style="color: #4caf50; text-decoration: none;">itsupport@centralriftfpkl.com</a>.</p>

        <!-- Footer Section -->
        <div style="text-align: center; margin-top: 30px; font-size: 14px; color: #777;">
            <p style="font-size: 14px;">Why this email? We are committed to preserving your security and updating you on account activity.</p>

            <!-- Single Centered Icon -->
            <div style="margin-bottom: 20px;">
                <img src="{{ asset('https://www.centralriftfpkl.com/images/www-icon.png') }}" alt="Website" style="width: 30px;">
                <p style="font-size: 12px; margin-top: 5px;">www.centralriftfpkl.com</p>
            </div>

            <!-- Social Icons -->
            <table style="width: 100%; margin-top: 10px; text-align: center; border-collapse: collapse;">
                <tr>
                    <td style="padding: 5px;">
                        <img src="{{ asset('https://www.centralriftfpkl.com/images/fb-icon.png') }}" alt="Facebook" style="width: 25px;">
                        <div style="font-size: 12px; margin-top: 5px;">@Centralrift FPKL</div>
                    </td>
                    <td style="padding: 5px;">
                        <img src="{{ asset('https://www.centralriftfpkl.com/images/twitter-icon.png') }}" alt="Twitter" style="width: 25px;">
                        <div style="font-size: 12px; margin-top: 5px;">@CentralriftFPKL</div>
                    </td>
                    <td style="padding: 5px;">
                        <img src="{{ asset('https://www.centralriftfpkl.com/images/insta-icon.png') }}" alt="Instagram" style="width: 25px;">
                        <div style="font-size: 12px; margin-top: 5px;">@centralrift.fpkl</div>
                    </td>
                </tr>
            </table>

            <!-- Contact Info -->
            <p style="margin-top: 10px;">Centralrift Fresh Produce Kenya LTD<br>Nairobi, Kenya</p>
            <p>Contact us at: <a href="mailto:itsupport@centralriftfpkl.com" style="color: #4caf50; text-decoration: none;">itsupport@centralriftfpkl.com</a></p>
        </div>

    </div>
</body>

</html>
