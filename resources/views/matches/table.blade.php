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
                <img class="game-icon" src="{{ $match->game->logo }}">
            </td>

            {{-- gamers --}}
            <td class="text-right">
                {{ $match->winner->user->username }}
                <div>
                    <img
                    class="character-icon" 
                    src="{{ $match->winner->character->image->url }}"
                    alt="{{ $match->winner->character->name }}"
                    title="{{ $match->winner->character->name }}"
                    >
                </div>
            </td>
            <td class="versus">
                def.
            </td>
            <td>
                {{ $match->loser->user->username }}
                <div>
                    <img
                    class="character-icon"
                    src="{{ $match->loser->character->image->url }}"
                    alt="{{ $match->loser->character->name }}"
                    title="{{ $match->loser->character->name }}"
                    >
                </div>
            </td>

            {{-- payout --}}
            <td class="text-right">{{ $match->amount }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

@section('tail')
<style type="text/css">
.game-icon {
    max-width:120px;
}
.character-icon {
    height: 45px;
}
.versus {
    width: 5px;
    white-space: nowrap;
}
</style>
@stop