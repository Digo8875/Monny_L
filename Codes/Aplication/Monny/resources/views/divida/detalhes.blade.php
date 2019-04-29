@extends('templates/geral_view')
  
@section('titulo')
	Detalhes Dívida
@stop
  
@section('conteudo')
	<div class='row justify-content-center'>
        <div class='col-lg-6' style='margin-top: 0.5%;'>
            <div class='card col-lg-12'>
                <div class='card-header row'>
                	<div class='col-lg-1'>
		    			<a href='javascript:window.history.go(-1)' class='btn btn-digo' title='Voltar'>
							<span class='glyphicon glyphicon-arrow-left' style='font-size: 25px;'></span>
						</a>
		    		</div>
					<div class='col-lg-6 offset-lg-3 rounded'>
		    			<h1>
		    			    Detalhes da Dívida
		    			</h1>
		    		</div>
                </div>

                <div class='card-body'>
                	<table class='table table-striped rounded col-lg-12'>
						<thead class='rounded'>
						    <tr>
						      <th>Campo</th>
						      <th>Valor</th>
						  	</tr>
						</thead>
						<tbody>
							<tr>
								<td>Nome</td>
								<td>{{ $obj->nome }}</td>
							</tr>
							<tr>
								<td>Descrição</td>
								<td>{{ $obj->descricao }}</td>
							</tr>
							<tr>
								<td>Tipo Monetário</td>
								<td>{{ $obj->tipo_dinheiro_nome }}</td>
							</tr>
							<tr>
								<td>Valor do Objetivo</td>
								<td>{{ $obj->tipo_dinheiro_sigla.' '.$obj->valor }}</td>
							</tr>
							<tr>
								<td>Usuário</td>
								<td>{{ $obj->usuario_nome_pessoal }}</td>
							</tr>
							<tr>
								<td>Ativo</td>
								<td>{{ (($obj->ativo == 1) ? 'Sim' : 'Não') }}</td>
							</tr>
							<tr>
								<td>Data de registro</td>
								<td>{{ $obj->created_at }}</td>
							</tr>
							<tr>
								<td>Ultima alteração</td>
								<td>{{ $obj->updated_at }}</td>
							</tr>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
@stop