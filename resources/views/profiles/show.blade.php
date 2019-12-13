@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $profileUser->name }}</h1>

    @foreach ($threads as $thread)
        <div class="card mb-3">
            <div class="card-header">
                <a href="#">{{ $thread->creator->name }}</a> posted: {{ $thread->title }}
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                {{ $thread->body }}
            </div>
        </div>
    @endforeach
    {{ $threads->links() }}
</div>
@endsection
