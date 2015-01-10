<nav id="menu-course" class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
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
                <li class="@if(Route::currentRouteName()=='course_path' || Route::currentRouteName()=='module_path') {{ "active"}} @endif"
                    role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        Módulos <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($course->modules as $module)
                            <li class="{{ isset($currentModuleID) && $currentModuleID==$module->id ? "active" :"" }}"><a
                                        href="{{ route('module_path',[$course->id,$module->id]) }}">{{ $module->name }} </a>
                            </li>
                        @endforeach
                        <li class="divider"></li>
                        <li class="{{ Route::currentRouteName()=='course_path' ? "active" :"" }}"><a
                                    href="{{ route('course_path',$course->id) }}">Ver todos</a></li>
                    </ul>
                </li>
                <li class="@if(Route::currentRouteName()=='calendar_path') {{ "active"}} @endif"><a
                            href="{{ route('calendar_path',$course->id) }}">Calendario</a></li>
                <li class="@if(Route::currentRouteName()=='wall_path') {{ "active"}} @endif"><a
                            href="{{ route('wall_path',$course->id) }}">Muro</a></li>
                <li class="@if(Route::currentRouteName()=='forum_path'|| Route::currentRouteName()=='topic_path') {{ "active"}} @endif">
                    <a href="{{ route('forum_path',$course->id) }}">Foro</a></li>
                <li role="presentation"
                    class="dropdown @if(Route::currentRouteName()=='group_ranking_path' || Route::currentRouteName()=='general_ranking_path') {{ "active"}} @endif">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        Ranking <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="@if(Route::currentRouteName()=='group_ranking_path') {{ "active"}} @endif"><a
                                    href="{{ route('group_ranking_path',$course->id) }}">Ranking grupal</a></li>
                        <li class="@if(Route::currentRouteName()=='general_ranking_path') {{ "active"}} @endif"><a
                                    href="{{ route('general_ranking_path',$course->id) }}">Ranking general</a></li>
                    </ul>
                </li>
                <li class="@if(Route::currentRouteName()=='achievement_path') {{ "active"}} @endif"><a
                            href="{{ route('achievement_path',$course->id) }}">Mis logros</a></li>
                @if(Auth::user()->isTeacher($course->id))
                    <li role="presentation"
                        class="dropdown @if(Route::currentRouteName()=='estatistics_students_path') {{ "active"}} @endif">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                            Estadísticas <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="@if(Route::currentRouteName()=='estatistics_students_path') {{ "active"}} @endif"><a
                                        href="{{ route('estatistics_students_path',$course->id) }}">Estudiantes</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
