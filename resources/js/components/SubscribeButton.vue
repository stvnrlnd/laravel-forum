<template>
    <button :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
    export default {
        props: ['active'],

        computed: {
            classes() {
                return [
                    'btn',
                    'btn-block',
                    this.active ? 'btn-primary' : 'btn-light'
                ];
            }
        },

        methods: {
            subscribe() {
                axios[this.active ? 'delete' : 'post'](location.pathname + '/subscriptions');

                this.active = ! this.active;

                flash('Subscribed');
            }
        }
    }
</script>
