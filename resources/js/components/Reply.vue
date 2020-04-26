<template>
    <div :id="'reply-' + id" class="mb-2 card" :class="isBest ? 'border-success' : ''">
        <div class="card-body">
            <div class="mb-2 d-flex justify-content-between">
                <h5>
                    <a :href="'/profiles/' + reply.owner.name" v-text="reply.owner.name"></a> said <span v-text="ago"></span>
                </h5>
                <div>
                    <div class="d-inline-block" v-if="authorize('owns', reply)">
                        <button type="submit" class="ml-2 btn btn-sm btn-warning" @click="editing = true">Edit</button>
                        <button type="submit" class="btn btn-sm btn-outline-danger" @click="destroy">Delete</button>
                    </div>
                    <div class="d-inline-block" v-if="signedIn">
                        <button type="submit" class="btn btn-sm btn-outline-primary" @click="markBestReply" v-if="authorize('owns', reply.thread)">Mark as best</button>
                        <favorite :reply="reply"></favorite>
                    </div>
                </div>
            </div>

            <div v-if="editing">
                <form @submit="update">
                    <div class="form-group">
                        <textarea class="mb-1 form-control" v-model="body" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    <button type="button" class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
                </form>
            </div>
            <div v-else v-html="body"></div>
        </div>
    </div>
</template>

<script>
    import Favorite from './Favorite.vue';
    import moment from 'moment';

    export default {
        props: ['reply'],

        components: {
            Favorite
        },

        created() {
            window.events.$on('best-reply-selected', id => {
                this.isBest = (id === this.id)
            });
        },

        data() {
            return {
                editing: false,
                id: this.reply.id,
                body: this.reply.body,
                isBest: this.reply.isBest,
            };
        },

        computed: {
            ago() {
                return moment(this.reply.created_at).fromNow();
            }
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.id, {
                    body: this.body
                })
                .catch(error => {
                    flash(error.response.data, 'danger');
                });

                this.editing = false;

                flash('Your reply has been updated.');
            },
            destroy() {
                axios.delete('/replies/' + this.id);

                this.$emit('deleted', this.id);
            },
            markBestReply() {
                axios.post(`/replies/${this.id}/best`);

                window.events.$emit('best-reply-selected', this.id)
            }
        }
    }
</script>
