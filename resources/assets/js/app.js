
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.events = new Vue();

window.flash = function (message, style = 'success') {
    window.events.$emit('flash', message, style);
};

// Vue.component('like', require('./components/Like.vue'));

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('searcher', require('./components/Searcher.vue'));
Vue.component('posts', require('./components/posts/Posts.vue'));
Vue.component('follows', require('./components/follows/Follows.vue'));
Vue.component('follow-button', require('./components/follows/FollowButton.vue'));

// Vue.component('post', require('./components/Post.vue'));

const app = new Vue({
    el: '#app'
});
