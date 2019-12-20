@component('profiles.activities.activity')
    @slot('heading')
        <h4>{{ $profileUser->name }} replied to a <a href="{{ $activity->subject->thread->path() }}">{{ $activity->subject->thread->title }}</a>.</h4>
    @endslot
    @slot('body')
        <p>{{ $activity->subject->body }}</p>
    @endslot
@endcomponent
