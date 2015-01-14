<div class="row">
    <div class="col-sm-4">
        <div id="materials-div" class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Materiales</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover table-responsive">
                    @foreach($module->materials as $material)
                        <tr>
                            <td><a class="link video-launcher"
                                   data-id="{{ $material->id }}"
                                   data-name="{{ $material->name }}"
                                   data-url="{{ $material->url }}">{{ $material->name }}</a>
                                @if( $material->user_play_back_time->count())
                                    <i class="fa fa-check"></i> {{ round($material->user_play_back_time[0]->playback_time/60,1) }}
                                    m
                                @endif
                                <br>

                                <div class="estrellas" data-score="{{ $material->rating_cache }}"
                                     data-name="{{ $material->name }}"
                                     data-material-id="{{ $material->id }}"
                                @if( $material->userReviews->count())
                                     data-material-review-id="{{  $material->userReviews[0]->id }}"
                                     data-material-review-rating="{{ $material->userReviews[0]->rating }}"
                                     data-material-review-comment="{{ $material->userReviews[0]->comment }}"
                                        @endif></div>
                                <span class="text-muted"> ({{ $material->rating_count }})</span>
                                <a class="link show-reviews" data-name="{{ $material->name }}"
                                   data-material-id="{{ $material->id }}">Ver comentarios</a><span
                                        class="text-muted"> ({{ $material->reviewsWithComments->count() }}) </span>

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div id="ranking-div" class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Ranking del módulo</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <?php $index = 15 *(Input::get('page', 1) - 1)?>
                    @foreach($ranking as $user)
                        <tr class="{{ $user->isMe() ? "warning" :""}}">
                            <td>
                                {{ ++$index }}
                            </td>
                            <td class="hidden-sm hidden-md">
                                @include('layouts.partials.link_avatar_square',['user'=>$user,'size'=>50])
                            </td>
                            <td>
                                @if($index==1)
                                    <img width="25" src="{{ asset('assets/images/general/gold_cup.png') }}">
                                @elseif($index==2)
                                    <img width="25" src="{{ asset('assets/images/general/silver_cup.png') }}">
                                @elseif($index==3)
                                    <img width="25" src="{{ asset('assets/images/general/bronze_cup.png') }}">
                                @endif
                                {{ $user->linkFullName() }}

                            </td>
                            <td>{{ $user->score }}


                            </td>
                        </tr>
                    @endforeach

                </table>
                {{ $ranking->links() }}
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div id="quizzes-div" class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Evaluaciones</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <tr>
                        <td>
                            Eva.
                        </td>
                        <td>
                            Int.
                        </td>
                        <td>
                            Mejor tiempo
                        </td>
                        <td>
                            Puntaje
                        </td>
                        <td>
                            Mi mejor tiempo
                        </td>
                        <td>
                            Opc.
                        </td>
                    </tr>
                    <?php $prevQuizIsAproved = true; ?>
                    @foreach($module->quizzes as $quiz)

                        <tr>
                            <td>{{ $quiz->order }}</td>
                            <td>
                                @if( $quiz->userQuizAttempts->count())
                                    {{ $quiz->userQuizAttempts[0]->successful_attempts }}/{{ $quiz->userQuizAttempts[0]->total_attempts }}
                                @else
                                    0/0
                                @endif
                            </td>
                            <td>
                                @if(!is_null($quiz->best_time))
                                    {{ $quiz->best_time  }} segundos
                                    <br>
                                    Por:  {{ $quiz->user->linkFullName() }}
                            </td>
                            @endif
                            <td>{{ is_null($quiz->approvedQuiz) ? "" : $quiz->approvedQuiz->score  }}</td>
                            <td>{{ is_null($quiz->approvedQuiz) || $quiz->approvedQuiz->best_time==null ? "" : $quiz->approvedQuiz->best_time.' segundos'  }} </td>
                            <td>
                                <a class="btn btn-primary btn-sm quiz-launcher {{ $prevQuizIsAproved || Auth::user()->isMonitor($course->id) || Auth::user()->isTeacher($course->id)? "" : "disabled" }}"
                                   data-evaluacion-id="{{ $quiz->id }}"
                                   data-url="{{ $quiz->path($course) }}"
                                   data-order="{{ $quiz->order }}">Ver</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('topic_path',[$course->id,$quiz->topic_id]) }}">Tema</a>
                                @if(is_null($quiz->approvedQuiz) && $prevQuizIsAproved && $quiz->userQuizAttempts->count() )
                                    <a class="btn btn-default btn-sm skip-quiz" data-evaluacion-id="{{ $quiz->id }}">Saltar</a>
                                @endif
                            </td>

                        </tr>
                        <?php
                        $prevQuizIsAproved = !is_null($quiz->approvedQuiz);
                        ?>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
</div>
