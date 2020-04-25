@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Threads</h1>
    <div class="row">
        <div class="col-md-8">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @include('threads._list')

            {{ $threads->links() }}
        </div>
        <div class="col-md-4">
            @if (count($trending))
                <div class="card">
                    <div class="card-header">Trending Threads</div>
                    <div class="card-body">
                        <ul class="mb-0 list-unstyled">
                            @foreach ($trending as $thread)
                                <li><a href="{{ $thread->path }}">{{ $thread->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
