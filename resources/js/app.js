/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/** adding vuetify**/

import Vuetify from 'vuetify'
import VueRouter from 'vue-router'

Vue.use(Vuetify)
Vue.use(VueRouter)

import 'vuetify/dist/vuetify.min.css'

console.log('user object from vue', window.user);

import Auth from './auth'

Vue.prototype.$auth = new Auth(window.user);

Vue.component('example-component', require('./components/Examplecomponent.vue').default);
Vue.component('admin', require('./components/Admin.vue').default);

import Dashboard from './pages/Dashboard'
import Settings from './pages/Settings'
import Users from './pages/Users'
import Roles from './pages/Roles'
import Permission from './pages/Permission'
import Activities from './pages/Activities'

const routes = [
    {
        path: '/admin/',
        component: Dashboard
    },
    {
        path: '/admin/users',
        component: Users
    },
    {
        path: '/admin/roles',
        component: Roles
    },
    {
        path: '/admin/permissions',
        component: Permission
    },
    {
        path : '/admin/activities',
        component: Activities
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
})


/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import { rollupVersion } from 'vite';
app.component('example-component', ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.globEager('./**/*.vue')).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
