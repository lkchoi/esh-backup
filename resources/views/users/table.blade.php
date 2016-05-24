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
            <td>
                <span class="pie">{{ $user->win_count }}/{{ $user->win_count + $user->loss_count }}</span>
            </td>
            <td class="text-right"> {{ sprintf('$%d', $user->earnings/100) }} </td>
        </tr>
    @endforeach
    </tbody>
</table>

@section('tail')
@parent
<script src="/js/plugins/peity/jquery.peity.min.js"></script>
<script>
    var win_color = '#1c84c6'; // $blue
    var loss_color = '#191919'; // $table-bg-accent
    $('span.pie').peity('pie', {
        fill: [win_color, loss_color]
    });
</script>
@stop