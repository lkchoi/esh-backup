@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-6">
        @include('ibox', ['title' => 'Leaderboard', 'view' => 'users.table', 'data' => ['users' => $users] ])
        <match-list title="Recent Matches"></match-list>
    </div>
    <div class="col-sm-12 col-lg-6">
        <chat-channel channel-id="{{ $channel->id }}"></chat-channel>
    </div>
</div>
@stop
