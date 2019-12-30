<template>
    <div :id="'reply-' + id" class="card mb-2">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5>
                    <a :href="'/profiles/' + data.owner.name" v-text="data.owner.name"></a> said {{ data.created_at }}
                </h5>
                <div>
                    <div class="d-inline-block" v-if="canUpdate">
                        <button type="submit" class="btn btn-sm btn-warning ml-2" @click="editing = true">Edit</button>
                        <button type="submit" class="btn btn-sm btn-outline-danger" @click="destroy">Delete</button>
                    </div>
                    <div class="d-inline-block" v-if="signedIn">
                        <favorite :reply="data"></favorite>
                    </div>
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
</template>

<script>
    import Favorite from './Favorite.vue';

    export default {
        props: ['data'],

        components: {
            Favorite
        },

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body
            };
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            },
            canUpdate() {
                return this.authorize(user => this.data.user_id == user.id);
            }
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                });

                this.editing = false;

                flash('Your reply has been updated.');
            },
            destroy() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id);
            }
        }
    }
</script>
