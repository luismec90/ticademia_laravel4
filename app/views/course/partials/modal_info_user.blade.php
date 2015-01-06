<div class="modal fade" id="modal-info-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Carné</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        @include('layouts.partials.avatar_square',['user'=>$user,'size'=>'auto'])
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>{{ $user->fullName() }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-bordered table-condensed table-striped table-hover">
                                    <tr>
                                        <td>Correo</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Grupo</td>
                                        <td>{{ $user->courses->find($course->id)->pivot->group }}</td>
                                    </tr>
                                    <tr>
                                        <td>Posición general</td>
                                        <td>{{ $user->general_position }}</td>
                                    </tr>
                                    <tr>
                                        <td>Puntaje total</td>
                                        <td>{{ $user->total_score }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <h4>Nivel: {{ $level->name  }}</h4>

                        <div class="row">
                            <div class="col-xs-12">
                                <img class="img img-responsive img-t" src="{{ $level->imagePath(Auth::user()->gender)  }}">
                            </div>
                        </div>
                        </div>
                        <div class="col-xs-8">
                            <h4>Logros obtenidos: {{ ($reachedAchievements->count()) }}</h4>

                            <div id="myCarousel" class="carousel slide">
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <?php
                                    $i = 0;
                                    foreach ($reachedAchievements as $reachedAchievement) {
                                    if ($i == 0)
                                    {
                                        echo "<div class='item active'>  <div class='row'>";
                                    } else if ($i % 4 == 0)
                                    {
                                        echo "<div class='item'><div class='row'>";
                                    }
                                    ?>

                                    <div class="col-sm-3"><a href="#x"
                                                             title="Nombre: {{ $reachedAchievement->achievement->name }}. Descripción: {{ $reachedAchievement->achievement->description }}">
                                            @include('course.partials.achievement_image',['achievement'=>$reachedAchievement->achievement])
                                        </a>
                                    </div>

                                    <!--/row-->
                                    <?php
                                    if ($i != 0 && ($i + 1) % 4 == 0)
                                    {
                                        echo " </div></div>";
                                    }
                                    $i ++;
                                    }
                                    if (($i) % 4 != 0)
                                    {
                                        echo " </div></div>";
                                    }
                                    ?>


                                </div>
                                <?php if ($reachedAchievements->count() > 4) { ?>
                                <!-- Controls -->
                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>Puntaje por módulo</h4>
                                    <table class="table table-bordered table-condensed table-striped table-hover">

                                        @foreach($user->modules as $module)
                                            <tr>
                                                <td>{{ $module->name }}</td>
                                                <td>{{ $module->pivot->score }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
