@extends('layouts.app')

@section('content')
<thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4>{{ $thread->title }}</h4>
                            @can('update', $thread)
                                <form action="{{ $thread->path() }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete Thread</button>
                                </form>
                            @endcan
                        </div>
                        <p>
                            Posted by <a href="{{ route('profiles', $thread->creator) }}">{{ $thread->creator->name }}</a>
                        </p>
                        <p>
                            {{ $thread->body }}
                        </p>
                    </div>
                </div>

                <replies :data="{{ $thread->replies }}" @removed="repliesCount--"></replies>

                {{-- {{ $replies->links() }} --}}

                @auth
                    <form action="{{ $thread->path() . '/replies' }}" method="POST">

                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <textarea name="body" id="textareaBody" class="form-control" cols="30" rows="10" placeholder="Have something to say?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-secondary">Post</button>
                    </form>
                @else
                    <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
                @endauth
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>This thread was published {{ $thread->created_at->diffForHumans() }}
                        by <a href="#">{{ $thread->creator->name }}</a>,
                        and currently has <span v-text="repliesCount"></span> {{ Str::plural('comment', $thread->replies_count) }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</thread-view>
@endsection
