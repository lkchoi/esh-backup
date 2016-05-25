<template>
    <div class="ibox chat-view">
        <div class="ibox-title">
            <h5>{{ channel.name }}</h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-9">
                    <div class="chat-discussion">
                        <div class="chat-message" v-for="message in messages">
                            <div class="message-avatar"><!-- FIXME --></div>
                            <div class="message">
                                <a class="message-author" href="#">{{ message.user.username }}</a>
                                <span class="message-date">{{ message.created_at }}</span>
                                <span class="message-content">{{ message.content }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 hidden-sm hidden-xs">
                    <div class="chat-users">
                        <div class="users-list">
                            <div class="chat-user" v-for="user in users">
                                <div class="chat-avatar"><!-- FIXME --></div>
                                <div class="chat-user-name">
                                    <a href="#">
                                        {{ user.username }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="chat-message-form">
                        <div class="form-group">
                            <textarea
                            class="form-control message-input"
                            name="message"
                            placeholder="Enter message text"
                            autocomplete="off"
                            autocorrect="off"
                            autocapitalize="off"
                            spellcheck="false"
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    var request = require('superagent');
    export default {
        name: 'chat-channel',
        data() {
            return {
                channel: {},
                messages: [],
                users: []
            }
        },
        props: ['channelId'],
        methods: {
            get_channel() {
                var vm = this;
                request
                .get('/api/v1/channels/' + this.channelId)
                .end(function(err, res) {
                    vm.channel = res.body;
                });
            },
            get_users() {
                var vm = this;
                request
                .get('/api/v1/channels/' + this.channelId + '/users')
                .end(function(err, res) {
                    vm.users = res.body;
                });
            },
            get_messages() {
                var vm = this;
                request
                .get('/api/v1/channels/' + this.channelId + '/messages')
                .end(function(err, res) {
                    vm.messages = res.body;
                });
            }
        },
        created() {
            this.get_channel();
            this.get_users();
            this.get_messages();
        }
    };
</script>
<style lang="scss" scoped>
    @import "../../sass/variables";
    $chat_box_height: 50em;
    .chat-view textarea,
    .chat-user,
    .chat-message > .message {
        border: 1px $black solid;
        background: $border-color;
    }
    .chat-users,
    .chat-discussion {
        height: $chat_box_height;
        background: $ibox-content-bg;
    }
    .chat-composer textarea {
        border: 2px $black solid;
        background-color: $gray;
        color: $text-color;
        resize: vertical;
    }
    .chat-view .message-avatar,
    .chat-view .chat-avatar,
    .chat-view img {
        background: $gray;
        border:0px;
    }
    .chat-view textarea:hover {
        border-color: $blue;
    }
</style>