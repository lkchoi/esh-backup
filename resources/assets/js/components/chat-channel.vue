<template>
    <div class="ibox chat-view">
        <div class="ibox-title">
            <h5>{{ channel.name }}</h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-9">
                    <div class="chat-discussion">
                        <div class="chat-message" v-for="message in messages" track-by="$index">
                            {{ message }}
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
                    <form class="chat-message-form" @submit.prevent="sendMessage()" v-if="api_token">
                        <div class="input-group">
                            <input
                            class="form-control"
                            name="message"
                            autocomplete="off"
                            autocorrect="off"
                            autocapitalize="off"
                            spellcheck="false"
                            v-model="message"
                            ></input>
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary">
                                    Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    var request = require('superagent');
    var io = require('socket.io-client');
    var socket = io('http://esportshero.app:3000');

    export default {
        name: 'chat-channel',
        data() {
            return {
                api_token: php.api_token,
                channel: {},
                messages: [],
                users: [],
                message: null,
                auth: php.auth
            }
        },
        props: ['channelId'],
        methods: {
            getChannel() {
                request
                .get('/api/v1/channels/' + this.channelId)
                .end(function(err, res) {
                    this.channel = res.body
                }.bind(this))
            },
            getMessages() {
                request
                .get('/api/v1/channels/' + this.channelId + '/messages')
                .end(function(err, res) {
                    this.messages = res.body.data
                }.bind(this))
            },
            sendMessage() {
                // broadcast to node server
                socket.emit('chat.message', this.message)
                this.message = null
            }
        },
        created() {
            this.getChannel()
        },
        ready() {
            // listen for new messages
            socket.on('chat.message', function(message) {
                console.log('message received: ', message)
                this.messages.push(message)
            }.bind(this))
        }
    }
</script>
<style lang="scss" scoped>
    @import "../../sass/variables";
    $chat_box_height: 40em;
    .chat-view input,
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
    .chat-composer input {
        background-color: $gray;
        color: $text-color;
        resize: vertical;
    }
    .chat-view .message-avatar,
    .chat-view .chat-avatar,
    .chat-view img {
        background: $gray;
        border: 0px;
    }
    .chat-view input {
        border-color: $blue;
    }
</style>