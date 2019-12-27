@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="row">
        <h1>{{ $profileUser->name }}</h1>
    </div>

    @forelse ($activities as $date => $activity)
    <div class="row">
        <h3>{{ $date }}</h3>
        @foreach ($activity as $record)
            @if (view()->exists("profiles.activities.{$record->type}"))
                @include("profiles.activities.{$record->type}", ['activity' => $record])
            @endif
        @endforeach
    </div>
    @empty
        <p>There is no activity for this user yet.</p>
    @endforelse
</div>
@endsection
