<div class="row">
    <div class="col-sm-4">
        <div id="materials-div" class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Materiales</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    @foreach($module->materials as $material)
                        <tr>
                            <td>
                                <img src="{{ $material->iconPath() }}" width="35">
                            </td>
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
                                     data-material-review-anonymous="{{ $material->userReviews[0]->anonymous }}"
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
                <table class="table  table-striped table-hover table-responsive">
                    <?php $index = 15 * (Input::get('page', 1) - 1)?>
                    @foreach($ranking as $user)
                        <tr class="{{ $user->isMe() ? "warning" :""}}">
                            <td>
                                {{ ++$index }}
                            </td>
                            <td>
                                <img class="img-rounded avatar info-user" data-user-id="{{ $user->id }}" width="30" src="{{ $user->avatarPath() }}" alt="{{  $user->fullName() }}">
                                {{ $user->linkFullName() }}
                                @if($index==1)
                                    <img width="25" src="{{ asset('assets/images/general/gold_cup.png') }}">
                                @elseif($index==2)
                                    <img width="25" src="{{ asset('assets/images/general/silver_cup.png') }}">
                                @elseif($index==3)
                                    <img width="25" src="{{ asset('assets/images/general/bronze_cup.png') }}">
                                @endif
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
                <center>
                    <?php $prevQuizIsAproved = true; ?>
                    @foreach($module->quizzes as $quiz)
                        <div class="quiz-div {{ $prevQuizIsAproved || Auth::user()->isMonitor($course->id) || Auth::user()->isTeacher($course->id)? "hvr-float-shadow" : "" }}">
                            <div class="quiz-launcher {{ $prevQuizIsAproved || Auth::user()->isMonitor($course->id) || Auth::user()->isTeacher($course->id)? "" : "disabled" }}"
                                 data-evaluacion-id="{{ $quiz->id }}"
                                 data-url="{{ $quiz->path($course) }}"
                                 data-order="{{ $quiz->order }}">
                                <div class="quiz-name">
                                    {{ $quiz->order }}
                                </div>
                                <div class="quiz-attempts">
                                    @if( $quiz->userQuizAttempts->count())
                                        {{ $quiz->userQuizAttempts[0]->successful_attempts .'/'. $quiz->userQuizAttempts[0]->total_attempts }}
                                    @else
                                        0/0
                                    @endif
                                </div>
                                <div class="quiz-score">
                                    {{ is_null($quiz->approvedQuiz) ? "--" : $quiz->approvedQuiz->score  }}
                                    <img src="{{ asset('assets/images/course/star.png') }}" width="15">
                                </div>
                                <div class="quiz-best-time">
                                    {{ is_null($quiz->approvedQuiz) || $quiz->approvedQuiz->user_id==null ? "--" : $quiz->approvedQuiz->best_time  }}
                                    <img src="{{ asset('assets/images/course/time.png') }}" width="10">
                                </div>

                                <div class="quiz-status">
                                    @if(Auth::user()->isMonitor($course->id) || Auth::user()->isTeacher($course->id))
                                        <i class="fa fa-unlock"></i>
                                    @elseif(!is_null($quiz->approvedQuiz) && $quiz->approvedQuiz->skipped==0 && $quiz->approvedQuiz->created_at<=$module->end_date  )
                                        <i class="fa fa-check"></i>
                                    @elseif(!is_null($quiz->approvedQuiz) && $quiz->approvedQuiz->skipped==0 && $quiz->approvedQuiz->created_at>$module->end_date  )
                                        <i class="fa fa-check-circle"></i>
                                    @elseif(!is_null($quiz->approvedQuiz) && $quiz->approvedQuiz->skipped==1)
                                        <i class="fa fa-share"></i>
                                    @elseif(!$prevQuizIsAproved)
                                        <i class="fa fa-lock"></i>
                                    @elseif($prevQuizIsAproved)
                                        <i class="fa fa-unlock"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="quiz-best-time-ever"  data-toggle="popover" title="Mejor tiempo" data-content="
                           @if (!is_null($quiz->user_id))
                           Obtenido por: {{ $quiz->user->fullName() }}
                           <br>
                           Tiempo: <b>{{ $quiz->best_time}}</b> segundos
                           @endif
                            ">
                                @if(!is_null($quiz->user_id))
                                    <img class="img-circle" src="{{ $quiz->user->avatarPath() }}" width="32">
                                @endif
                            </div>
                            <div class="jump-quiz">
                                @if(is_null($quiz->approvedQuiz) && $prevQuizIsAproved && $quiz->userQuizAttempts->count() )
                                    <a class="btn btn-info btn-sm skip-quiz"
                                       data-evaluacion-id="{{ $quiz->id }}"> <i class="fa fa-share"></i></a>
                                @endif
                            </div>
                        </div>

                        <?php
                        $prevQuizIsAproved = !is_null($quiz->approvedQuiz);
                        ?>
                    @endforeach
                </center>
            </div>
        </div>
    </div>
</div>
