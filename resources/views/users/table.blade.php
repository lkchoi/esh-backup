<table class="table table-striped">
    <thead>
        <tr>
            <th>Rank</th>
            <th>Gamer</th>
            <th>Wins</th>
            <th>Losses</th>
            <th>Ratio</th>
            <th class="text-right">Earnings</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $i => $user)
        <tr>
            <td> {{ $i+1 }} </td>
            <td> {{ $user->username }} </td>
            <td> {{ $user->win_count }} </td>
            <td> {{ $user->loss_count }} </td>
            <td> {{ sprintf('%.3f', $user->win_ratio) }} </td>
            <td class="text-right"> {{ sprintf('$%d', $user->earnings/100) }} </td>
        </tr>
    @endforeach
    </tbody>
</table>
