<template>
    <button type="submit" class="btn btn-sm btn-light" @click="toggle">
        <font-awesome-icon :class="classes" :icon="icon"></font-awesome-icon>
        <span v-text="count"></span>
    </button>
</template>

<script>
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

    export default {
        props: ['reply'],

        components: {
            FontAwesomeIcon
        },

        data() {
            return {
                count: this.reply.favoritesCount,
                active: this.reply.isFavorited
            }
        },

        computed: {
            classes() {
                return [
                    this.active ? 'text-danger' : ''
                ]
            },

            icon() {
                return [
                    this.active ? 'fas' : 'far',
                    'heart'
                ];
            },

            endpoint() {
                return '/replies/' + this.reply.id + '/favorites';
            }
        },

        methods: {
            toggle() {
                return this.active ? this.destroy() : this.create();
            },

            create() {
                axios.post(this.endpoint);

                this.active = true;
                this.count++;
            },

            destroy() {
                    axios.delete(this.endpoint);

                    this.active = false;
                    this.count--;
            }
        }
    }
</script>
