<nav id="menu-course" class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('course_path',$course->id) }}">{{ $course->subject->name }}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="@if(Route::currentRouteName()=='course_path') {{ "active"}} @endif"><a href="{{ route('course_path',$course->id) }}">Inicio</a></li>
                <li class="@if(Route::currentRouteName()=='calendar_path') {{ "active"}} @endif"><a href="{{ route('calendar_path',$course->id) }}">Calendario</a></li>
                <li class="@if(Route::currentRouteName()=='wall_path') {{ "active"}} @endif"><a href="{{ route('wall_path',$course->id) }}">Muro</a></li>
                <li class="@if(Route::currentRouteName()=='forum_path') {{ "active"}} @endif"><a href="{{ route('forum_path',$course->id) }}">Foro</a></li>
                <li role="presentation" class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                        <i class="fa fa-bell-o"></i>

                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="drop5">
                        <li role="presentation" class="dropdown-header">No hay notificaciones nuevas</li>
                        <li class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="http://linkingshops.com/notificaciones">Ver todas las notificaciones.</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
