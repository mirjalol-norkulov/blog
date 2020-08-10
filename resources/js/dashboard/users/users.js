import Vue from 'vue'
import axios from 'axios'
import vueDebounce from 'vue-debounce'

axios.defaults.headers['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

Vue.use(vueDebounce)

new Vue({
    el: '#users-app',
    data: {
        users: window.users,
        searchText: ''
    },
    methods: {
        getIndex(i) {
            return (this.users.current_page - 1) * this.users.per_page + i + 1
        },
        getRoleNames(user) {
            return user.roles.map(role => role.display_name).join(" | ")
        },
        async handleInput() {
            const response = await axios.get('/dashboard/users', {params: {q: this.searchText}});
            this.users = response.data;
        },
        async handleDelete(user) {
            // template string
            const response = await axios.post(`/dashboard/users/${user.id}`)
            if (response.data.success) {
                this.users = {
                    ...this.users,
                    data: this.users.data.filter(userItem => userItem.id !== user.id)
                }
            }
        }
    }
});
