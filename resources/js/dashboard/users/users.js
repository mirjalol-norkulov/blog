import Vue from 'vue'
import axios from 'axios'
import vueDebounce from 'vue-debounce'

axios.defaults.headers['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

Vue.use(vueDebounce);

new Vue({
    el: '#users-app',
    data: {
        users: window.users,
        searchText: window.query || ''
    },
    mounted() {
        // const pageItems = document.querySelectorAll('.page-item');
        // console.log(pageItems);
        // pageItems.forEach(pageItem => {
        //     pageItem.addEventListener('click', this.onPageItemClick)
        // })
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
        },
        async fetchData(url) {
            const {data} = await axios.get(url)
            this.users = data
        },
        async onPageItemClick(event) {
            event.preventDefault()
            const textContent = event.target.textContent;
            const isPrevious = textContent === '‹';
            const isNext = textContent === '›'
            const activeItem = document.querySelector('.page-item.active');
            if(isPrevious) {
                await this.fetchData(this.users.prev_page_url);
                activeItem.classList.remove('active');
                activeItem.removeAttribute('aria-current');
                event.target.classList.add('active');
                event.target.setAttribute('aria-current', 'page')
            } else if(isNext) {
                await this.fetchData(this.users.next_page_url)
                activeItem.classList.remove('active');
                activeItem.removeAttribute('aria-current');
                event.target.classList.add('active');
                event.target.setAttribute('aria-current', 'page')
            } else {
                await this.fetchData(`/dashboard/users?page=${textContent}`)
                activeItem.classList.remove('active');
                activeItem.removeAttribute('aria-current');
                const currentItem = event.target.closest('.page-item');
                currentItem.classList.add('active');
                currentItem.setAttribute('aria-current', 'page')
            }
        }
    }
});
