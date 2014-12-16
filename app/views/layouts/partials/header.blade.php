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

            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img class="nav-gravatar" src="">
                            {{ Auth::user()->nombres }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li> <a>Mi perfil</a></li>
                            <li><a href="#">Another action</a></li>
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
                                            {{ Form::text('email','luismec90@gmail.com',['class'=>'form-control email','required'=>true]) }}
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
                                            {{ Form::submit('Enviar',['class'=>'btn btn-success btn-block']) }}
                                        </div>

                                    {{ Form::close() }}

                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-12 text-center">
                                       {{ link_to('/password/remind','¿Olvidó su contraseña?') }}
                                   </div>
                               </div>
                           </li>
                       </ul>
                    </li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>