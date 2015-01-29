<div class="modal fade" id="modal-create-material">
    <div class="modal-dialog">
        {{ Form::open(['route'=>['store_material_path',$course->id,$module->id],'class'=>'validate-form','novalidate'=>true]) }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Crear material</h4>
            </div>
            <div class="modal-body">
                <!--  Form Input -->
                <div class="form-group">
                    {{ Form::label('name','Nombre:') }}
                    {{ Form::text('name',null,['class'=>'form-control','required'=>true]) }}
                </div>
                {{ Form::label('type','Tipo:') }}
                <div class="row">
                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                                {{ Form::radio('type', 'video', true, ['required' => true]) }}
                                Video
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label>
                                {{ Form::radio('type', 'pdf', false, ['required' => true]) }}
                                PDF
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('url','YouTube ID:') }}
                    {{ Form::text('url',null,['class'=>'form-control','required'=>true,'placeholder'=>'Ej: eW3gMGqcZQc']) }}
                    <span class="help-block">https://www.youtube.com/watch?v=<b>eW3gMGqcZQc</b></span>
                </div>
                <div class="form-group">
                    {{ Form::label('description','Descripción:') }}
                    {{ Form::textarea('description',null,['class'=>'form-control','rows'=>3]) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
        <!-- /.modal-content -->
        {{ Form::close() }}
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-create-quiz">
    <div class="modal-dialog">
        {{ Form::open(['route'=>['store_quiz_path',$course->id,$module->id],'class'=>'validate-form','novalidate'=>true,'files' => true]) }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Crear evaluación</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('name','Tipo evaluación:') }}
                    {{ Form::select('quizzesType', $quizzesType,null,['class'=>'form-control','required'=>true]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('name','Evaluación:') }}
                    <div class="input-group">
                        <input type="text" class="form-control" readonly="">
                            <span class="input-group-btn">
                                <span class="btn btn-primary btn-file">
                                    Seleccionar archivo<input type="file" name="file"
                                                              accept=".zip" required>
                                </span>
                            </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <b>Por favor seleccione los materiales con los cuales el estudiante podrá solucionar esta
                            evaluación:</b>
                    </div>
                </div>
                @foreach($course->modules as $row)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="materials[]" value="{{ $row->id }}"> {{ $row->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>

<div class="modal fade" id="modal-edit-quiz">
    <div class="modal-dialog">
        {{ Form::open(['route'=>['edit_quiz_path',$course->id,$module->id],'class'=>'validate-form','novalidate'=>true,'files' => true]) }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Editar evaluación</h4>
            </div>
            <div class="modal-body">
                {{ Form::hidden('quizID', '',['id'=>'edit-quiz-id','required'=>true]); }}
                <div class="form-group">
                    {{ Form::label('name','Tipo evaluación:') }}
                    {{ Form::select('quizTypeID', $quizzesType,null,['id'=>'quizTypeID','class'=>'form-control','required'=>true]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('name','Evaluación:') }}
                    <div class="input-group">
                        <input type="text" class="form-control" readonly="">
                            <span class="input-group-btn">
                                <span class="btn btn-primary btn-file">
                                    Seleccionar archivo<input type="file" name="file"
                                                              accept=".zip">
                                </span>
                            </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <b>Por favor seleccione los materiales con los cuales el estudiante podrá solucionar esta
                            evaluación:</b>
                    </div>
                </div>
                @foreach($$module->materials as $material)
                    <div class="checkbox">
                        <label>
                            <input id="material-checkbox-{{ $material->id }}"  class="checkbox-materials" type="checkbox" name="materials[]"
                                   value="{{ $material->id }}"> {{ $material->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>