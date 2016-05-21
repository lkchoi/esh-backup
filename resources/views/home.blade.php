@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Leaderboard</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    @include('users.table', ['users' => $users])
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="pull-right">
                    <a href="/matches?status=closed">See More</a>
                </div>
                <h5>Recent Matches</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    @include('matches.table', ['matches' => $matches])
                </div>
            </div>
        </div>
    </div>
</div>
@stop
