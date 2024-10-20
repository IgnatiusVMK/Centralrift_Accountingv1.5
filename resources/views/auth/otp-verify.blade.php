<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">                
    <a href="{{ url('/') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
</div>
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('otp.verification') }}">
        @csrf

        <div class="mb-3">
            <label for="otp" class="form-label">Enter OTP</label>
            <input type="text" name="otp" id="otp" class="form-control" placeholder="6-digit OTP" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Verify OTP</button>
    </form>
    </form>
</x-guest-layout>
