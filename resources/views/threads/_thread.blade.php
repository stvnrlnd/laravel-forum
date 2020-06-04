<div class="mb-3 card" v-if="editing">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <input type="text" name="" id="" class="form-control" v-model="form.title">
            <form action="{{ $thread->path() }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
        </div>

        <wysiwyg v-model="form.body"></wysiwyg>
    </div>
    <div class="card-footer text-muted">
        <button class="btn btn-sm btn-warning" @click="reset">Cancel</button>
        <button class="btn btn-sm btn-primary" @click="update">Update</button>
    </div>
</div>

<div class="mb-3 card" v-else>
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 v-text="title"></h4>
        </div>
        <p>
            Posted by <a href="{{ route('profiles', $thread->creator) }}">{{ $thread->creator->name }}</a>
        </p>
        <div v-html="body"></div>
    </div>
    @can('update', $thread)
        <div class="card-footer text-muted">
            <button class="btn btn-sm btn-warning" @click="editing = true">Edit</button>
        </div>
    @endcan
</div>
