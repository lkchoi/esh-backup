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
            <td>
                <img class="game-icon" src="{{ $match->game->logo }}">
            </td>

            <td class="text-right">
                @if ($winner = $match->winner)
                <i class="fa fa-star"></i>
                {{ $winner->user->username }}
                <div>
                    <img
                    class="character-icon"
                    src="{{ $winner->character->image->url }}"
                    alt="{{ $winner->character->name }}"
                    title="{{ $winner->character->name }}"
                    >
                </div>
                @else
                {{ $match->roles()->first()->user->username }}
                @endif
            </td>
            <td class="versus">
                vs.
            </td>
            <td>
                @if ($loser = $match->loser)
                {{ $match->loser->user->username }}
                <div>
                    <img
                    class="character-icon"
                    src="{{ $loser->character->image->url }}"
                    alt="{{ $loser->character->name }}"
                    title="{{ $loser->character->name }}"
                    >
                </div>
                @endif
            </td>

            {{-- payout --}}
            <td class="text-right">{{ $match->amount }}</td>
        </tr>
    @endforeach
    </tbody>
</table>