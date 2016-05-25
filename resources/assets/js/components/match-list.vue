<template>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>{{ title }}</h5>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Game</th>
                            <th class="text-center" colspan="3">Gamers</th>
                            <th class="text-right">Payout</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="match in matches">
                            <td>
                                <img class="game-icon" :src="match.game.logo">
                            </td>

                            <td class="text-right">
                                {{ match.winner.user.username }}
                            </td>
                            <td class="versus">
                                vs.
                            </td>
                            <td>
                                {{ match.loser.user.username }}
                            </td>

                            <td class="text-right">{{ match.payout | usd }}</td>
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
        name: 'match-list',
        data() {
            return {
                matches: [],
                games: []
            };
        },
        props: [
            'title'
        ],
        methods: {
            get_matches() {
                var vm = this;
                request
                .get('/api/v1/matches')
                .end(function(err,res) {
                    vm.matches = res.body;
                });
            }
        },
        created() {
            this.get_matches();
        }
    };
</script>

<style lang="scss" scoped>
    .game-icon {
        max-width:100px;
    }
</style>