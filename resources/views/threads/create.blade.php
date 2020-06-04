@extends('layouts.app')

@section('head')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a New Thread</div>

                    <div class="card-body">
                        <form action="/threads" method="POST" id="new-thread-form">

                            @csrf
                            @method('POST')

                            <div class="form-grou">
                                <label for="selectChannel">Choose a Channel</label>
                                <select name="channel_id" id="selectChannel" class="form-control" required>
                                    <option value="">Choose One...</option>
                                    @foreach ($channels as $channel)
                                        <option value="{{ $channel->id }}"{{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="textTitle">Title:</label>
                                <input type="text" name="title" id="textTitle" class="form-control" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="textareaBody">Body:</label>
                                <wysiwyg name="body"></wysiwyg>
                            </div>

                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LcM-_wUAAAAAFwyBqC1VHHNVBIS-jJw72xXsjJJ"></div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary">Publish</button>
                            </div>

                            @if (count($errors))
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
