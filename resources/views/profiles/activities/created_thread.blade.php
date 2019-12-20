@component('profiles.activities.activity')
    @slot('heading')
        <h4>{{ $profileUser->name }} published <a href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a>.</h4>
    @endslot
    @slot('body')
        <p>{{ $activity->subject->body }}</p>
    @endslot
@endcomponent
