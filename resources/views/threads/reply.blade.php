<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="card mb-2">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5>
                    <a href="{{ route('profiles', $reply->owner) }}">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}
                </h5>
                <div>
                    @can('update', $reply)
                        <button type="submit" class="btn btn-sm btn-warning ml-2" @click="editing = true">Edit</button>
                        <button type="submit" class="btn btn-sm btn-outline-danger" @click="destroy">Delete</button>
                    @endcan
                    @auth
                        <favorite :reply="{{ $reply }}"></favorite>
                    @endauth
                </div>
            </div>

            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control mb-1" v-model="body"></textarea>
                    <button type="submit" class="btn btn-sm btn-primary" @click="update">Update</button>
                    <button type="submit" class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
                </div>
            </div>
            <div v-else v-text="body"></div>
        </div>
    </div>
</reply>
