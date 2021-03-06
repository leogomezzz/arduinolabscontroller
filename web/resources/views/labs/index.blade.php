@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Laboratórios
                    <a href="{{url('/labs/new')}}" title="Adicionar">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </div>
                
                <div class="panel-body">
                    @include('messages')
                        <div class="box-body table-responsive no-padding">
                            <table class="table text-center table-hover table-bordered" cellspacing="0" width="100%" id="example">
                                <thead class="cabecalhodetabelageral">
                                    <tr>
                                        <th class='text-center'>Número</th>
                                        <th class='text-center'>Usuário Linux</th>
                                        <th class='text-center'>Usuário Windows</th>
                                        <th class='text-center'>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($labs as $lab)
                                        <tr>
                                            <td>{{ $lab->number }}</td>
                                            <td>{{ $lab->linux_user }}</td>
                                            <td>{{ $lab->windows_user }}</td>
                                            <td>
                                                <a href='{{url("/labs/edit/{$lab->id}")}}' title="Editar">
                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                </a>
                                                <a href='{{url("/labs/delete/{$lab->id}")}}' title="Excluir" onclick="return confirm('Deletar esse registro?')">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
