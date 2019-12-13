<div class="card mb-2">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5>
                <a href="{{ route('profiles', $reply->owner) }}">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}
            </h5>
            <div>
                <form action="/replies/{{ $reply->id }}/favorites" method="POST">
                    @csrf
                    @method('POST')

                    <button type="submit" class="btn btn-light"{{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ Str::plural('favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>
