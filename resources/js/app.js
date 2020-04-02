/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
require('./timer');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import VuejsDialog from "vuejs-dialog";
//import ProgressBar from 'vuejs-progress-bar';
//Vue.use(ProgressBar);
Vue.use(VuejsDialog);
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('student-form', require('./components/SudentForm.vue'));
Vue.component('instructions', require('./components/Instructions.vue'));

Vue.component('presentation-instructions', require('./components/presentation/PresentationInstructions.vue'));
Vue.component('presentation', require('./components/presentation/Presentation.vue'));
Vue.component('presentation-complete', require('./components/presentation/PresentationComplete.vue'));


  
let routes = [{
        name: '/presentation-complete',
        path: '/presentation-complete',
        component: require('./components/presentation/PresentationComplete.vue')
    },
    {
        name: '/presentation',
        path: '/presentation',
        component: require('./components/presentation/Presentation.vue')
    },
    {
        name: '/presentation-instructions',
        path: '/presentation-instructions',
        component: require('./components/presentation/PresentationInstructions.vue')
    },

    {
        name: '/instructions',
        path: '/instructions',
        component: require('./components/Instructions.vue')
    },
    {
        name: '/',
        path: '/',
        component: require('./components/SudentForm.vue')
    }
];

const router = new VueRouter({
    history: true,
    linkActiveClass: "active",
    routes
});

import App from './components/SudentForm.vue'
const app = new Vue({
    el: '#app',
    router,
    data: {
        showModal: false
    }
}).$mount('#app');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    if (flag) {
        setAppParams();
    }

});

function setAppParams() {
    var data = 'session=' + "";
    $.ajax({
        url: base + "session",
        type: 'post',
        data: data,
        success: function (respond) {
            if (respond.success) {
                window.localStorage.setItem('a76385aca2174c81b2b81c9032033b9b', JSON.stringify(respond.data));
            } else {
                console.log(respond);
            }
        },
        complete: function () {}
    });
}

var endSession = function(){
    $.ajax({
        url: base + "end-session",
        type: 'post',
        success: function (respond) {
            if (respond.success) {
                window.localStorage.clear();
                location.reload();
            } else {
                console.log(respond);
            }
        },
        complete: function () {}
    });
}

const application = {
endSession
};
export default application;


