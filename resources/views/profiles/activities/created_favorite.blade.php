@component('profiles.activities.activity')
    @slot('heading')
        <h4>
            {{ $profileUser->name }} favorited a <a href="{{ $activity->subject->favorited->path() }}">reply.</a>
        </h4>
    @endslot
    @slot('body')
        <p>{{ $activity->subject->favorited->body }}</p>
    @endslot
@endcomponent
