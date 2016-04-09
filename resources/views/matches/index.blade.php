@extends('layouts.default')
@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <th>Game</th>
            <th class="text-center" colspan="3">Gamers</th>
            <th class="text-right">Payout</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($matches as $match)
        <tr>
            {{-- game --}}
            <td>
                <img src="{{ $match->game->logo }}" style="height:30px;">
            </td>

            {{-- gamers --}}
            <td class="text-right">
                {{ $match->getPlayer(0)->user->username }}
                <div>
                    <img src="{{ $match->getPlayer(0)->character->image->url }}" style="height:45px;">
                </div>
                {{--
                <div>
                    <small class="text-muted">
                        ({{ $match->getPlayer(0)->character->name }})
                    </small>
                </div>
                --}}
            </td>
            <td style="width:4px;">vs</td>
            <td>
                {{ $match->getPlayer(1)->user->username }}
                <div>
                    <img src="{{ $match->getPlayer(1)->character->image->url }}" style="height:45px;">
                </div>
                {{--
                <div>
                    <small class="text-muted">
                        ({{ $match->getPlayer(1)->character->name }})
                    </small>
                </div>
                --}}
            </td>

            {{-- payout --}}
            <td class="text-right">{{ $match->amount }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
