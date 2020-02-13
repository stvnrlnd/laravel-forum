@forelse ($threads as $thread)
<div class="card mb-2">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4>
                    @auth
                        @if ($thread->hasUpdatesFor(auth()->user()))
                            <span class="badge badge-danger">New</span>
                        @endif
                    @endauth
                    <a href="{{ $thread->path() }}">
                        {{ $thread->title }}
                    </a>
                </h4>
                <h5>
                    Posted By:
                    <a href="{{ route('profiles', $thread->creator) }}">{{ $thread->creator->name }}</a>
                </h5>
            </div>
            <div>
                <strong>{{ $thread->replies_count }} {{ Str::plural('comment', $thread->replies_count) }}</strong>
            </div>
        </div>
        {{ $thread->body }}
    </div>
</div>

@empty

<p>There are no relevant results at this time.</p>

@endforelse
