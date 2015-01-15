<a class='btn btn-primary btn-sm' href="{{ route('share_achievement_path', [$reachedAchievement->course->id,$reachedAchievement->achievement->id]) }}">Compartir en TICademia</a>
<br><br>
<a class='btn btn-info btn-sm' onClick="MyWindow=window.open('https://www.facebook.com/sharer/sharer.php?u={{ route('share_social_achievement_path', [$reachedAchievement->id]) }}','MyWindow',width=600,height=300); return false;" href='#'> Compartir en Facebook </a>
<a class='btn btn-info btn-sm' onClick="MyWindow=window.open('http://twitter.com/share?text=He ganado el logro: {{ $reachedAchievement->achievement->name }} &url={{ route('share_social_achievement_path', [$reachedAchievement->id]) }}','MyWindow',width=600,height=300); return false;" href='#'> Compartir en Twitter </a>
