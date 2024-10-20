#
# OTP Authentication and Verification

* Modify existing authentication process with Laravel Breeze to include OTP verification before a user is fully logged in, and to log the OTP locally.

### Step 1: Modify Laravel Breeze Authentication Flow.

* Laravel Breeze handles the authentication automatically after the credentials are validated, adjust it so that users are not automatically logged in after entering their email and password. Instead, they will be redirected to the OTP verification step.

#### 1. Override the default login behavior.

* I achieve this by modifying the LoginController or the authentication logic in Auth::attempt(). You want to authenticate the credentials, but delay the login until after OTP verification.

* In your LoginController (or in the FortifyServiceProvider if you are using Fortify):

* Update the login logic:

```php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // For logging OTP locally
use App\Mail\OtpMail; // If you still want to email OTPs

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Save OTP to the session for verification (or you could use the DB)
        session(['otp' => $otp, 'email' => $request->email]);

        // If you want to log the OTP instead of sending it via email:
        Log::info('OTP for ' . $request->email . ': ' . $otp);

        // (Optional) Email OTP if network is available
        // Mail::to($request->user())->queue(new OtpMail($otp));

        // Log the user out so they aren't authenticated until the OTP is verified
        Auth::logout();

        // Redirect to OTP verification page
        return redirect()->route('otp.verify');
    }

    return back()->withErrors(['email' => 'Invalid credentials.']);
}
```

### Step 2: Modify Routes and Create OTP Verification Flow

#### 1. Add Routes in auth.php: You already have the auth.php routes from Laravel Breeze. Add routes for the OTP verification process:

```php
Route::get('otp-verify', [OtpVerificationController::class, 'index'])->name('otp-authform');

Route::post('otp-verify', [OtpVerificationController::class, 'verify'])->name('otp.verification');
```

#### 2. OTP Verification Form: Create a view to let users input the OTP:

```html
resources/views/auth/otp-verify.blade.php:

<form method="POST" action="{{ route('otp.submit') }}">
    @csrf
    <div>
        <label for="otp">Enter OTP:</label>
        <input type="text" name="otp" id="otp" required>
    </div>

    @error('otp')
        <span>{{ $message }}</span>
    @enderror
    
    <button type="submit">Verify OTP</button>
</form>
```

#### 3. OTP Controller Logic: Create or update the OtpController to handle OTP verification:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function index()
    {
        return view('auth.otp-verify');
    }

    public function verify(Request $request)
    {

        $request->validate([
            'otp'=>'required|numeric',
        ]);

        // Here, retrieve the OTP sent to the user, e.g., stored in session or the database.
        $sentOtp = Session::get('otp');

        // Get the user's actual IP address
        $userIp = $request->ip(); // This will take into account the trusted proxy headers


        if ($sentOtp && $request->input('otp') == $sentOtp) {
            // If OTP matches, mark the OTP as verified in the session
            Session::put('otp_verified', true);

            $user = Auth::user();
            $mail_to = Auth::user()->email;
            $now = Carbon::now('Africa/Nairobi');
            $currentTime = $now->format('Y-m-d h:i:s');

            $dispatchData = [
                'mail_to' => $mail_to,
                'subject' => 'New Login Notification',
                'message' => 'We noticed a new login to your account. Here are the details:',
                'login_time' => $currentTime,
                'mailable' => 'LoginNotificationMail',
                'user_name' => Auth::user()->name,
            ];

            // Dispatch the job
            dispatch(new SendMail($dispatchData, $user));

            /// Redirect to the intended page, typically the dashboard or any other protected route
            return redirect()->route('dashboard');

        }
        // If OTP doesn't match, redirect back with an error message
        return redirect()->route('otp-authform')->with('error', 'The provided OTP is incorrect.');
    }
}
```

### Step 3: Handling Offline Mode (Log OTP Locally)

* If you are testing your app without an internet connection and want to save the OTP to logs instead of sending it via email:

#### 1. Log the OTP: You can use Laravel's Log::info() to store the OTP in your local log files.

* In the login method:

```php
// Log the OTP instead of emailing it
Log::info('OTP for ' . $request->email . ': ' . $otp);
```

* This way, even if you're not connected to the network, you can see the OTP in the log files and use it to complete the login process during development.

### Step 4: Security Considerations

* ***Session Timeout for OTP:*** You might want to expire the OTP after a short duration to improve security. This can be done by storing the OTP with a timestamp and checking if the OTP has expired during the verification process.

* ***Rate Limiting:*** Limit the number of times a user can request an OTP to prevent abuse.

* ***Retry Limit:*** Consider limiting the number of OTP verification attempts.


##
# Implementing Middleware to Protect Routes

### 1. Ensure the OTP Verification Step is Required
* Make sure that after sending the OTP, the system doesn't proceed with the login until the user has entered the correct OTP. Here's how to enforce this:

#### a. Add a Middleware to Ensure OTP is Verified
* You can create a middleware to check if the user has verified the OTP before proceeding with the login. This middleware will redirect users to the OTP form if they haven't verified the OTP yet.

#### Create Middleware: Run the command to create the middleware:

```php
php artisan make:middleware EnsureOtpIsVerified
```
***Update Middleware Logic:*** In the generated middleware located in app/Http/Middleware/
EnsureOtpIsVerified.php, modify the handle method to check if the user has verified the OTP.

* Example middleware:

```php
<?php
public function handle($request, Closure $next)
{
    // Check if the OTP has been verified (could use session or database flag)
    if (!Session::has('otp_verified')) {
        // Avoid redirecting to OTP page if the user is already on that page
        if ($request->route()->getName() !== 'otp-authform') {
            return redirect()->route('otp-authform');
        }
    }

    return $next($request);
}
```

* This middleware checks if a session variable otp_verified is set. If not, it redirects the user to the OTP form.

***Register the Middleware:*** In app/Http/Kernel.php, register your middleware in the web middleware group or create a new middleware group for OTP verification.

* Example:

```php
protected $routeMiddleware = [
    // Other middlewares...
    'otp.verified' => \App\Http\Middleware\EnsureOtpIsVerified::class,
];
```

***Apply the Middleware to Protected Routes:*** In your routes/web.php or routes/auth.php, apply the middleware to routes that should only be accessible after OTP verification:

```php
Route::middleware(['otp.verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
```

#### b. Update OTP Verification Logic
* Ensure that after the user submits the OTP form, you set the session or database flag to indicate that the OTP has been verified.

* In your OtpVerificationController, after verifying the OTP:

```php
public function verify(Request $request)
{
    // Assuming you verify the OTP here...
    if ($this->otpIsValid($request->input('otp'))) {
        // Mark the OTP as verified (you can also store this in the database)
        Session::put('otp_verified', true);

        // Proceed to the next step
        return redirect()->route('dashboard');
    } else {
        return redirect()->back()->withErrors(['otp' => 'Invalid OTP']);
    }
}
```

#### Breakdown of the Middleware: ####
* Check OTP Verification: The middleware checks if an OTP has been verified by looking for a session variable (otp_verified).

#### Redirect Logic:

* If the OTP hasn't been verified, it checks if the current route is not the OTP authentication form (otp-authform).
* If the user is not already on the OTP authentication form, it redirects them to that route.

#
# Disabling OTP for SuperUsers/Administrators and selected Users
* You can add a flag to the users’ table to allow specific users to bypass OTP verification.

### a) Add otp_enabled Column to Users Table
* Create a migration to add a boolean otp_enabled field to the users table:

```bash
php artisan make:migration add_otp_enabled_to_users_table --table=users
```
* In the migration file:

```php
Schema::table('users', function (Blueprint $table) {
    $table->boolean('otp_enabled')->default(true);
});
```

### b) Check is a User(s) has OTP Disabled
* When OTP is disabled for a user, they will not be prompted to enter an OTP code during login.

* In your login logic, you can check if the user has OTP enabled or disabled:

```php
public function store(LoginRequest $request)
{
    // Authenticate user email and password
    $request->authenticate();

    $user = Auth::user();

    // Check if OTP is enabled for this user
    if ($user->otp_enabled) {
        // Generate OTP and redirect to OTP verification page
        $otp = rand(100000, 999999);
        session(['otp' => $otp]);

        // Log OTP for testing purposes
        Log::info('Generated OTP for user ' . $user->email . ': ' . $otp);

        // Send OTP via email
        $mail_to = $user->email;
        $dispatchData = [
            'mail_to' => $mail_to,
            'subject' => "Your OTP Code",
            'message' => "Your OTP code is: " . $otp,
            'mailable' => "LoginOtpMail",
        ];
        dispatch(new SendMail($dispatchData));

        // Redirect to OTP verification
        return redirect()->route('otp.verify');
    }

    // If OTP is disabled, log the user in directly
    $request->session()->regenerate();
    return redirect()->intended(RouteServiceProvider::HOME);
}
```

### To modify the middleware so that users with otp_enabled set to 0 (or false) can bypass the OTP verification step, you’ll need to perform a check against the user's status in the database. Here's how to adjust your middleware accordingly:

1. Fetch the User: Retrieve the currently authenticated user to check their otp_enabled status.

2. Modify the Logic: If ```otp_enabled``` is 0, allow the request to proceed without requiring OTP verification.

```php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VerifyOtp
{
    public function handle($request, Closure $next)
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Check if the user exists and if OTP verification is required
        if ($user && $user->otp_enabled === 0) {
            // Allow the user to proceed without OTP verification
            return $next($request);
        }

        // Check if the OTP has been verified
        if (!Session::has('otp_verified')) {
            // Avoid redirecting to OTP page if the user is already on that page
            if ($request->route()->getName() !== 'otp-authform') {
                // Optionally, you could flash a message to inform the user
                Session::flash('message', 'Please verify your OTP to continue.');

                return redirect()->route('otp-authform');
            }
        }

        return $next($request);
    }
}

```

### Explanation of Changes
***1. User Retrieval:***

* The middleware fetches the currently authenticated user using ```Auth::user()```. Make sure your application uses Laravel's authentication system for this to work.

***2. Check otp_enabled:***

* Before checking the session for OTP verification, it checks if the user has ```otp_enabled``` set to 0. If true, the middleware immediately allows the request to proceed.

***3. Session Check:***

* If the user requires OTP verification (i.e., if ```otp_enabled``` is 1 or not set), it will check the session for the otp_verified flag.

### Conclusion:
* Disable OTP for Certain Users: You can add a flag (otp_enabled) in the database to allow specific users to skip OTP verification.
