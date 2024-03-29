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
                        <i class="fa fa-book"></i> Módulos <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($course->modules as $module)
                            <li class="{{ isset($currentModuleID) && $currentModuleID==$module->id ? "active" :"" }}"><a
                                        href="{{ route('module_path',[$course->id,$module->id]) }}">{{ $module->name }} </a>
                            </li>
                        @endforeach
                        {{--
                           <li class="divider"></li>
                      <li class="{{ Route::currentRouteName()=='course_path' ? "active" :"" }}"><a
                                   href="{{ route('course_path',$course->id) }}">Ver todos</a></li>
                                   --}}
                    </ul>
                </li>
                <li class="@if(Route::currentRouteName()=='calendar_path') {{ "active"}} @endif"><a
                            href="{{ route('calendar_path',$course->id) }}"><i class="fa fa-calendar"></i> Horarios de
                        los tutores</a></li>
                <li class="@if(Route::currentRouteName()=='wall_path') {{ "active"}} @endif"><a
                            href="{{ route('wall_path',$course->id) }}"><i class="fa fa-bullhorn"></i> Muro</a></li>
                <li class="@if(Route::currentRouteName()=='forum_path'|| Route::currentRouteName()=='topic_path') {{ "active"}} @endif">
                    <a href="{{ route('forum_path',$course->id) }}"><i class="fa fa-comment-o"></i> Foro</a></li>
                <li role="presentation"
                    class="dropdown @if(Route::currentRouteName()=='group_ranking_path' || Route::currentRouteName()=='individual_ranking_path') {{ "active"}} @endif">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        <i class="fa fa-list-ol"></i> Ranking <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="@if(Route::currentRouteName()=='group_ranking_path') {{ "active"}} @endif"><a
                                    href="{{ route('group_ranking_path',$course->id) }}">Ranking grupal</a></li>
                        <li class="@if(Route::currentRouteName()=='individual_ranking_path') {{ "active"}} @endif"><a
                                    href="{{ route('individual_ranking_path',$course->id) }}">Ranking individual</a>
                        </li>
                    </ul>
                </li>
                @if(Auth::user()->isStudent($course->id))
                    <li class="@if(Route::currentRouteName()=='achievement_path') {{ "active"}} @endif"><a
                                href="{{ route('achievement_path',$course->id) }}"><i class="fa fa-trophy"></i> Mis
                            logros</a></li>
                @endif
                <li role="presentation"
                    class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        <i class="fa fa-life-ring"></i> Recursos <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="">
                            <a target="_blank" href="{{ asset('assets/tutorial.pdf') }}">Tutorial para cálculos y
                                redondeo</a></li>
                    </ul>
                </li>

                @if(Auth::user()->isMonitor($course->id) || Auth::user()->isTeacher($course->id))
                    <li role="presentation"
                        class="dropdown @if(Route::currentRouteName()=='statistics_students_path' || Route::currentRouteName()=='statistics_materials_path' || Route::currentRouteName()=='module_report_path' || Route::currentRouteName()=='statistics_quizzes_path') {{ "active"}} @endif">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                            Estadísticas <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="@if(Route::currentRouteName()=='statistics_students_path') {{ "active"}} @endif">
                                <a href="{{ route('statistics_students_path',$course->id) }}">Estudiantes</a></li>
                            <li class="@if(Route::currentRouteName()=='statistics_materials_path') {{ "active"}} @endif">
                                <a href="{{ route('statistics_materials_path',$course->id) }}">Materiales</a></li>
                            <li class="@if(Route::currentRouteName()=='statistics_quizzes_path') {{ "active"}} @endif">
                                <a href="{{ route('statistics_quizzes_path',$course->id) }}">Evaluaciones</a></li>
                            <li class="divider"></li>
                            <li class="@if(Route::currentRouteName()=='module_report_path') {{ "active"}} @endif">
                                <a href="{{ route('module_report_path',$course->id) }}">Reportes</a></li>
                        </ul>
                    </li>
                @endif


            </ul>
            <div id="div-btn-duels" class="">
                <button id="btn-get-duel" class="btn btn-danger btn-sm" onclick="getDuel()"
                        data-toggle="popover" title="Duelos"
                        data-placement="bottom"
                        data-html="true"
                        data-content="Esta nueva funcionalidad te permitirá batirte a duelo con otros estudiantes. Al ganar un duelo obtienes 5 puntos los cuales te ayudarán a escalar en el <b>Ranking individual</b>."

                        >Duelos
                </button>
                <span id="div-total-users-online">
                Usuarios conectados: <b id="totalUsersOnline">0</b>
                    </span>
            </div>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
