@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <chat-channel channel-id="{{ $channel->id }}"></chat-channel>
    </div>
    <div class="col-sm-12 col-lg-6">
        <user-list title="Leaderboard"></user-list>
        <match-list title="Recent Matches"></match-list>
    </div>
</div>
@stop

@section('tail')
<script src="/js/plugins/peity/jquery.peity.min.js"></script>
@stop