<div class="row">
    <div class="col-xs-4">
        <img class="img img-responsive" src="{{ $notification->image }}">
    </div>

    <div class="col-xs-8">
        <h4>{{ $notification->title }}</h4>

        <p> {{ $notification->body }}</p>

        @if($notification->reached_achievement_id!=null)
            @include('course.partials.share_achievement',['reachedAchievement'=>$notification->reachedAchievement])
        @endif
    </div>
</div>