<div class="w-1/4 bg-gray-800 text-white p-4">
    <h2 class="text-xl font-bold mb-4">Available Users</h2>
    <ul class="space-y-2">
        @foreach ($users as $user)
            <li>
                <a href="{{ route('conversation', $user->id) }}" class="text-blue-500 hover:underline">{{ $user->name }}</a>
            </li>
        @endforeach
    </ul>
</div>
