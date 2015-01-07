<div class="row">
    <div class="col-xs-4">
        <img class="img img-responsive" src="{{ $image }}">
    </div>

    <div class="col-xs-8">
        <h4>{{ $title }}</h4>

        <p> {{ $body }}</p>

        @if(isset($extra_info))
            <p>{{ $extra_info }}</p>
        @endif
    </div>
</div>