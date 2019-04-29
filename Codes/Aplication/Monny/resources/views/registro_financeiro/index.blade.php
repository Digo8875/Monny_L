@extends('templates/geral_view')

@section('titulo')
	Lista Registros Financeiros
@stop
  
@section('conteudo')
	<div class='row justify-content-center'>
		<div class='col-lg-12'>
	        <div class='col-lg-12' style='margin-top: 0.5%;'>
	            <div class='card col-lg-12'>
	                <div class='card-header row'>
						<div class='col-lg-6 rounded'>
			    			<h1>Lista de Registros Financeiros</h1>
			    		</div>
			    		<div class='col-lg-2 offset-lg-4' style='margin-top: 0.3%;''>
			    			<a class='btn btn-digo' href='{{ url('/registro_financeiro/create') }}'>
			    				<span class='glyphicon glyphicon-plus'></span>
			    				Novo Registro Financeiro
			    			</a>
			    		</div>
	                </div>

	                <div class='card-body'>
	                	<table class='table table-striped rounded'>
						    <thead class='rounded'>
							    <tr>
							        <th>#</th>
							        <th>Id</th>
							        <th>Nome</th>
							        <th>Descrição</th>
							        <th>Valor</th>
							        <th>Tipo</th>
							        <th>Doação</th>
							        <th>Data Pagamento</th>
							        <th>Responsável</th>
							        <th>Categoria</th>
							        <th>Subcategoria</th>
							        <th>Data Registro</th>
							        <th>Data Alteração</th>
							        <th>Ativo</th>
							        <th>Ações</th>
							    </tr>
						    </thead>
						  <tbody>
						  	@if(count($lista_registros_financeiros) < 1)
						  		<tr>
									<td colspan='15'>{{ "Não há registros no sistema!" }}</td>
								</tr>
						  	@else
							  	@for($i = 0; $i < count($lista_registros_financeiros); $i++)
									<tr>
										<td>{{ $i + 1 }}</td>
										<td>{{ $lista_registros_financeiros[$i]->id }}</td>
										<td>{{ $lista_registros_financeiros[$i]->nome }}</td>
										<td>{{ $lista_registros_financeiros[$i]->descricao }}</td>
										<td>{{ $lista_objetivos[$i]->tipo_dinheiro_sigla.' '.$lista_objetivos[$i]->valor }}</td>
										<td>{{ $lista_registros_financeiros[$i]->tipo }}</td>
										<td>{{ $lista_registros_financeiros[$i]->doacao }}</td>
										<td>{{ $lista_registros_financeiros[$i]->data_pagamento }}</td>
										<td>{{ $lista_registros_financeiros[$i]->responsavel_id }}</td>
										<td>{{ $lista_registros_financeiros[$i]->categoria_id }}</td>
										<td>{{ $lista_registros_financeiros[$i]->sub_categoria_id }}</td>
										<td>{{ $lista_registros_financeiros[$i]->created_at }}</td>
										<td>{{ $lista_registros_financeiros[$i]->updated_at }}</td>
										<td>{{ (($lista_registros_financeiros[$i]->ativo == 1) ? 'Sim' : 'Não') }}</td>
										<td>
											<a href='{{ url('/registro_financeiro/'.$lista_registros_financeiros[$i]->id.'/edit') }}' title='Editar' style='cursor: pointer;' class='glyphicon glyphicon-edit text-dark'></a>  |  
											<a href='{{ url('/registro_financeiro/'.$lista_registros_financeiros[$i]->id.'') }}' title='Detalhes' style='cursor: pointer;' class='glyphicon glyphicon-th text-dark'></a>  |  
											<a href='{{ url('/registro_financeiro/'.$lista_registros_financeiros[$i]->id.'/desativar') }}' title='Apagar' id='deletar' style='cursor: pointer;' class='glyphicon glyphicon-trash text-dark'></a>

											{{-- O DELETE Não SERÁ UTILIZADO, já que deve se manter dados no sistema. Para isso foi criado uma rota 'desativar', acima, para alterar o "ativo" 
											{{ Form::open(['url' => 'registro_financeiro/' . $lista_registros_financeiros[$i]->id, 'class' => 'pull-right']) }}
												{{ Form::hidden('_method', 'DELETE') }}
												{{ Form::submit('Deletar', array('class' => 'btn btn-warning')) }}
											{{ Form::close() }}
											--}}
										</td>
									</tr>
								@endfor
							@endif
						  </tbody>
						</table>
					</div>
	            </div>
	        </div>
	    </div>
    </div>
@stop