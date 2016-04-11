@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-8 col-lg-offset-2">

        {!! Form::open(['url' => '/matches']) !!}

        {{-- game --}}
        @foreach ($games as $game)
        <div class="form-group">
            <label class="game-label">
                {!! Form::radio('game_id', $game->id, true) !!}
                <img src="{{ $game->logo }}" class="game-icon">
            </label>
        </div>
        @endforeach

        {{-- payout --}}
        <div class="form-group row">
            <label class="payout-label col-sm-2">
                {!! Form::radio('payout', 200, true) !!}
                <div class="payout-icon" style="background-image:url('/img/payouts/usd-2.jpg')"></div>
            </label>
            <label class="payout-label col-sm-2">
                {!! Form::radio('payout', 500) !!}
                <div class="payout-icon" style="background-image:url('/img/payouts/usd-5.jpg')"></div>
            </label>
            <label class="payout-label col-sm-2">
                {!! Form::radio('payout', 1000) !!}
                <div class="payout-icon" style="background-image:url('/img/payouts/usd-10.jpg')"></div>
            </label>
        </div>

        {{-- character --}}
        <div class="form-group row">
            <label class="character-label col-sm-2 col-md-1">
                {!! Form::radio('character_id', '') !!}
                <div class="character-icon" style="background-image:url('/img/characters/unknown.jpg')"></div>
            </label>
            @foreach ($characters as $char)
            <label class="character-label col-sm-2 col-md-1">
                {!! Form::radio('character_id', $char->id) !!}
                <div style="background-image:url({{ $char->image->url }})" class="character-icon"></div>
                {{-- <img src="{{ $char->image->url }}"class="character-icon"title="{{ $char->name }}"> --}}
            </label>
            @endforeach
        </div>

        {{-- character --}}
        <div class="form-group">
        </div>

        <div class="form-group">
            {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
@section('tail')
<script src="/js/matches/create.js"></script>
<style type="text/css">
    input[type="radio"] {
        display: none;
    }
</style>
@stop