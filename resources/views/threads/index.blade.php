@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>Forum Threads</h1>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @forelse ($threads as $thread)
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>
                            <a href="{{ $thread->path() }}">
                                {{ $thread->title }}
                            </a>
                        </h4>
                        <strong>{{ $thread->replies_count }} {{ Str::plural('comment', $thread->replies_count) }}</strong>
                    </div>
                    {{ $thread->body }}
                </div>
            </div>

            @empty

            <p>There are no relevant results at this time.</p>

            @endforelse
        </div>
    </div>
</div>
@endsection
