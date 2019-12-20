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

        @foreach ($activities as $date => $activity)
            <h3>{{ $date }}</h3>
            @foreach ($activity as $record)
                @include("profiles.activities.{$record->type}", ['activity' => $record])
            @endforeach
        @endforeach
    </div>
</div>
@endsection
