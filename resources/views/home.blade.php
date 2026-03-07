<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>
    <div class="max-w-2xl mx-auto">
        @forelse ($blabs as $blab)
            <div class="card bg-base-100 shadow mt-8">
                <div class="card-body">
                    <div>
                        <div class="font-semibold"> {{ $blab->user ? $blab->user->name : 'Anonymous' }}</div>
                        <div class="mt-1">{{ $blab->message }}</div>
                        <div class="text-sm text-gray-500 mt-2">
                            {{ $blab->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No blabs yet. Be the first to blab!</p>
        @endforelse
    </div>
</x-layout>
