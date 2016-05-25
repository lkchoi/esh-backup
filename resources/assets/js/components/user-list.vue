<template>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>{{ title }} ( by {{ order_by | unslug | titlecase }} )</h5>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Gamer</th>
                            <th :class="hl('win_count')">
                                <a @click="reorder('win_count','desc')">
                                    Wins
                                </a>
                            </th>
                            <th :class="hl('loss_count')">
                                <a @click="reorder('loss_count','asc')">
                                    Losses
                                </a>
                            </th>
                            <th :class="hl('win_ratio')">
                                <a @click="reorder('win_ratio','desc')">
                                    Ratio
                                </a>
                            </th>
                            <th class="text-right" :class="hl('earnings')">
                                <a @click="reorder('earnings','desc')">
                                    Earnings
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(rank, user) in users" track-by="$index">
                            <td>{{ rank + 1 }}</td>
                            <td>{{ user.username }}</td>
                            <td>{{ user.win_count }}</td>
                            <td>{{ user.loss_count }}</td>
                            <td>
                                <span class="pie">{{ user.win_count }}/{{ user.match_count }}</span>
                                <span style="margin-left:1ex;">
                                    {{ parseFloat( user.win_ratio*100 ).toFixed(1) }}
                                    <small class="text-muted">%</small>
                                </span>
                            </td>
                            <td class="text-right">
                                {{ user.earnings | usd }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    var request = require('superagent');

    export default {
        name: 'users-list',
        data () {
            return {
                users: [],
                order_by: 'earnings',
                order: 'desc'
            };
        },
        props: [
            'title'
        ],
        methods: {
            get_users() {
                var vm = this;
                request
                .get('/api/v1/users', {
                    order_by: this.order_by,
                    order: this.order,
                    limit: 10,
                    offset: 0
                })
                .end(function(err,res) {
                    vm.users = res.body;
                    vm.$nextTick(function() { vm.pie(); });
                });
            },

            reorder(order_by, order) {
                this.order_by = order_by;
                this.order = order;
                this.get_users();
            },

            hl(field) {
                return field===this.order_by ? this.order : '';
            },

            pie() {
                $('.pie').peity('pie', {
                    fill: [
                        '#1c84c6', // $blue
                        '#191919' // $table-bg-accent
                    ]
                });
            },
        },
        created() {
            this.get_users();
        }
    };
</script>

<style lang="scss" scoped>

    th.asc::after {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        content: "\f106 ";
    }

    th.desc::after {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        content: "\f107 ";
    }

</style>