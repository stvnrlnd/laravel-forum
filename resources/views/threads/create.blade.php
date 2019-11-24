@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Thread</div>

                <div class="card-body">
                    <form action="/threads" method="POST">

                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="textTitle">Title:</label>
                            <input type="text" name="title" id="textTitle" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="textareaBody">Body:</label>
                            <textarea name="body" id="textareaBody" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-secondary">Publish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
