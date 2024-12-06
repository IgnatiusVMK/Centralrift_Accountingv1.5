@extends('layouts.app')

@section('content')

<!-- Heading for Notifications -->
<h3 class="mb-6 font-semibold text-gray-700">All Notifications</h3>

@foreach ($notifications as $notification)
    <div class="border p-4 mb-4 rounded-md bg-gray-100">
        <p class="font-semibold text-lg">{{ $notification->data['item_name'] }}</p>
        <p class="text-gray-600">{{ $notification->data['message'] }}</p>
        <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
        
        <!-- Mark as Read Button -->
        @if (!$notification->read_at)
            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="mt-2">
                @csrf
                @method('POST')
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">
                    Mark as Read
                </button>
            </form>
        @else
            <span class="text-green-500 text-sm">Read</span>
        @endif
    </div>
@endforeach

<!-- Pagination Links -->
{{ $notifications->links() }}

@endsection
