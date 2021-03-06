@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Painel de Controle</div>

                <div class="panel-body">
                  @include('messages')
                   @foreach($labs as $lab)
                   
                   <div class="form-group">
                   <div class='col-sm-2'>                   
                        <label>Laboratório {{$lab->number}}</label>
                   </div>
                    <a href="{{URL::to('/labs/power/'.$lab->id)}}" class="btn btn-success">
                        <i class="fa fa-bolt" aria-hidden="true"></i> Ligar
                    </a>
                    <a href="{{URL::to('/labs/shutdown/'.$lab->id)}}" class="btn btn-danger">
                        <i class="fa fa-power-off" aria-hidden="true"></i> Desligar
                    </a>
                </div>
                   @endforeach
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
