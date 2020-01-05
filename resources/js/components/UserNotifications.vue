<template>
    <li class="nav-item dropdown" v-if="notifications.length">
        <a id="navbarDropdown"
            class="nav-link dropdown-toggle"
            href="#"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <font-awesome-icon :icon="['far', 'bell']"></font-awesome-icon>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item"
                :href="notification.data.link"
                v-for="notification in notifications"
                :key="notification.id"
                @click="markAsRead(notification)">
                {{ notification.data.message }}
            </a>
        </div>
    </li>
</template>

<script>
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

    export default {
        components: {
            FontAwesomeIcon
        },

        data() {
            return {
                notifications: false
            };
        },

        created() {
            axios.get(`/profiles/${window.App.user.name}/notifications`)
                .then(response => this.notifications = response.data);
        },

        methods: {
            markAsRead(notification) {
                axios.delete(`/profiles/${window.App.user.name}/notifications/${notification.id}`);
            }
        }
    }
</script>
