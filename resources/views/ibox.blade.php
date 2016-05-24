<div class="ibox float-e-margins">
    @if ( !empty($title) )
    <div class="ibox-title">
        @if ( !empty($sidetext) )
        <div class="pull-right">
            {!! $sidetext !!}
        </div>
        @endif
        <h5>{{ $title }}</h5>
    </div>
    @endif
    <div class="ibox-content">
        <div class="table-responsive">
            @include($view, $data)
        </div>
    </div>
</div>
