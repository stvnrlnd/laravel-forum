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

        @foreach ($threads as $thread)
            <div class="card mb-3">
                <div class="card-body">
                    <h4><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h4>

                    {{ $thread->body }}
                </div>
            </div>
        @endforeach
        {{ $threads->links() }}
    </div>
</div>
@endsection
