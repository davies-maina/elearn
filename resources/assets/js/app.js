/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("login-modal", require("./components/LoginModal.vue"));

Vue.component("vue-lessons", require("./components/VueLessons.vue"));

Vue.component("v-player", require("./components/Player.vue"));
Vue.component("v-stripe", require("./components/Stripe.vue"));

const app = new Vue({
    el: "#app"
});