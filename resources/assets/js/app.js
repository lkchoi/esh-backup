var Vue = require('vue');

import ChatChannel from './components/chat-channel.vue';
import MatchList from './components/match-list.vue';
import UserList from './components/user-list.vue';

/**
 * Replace underscores with spaces
 *
 * @param {String}
 * @return {String}
 */
 Vue.filter('unslug', function(value) {
    return value.replace(/_/g, ' ');
 });

/**
 * Converts lower case string to title case
 *
 * @param  {String}
 * @return {String}
 */
Vue.filter('titlecase', function(value) {
    return value.replace(/(\w+)/g, function (match) {
        return match.charAt(0).toUpperCase() + match.slice(1);
    });
});

/**
 * Converts 1450 to "$15"
 *   - divides by 100
 *   - rounds to nearest whole number
 *   - prepends "$" (dollar sign)
 *
 * @param  {int}
 * @param  {boolean}
 * @return {String}
 */
Vue.filter('usd', function(value, cents) {
    cents = cents ? 2 : 0;
    return '$' + parseFloat(value/100).toFixed(cents);
});


/**
 * Homepage Vue Instance
 */
new Vue({
    el: '#app',
    components: {
        ChatChannel,
        MatchList,
        UserList
    },
    ready: function() {
    }
});
