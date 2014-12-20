<img class="media-object img-circle avatar" width="{{ isset($size) ? $size : 40 }}" height="{{ isset($size) ? $size : 40 }}" src="{{ Auth::user()->avatarPath() }}" alt="{{ Auth::user()->name }}">
