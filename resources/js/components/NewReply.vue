<template>
    <div>
        <div v-if="signedIn">
            <div class="form-group">
                <textarea name="body"
                            id="textareaBody"
                            class="form-control"
                            cols="30"
                            rows="5"
                            placeholder="Have something to say?"
                            v-model="body"></textarea>
            </div>
            <button type="submit"
                    class="btn btn-secondary"
                    @click="addReply"
                    required>Post</button>
        </div>

        <p class="text-center" v-else>Please <a href="/login">sign in</a> to participate in this discussion.</p>
    </div>
</template>

<script>
    import Tribute from "tributejs";

    export default {
        data() {
            return {
                body: ''
            };
        },

        mounted() {
            var tribute = new Tribute({
                    collection: [{
                        trigger: '@',
                        values: function (query, callback) {
                            axios.get('/api/users', {name: query})
                                .then(({data}) => {
                                    callback(data);
                                });
                        },
                        lookup: 'name',
                        fillAttr: 'name'
                    }]
                });

            tribute.attach(document.getElementById("textareaBody"));
        },

        methods: {
            addReply() {
                axios.post(`${location.pathname}/replies`, { body: this.body })
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    })
                    .then(({data}) => {
                        this.body = '';

                        flash('Your reply has been posted.');

                        this.$emit('created', data);
                    });
            }
        }
    }
</script>
