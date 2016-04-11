@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{ $list_title }}</h5>
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