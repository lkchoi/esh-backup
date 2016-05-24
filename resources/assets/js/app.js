var Vue = require('vue');

import ChatChannel from './components/chat-channel.vue';
import MatchList from './components/match-list.vue';

new Vue({
    el: '#app',
    components: {
        ChatChannel,
        MatchList
    },
    ready: function() {
        console.log('Vue (#app) ready');
    }
});
