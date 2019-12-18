<div class="card mb-2">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5>
                <a href="{{ route('profiles', $reply->owner) }}">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}
            </h5>
            <form action="/replies/{{ $reply->id }}/favorites" method="POST">
                @csrf
                @method('POST')

                <button type="submit" class="btn btn-sm btn-light"{{ $reply->isFavorited() ? 'disabled' : '' }}>
                    {{ $reply->favorites_count }} {{ Str::plural('favorite', $reply->favorites_count) }}
                </button>
            </form>
        </div>
        {{ $reply->body }}
    </div>
</div>
