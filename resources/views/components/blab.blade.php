
@props(['blab'])

<div class="card bg-base-100">
    <div class="card-body">
        <div class="flex space-x-3">
            @if($blab->user)
                <div class="avatar">
                    <div class="size-10 rounded-full">
                        <img src="https://avatars.laravel.cloud/{{ urlencode($blab->user->email) }}?vibe=ocean"
                             alt="{{ $blab->user->name }}'s avatar"
                             class="rounded-full" />
                    </div>
                </div>
            @else
                <div class="avatar placeholder">
                    <div class="size-10 rounded-full">
                        <img src="https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth"
                        alt="Anonymous User"
                        class="rounded-full" />
                    </div>
                </div>
            @endif

            <div class="min-w-0 flex-1">
                <div class="flex justify-between w-full">
                <div class="flex items-center gap-1">
                    <span class="text-sm font-semibold">{{ $blab->user ? $blab->user->name : 'Anonymous' }}</span>
                    <span class="text-base-content/60">·</span>
                    <span class="text-sm text-base-content/60">{{ $blab->created_at->diffForHumans() }}</span>
                    @if ($blab->updated_at->gt($blab->created_at->addSeconds(1)))
                        <span class="text-base-content/60">·</span>
                        <span class="text-sm text-base-content/60 italic">edited</span>
                    @endif
                </div>

                @can('update', $blab)
                <div class="flex gap-1">
                        <a href="/blabs/{{ $blab->id }}/edit" class="btn btn-ghost btn-xs"> Edit </a>
                        <form method="POST" action="/blabs/{{ $blab->id }}"> @csrf @method('DELETE') <button
                        type="submit" onclick="return confirm('Are you sure you want to delete this blab?')"
                        class="btn btn-ghost btn-xs text-error"> Delete </button>
                        </form>
                    </div>
                    @endcan
                </div>

                <p class="mt-1 break-words">
                    {{ $blab->message }}
                </p>
            </div>
        </div>
    </div>
</div>