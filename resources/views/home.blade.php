<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>
    <div class="max-w-2xl mx-auto">
        @foreach ($blabs as $blab )            
        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <div class="font-semibold">{{ $blab['author'] }}</div>
                <div class="mt-1">{{ $blab['message'] }}</div>
                <div class="text-sm text-gray-500 mt-2">{{ $blab['time'] }}</div>
            </div>
        </div>
        @endforeach
    </div>
</x-layout>
