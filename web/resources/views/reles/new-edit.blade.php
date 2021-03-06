@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Relé</div>
                <div class="panel-body">
                    @include('messages')
                    <a href="{{url('/reles')}}" title="Voltar" class="text-left btn btn-box-tool botao-voltar">
                        <i class="glyphicon glyphicon-arrow-left"></i>
                    </a>
                        @if(isset($rele))
                            Edição
                            {!! Form::open(array('url' => "/reles/edit/$rele->id", 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        @else
                            Cadastro
                            {!! Form::open(array('url' => "/reles/new", 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                         @endif 
                        <div class="form-group required">
                            {!! Form::label('name', 'Nome', array('class' => 'col-sm-3 control-label')) !!}
                            <div class='col-sm-5 input-group'>
                                <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                                {!! Form::text('name', isset($rele->name) ? $rele->name : '', array ('placeholder' => 'Insira aqui nome do Relé', 'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group required">
                            {!! Form::label('pin', 'Pino', array('class' => 'col-sm-3 control-label')) !!}
                            <div class='col-sm-5 input-group'>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-pawn"></i></span>
                                {!! Form::text('pin', isset($rele->pin) ? $rele->pin : '', array ('placeholder' => '00', 'class' => 'form-control','id'=>'pin')) !!}
                            </div>
                        </div>

                        <div class="form-group required">
                                    {!! Form::label('lab_id', 'Laboratório', array('class' => 'col-sm-3 control-label')) !!}
                                    <div class='col-sm-5 input-group'>
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                <select name="lab_id" class="chosen-select form-control">
                                                            <option value=null>Selecione</option>
                                                            @foreach ($labs as $lab)
                                                                        <option value="{{$lab->id}}"
                                                                            @if(null !== (Request::old('lab_id')) && ($lab->id==Request::old('lab_id')))
                                                                                selected
                                                                            @else
                                                                                @if(isset($rele->lab->id))
                                                                                    @if($lab->id==$rele->lab->id)   
                                                                                        selected
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                            >{{ $lab->number }}</option>
                                                            @endforeach
                                                </select>
                                    </div>
                        </div>
                        <label class="required">Indica campo obrigatório</label>
                    </div>
                    <div class="box-footer">
                        <!-- DIV para o botao enviar -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-default">
                                <i class="glyphicon glyphicon-floppy-open"></i> Salvar
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready (function(){
        $('#pin').mask('00');
    });
</script>
@endsection