<nav id="menu" class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ route('home') }}">
                <img id="logo" src="{{ asset('assets/images/general/ticademia.png')}}" width="107" height="47">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="@if(Route::currentRouteName()=='') {{ "active"}} @endif">
                    <a href="{{ route('my_courses_path') }}">Lista de cursos</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li role="presentation" class="dropdown">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">

                            @if(Auth::user()->unviewedNotifications->count())
                                <i class="fa fa-bell-o icon-animated-bell"></i>
                                <span class="badge badge-notification">{{ Auth::user()->unviewedNotifications->count() }}</span>
                            @else
                                <i class="fa fa-bell-o"></i>
                            @endif

                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop5">
                            @forelse(Auth::user()->unviewedNotifications as $notification)
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{  route("show_notification_path",$notification->id)   }}">{{ $notification->body }}</a></li>
                            @empty
                                <li role="presentation" class="dropdown-header">No hay notificaciones nuevas</li>
                            @endforelse
                            <li class="divider"></li>
                            <li role="presentation"><a  role="menuitem" tabindex="-1" href="{{ route('notifications_path') }}">Ver todas las notificaciones.</a></li>
                        </ul>
                    </li>
                    <li class="@if(Route::currentRouteName()=='my_courses_path') {{ "active"}} @endif">
                        <a href="{{ route('my_courses_path') }}">Mis cursos</a>
                    </li>
                    <li id="avatar-header"> @include('layouts.partials.avatar_circle')</li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->first_name }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="@if(Route::currentRouteName()=='profile_path') {{ "active"}} @endif">
                                <a href="{{ route('profile_path') }}">Mi perfil</a>
                            </li>
                            <li class="divider"></li>
                            <li>{{ link_to_route('logout_path','Salir') }}</li>
                        </ul>
                    </li>
                @else
                    <li @if(Route::currentRouteName()=='register_path') {{ "class='active'"}} @endif>{{ link_to_route('register_path','Registrarse') }}</li>
                    <li class=" nav  navbar-nav dropdown">
                        <a class="white cursor" href="#" data-toggle="dropdown">Entrar <b class="caret"></b></a>
                        <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        {{ Form::open(['route'=>'login_path','class'=>'validate-form','novalidate'=>true]) }}
                                        <!-- E-mail Form Input -->
                                        <div class="form-group">
                                            {{ Form::label('email','Correo electrónico:') }}
                                            {{ Form::text('email',null,['class'=>'form-control email','required'=>true]) }}
                                        </div>
                                        <!-- Contraseña Form Input -->
                                        <div class="form-group">
                                            {{ Form::label('password','Contraseña:') }}
                                            {{ Form::password('password',['class'=>'form-control','required'=>true]) }}
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                {{ Form::checkbox('remember', 'true') }} Recuerdame
                                            </label>
                                        </div>
                                        <!-- Enviar button -->
                                        <div class="form-group">
                                            {{ Form::submit('Enviar',['class'=>'btn btn-primary btn-block']) }}
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        {{ link_to('/password/remind','¿Olvidó su contraseña?') }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a class="btn btn-block btn-social btn-facebook"
                                           href="{{ route('login_facebook_path') }}">
                                            <i class="fa fa-facebook"></i> Entrar con Facebook
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a class="btn btn-block btn-social btn-google-plus"
                                           href="{{ route('login_google_path') }}">
                                            <i class="fa fa-google-plus"></i> Entrar con Google
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>
@if(isset($course))
    @include('course.partials.menu_course')
@endif