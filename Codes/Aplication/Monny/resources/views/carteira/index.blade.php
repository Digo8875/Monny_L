@extends('templates/geral_view')

@section('titulo')
	Lista Carteiras
@stop
  
@section('conteudo')
	<div class='row justify-content-center'>
		<div class='col-lg-12'>
	        <div class='col-lg-12' style='margin-top: 0.5%;'>
	            <div class='card col-lg-12'>
	                <div class='card-header row'>
						<div class='col-lg-6 rounded'>
			    			<h1>Lista de Carteiras</h1>
			    		</div>
			    		<div class='col-lg-2 offset-lg-4' style='margin-top: 0.3%;''>
			    			<a class='btn btn-digo' href='{{ url('/carteira/create') }}'>
			    				<span class='glyphicon glyphicon-plus'></span>
			    				Nova Carteira
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
							        <th>Carteira Mestre</th>
							        <th>Data Registro</th>
							        <th>Data Alteração</th>
							        <th>Ativo</th>
							        <th>Ações</th>
							    </tr>
						    </thead>
						  <tbody>
						  	@if(count($lista_carteiras) < 1)
						  		<tr>
									<td colspan='9'>{{ "Não há registros no sistema!" }}</td>
								</tr>
						  	@else
							  	@for($i = 0; $i < count($lista_carteiras); $i++)
									<tr>
										<td>{{ $i + 1 }}</td>
										<td>{{ $lista_carteiras[$i]->id }}</td>
										<td>{{ $lista_carteiras[$i]->nome }}</td>
										<td>{{ $lista_carteiras[$i]->descricao }}</td>
										@if(is_null($lista_carteiras[$i]->carteira_mestre_nome))
											<td>{{ 'RAIZ' }}</td>
										@else
											<td>{{ $lista_carteiras[$i]->carteira_mestre_nome }}</td>
										@endif
										<td>{{ $lista_carteiras[$i]->created_at }}</td>
										<td>{{ $lista_carteiras[$i]->updated_at }}</td>
										<td>{{ (($lista_carteiras[$i]->ativo == 1) ? 'Sim' : 'Não') }}</td>
										<td>
											<a href='{{ url('/carteira/'.$lista_carteiras[$i]->id.'/edit') }}' title='Editar' style='cursor: pointer;' class='glyphicon glyphicon-edit text-dark'></a>  |  
											<a href='{{ url('/carteira/'.$lista_carteiras[$i]->id.'') }}' title='Detalhes' style='cursor: pointer;' class='glyphicon glyphicon-th text-dark'></a>  |  
											<a href='{{ url('/carteira/'.$lista_carteiras[$i]->id.'/desativar') }}' title='Apagar' id='deletar' style='cursor: pointer;' class='glyphicon glyphicon-trash text-dark'></a>

											{{-- O DELETE Não SERÁ UTILIZADO, já que deve se manter dados no sistema. Para isso foi criado uma rota 'desativar', acima, para alterar o "ativo" 
											{{ Form::open(['url' => 'carteira/' . $lista_carteiras[$i]->id, 'class' => 'pull-right']) }}
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


















































	<div class='row justify-content-center'>
		<div class='col-lg-12'>
			<div class='card col-lg-12'>
	            <div class='card-header row'>
					<div class='col-lg-6 rounded'>
		    			<h1>Lista de Carteiras</h1>
		    		</div>
		    		<div class='col-lg-2 offset-lg-4' style='margin-top: 0.3%;''>
		    			<a class='btn btn-digo' href='{{ url('/carteira/create') }}'>
		    				<span class='glyphicon glyphicon-plus'></span>
		    				Nova Carteira
		    			</a>
		    		</div>
	            </div>
	        </div>
	        <div class='col-lg-12' style='margin-top: 0.5%;'>
	        	@php
			  		$contagem = 1;
			  	@endphp
			  	@for($i = 0; $i < count($lista_carteiras); $i++)
			  		@if(is_null($lista_carteiras[$i]->carteira_mestre_id))
			            <div class='col-lg-12 rounded' style='margin-top: 1%; background-color: #f5f8fa;'>
			            	<div class='row'>
			            		<div class='row col-lg-6' style='margin-top: 0.5%;'>
			            			<label for='numero' class='col-lg-3 col-form-label text-lg-right' style='margin-top: 0.5%;'>{{ 'Numero' }}</label>
		                            <div class='col-lg-2'>
		                                <input id='numero' type='text' class='form-control text-center' style='margin-top: 0.5%' name='numero' value="{{ $contagem }}" required autofocus disabled>
		                            </div>
			            		</div>
			            	</div>
			            	<div class='row'>
			            		<div class='row col-lg-6' style='margin-top: 0.5%;'>
			            			<label for='nome' class='col-lg-3 col-form-label text-lg-right' style='margin-top: 0.5%;'>{{ 'Nome da Carteira' }}</label>
		                            <div class='col-lg-9'>
		                                <input id='nome' type='text' class='form-control' style='margin-top: 0.5%' name='nome' value="{{ $lista_carteiras[$i]->nome }}" required autofocus disabled>
		                            </div>
			            		</div>
			            		<div class='row col-lg-6 text-lg-right' style='margin-top: 0.5%;'>
			            			<div class='col-lg-12 text-lg-right'>
		                                <a href='{{ url('/carteira/'.$lista_carteiras[$i]->id.'/edit') }}' title='Editar' style='cursor: pointer;' class='glyphicon glyphicon-edit text-dark'></a>  |  
										<a href='{{ url('/carteira/'.$lista_carteiras[$i]->id.'') }}' title='Detalhes' style='cursor: pointer;' class='glyphicon glyphicon-th text-dark'></a>  |  
										<a href='{{ url('/carteira/'.$lista_carteiras[$i]->id.'/desativar') }}' title='Apagar' id='deletar' style='cursor: pointer;' class='glyphicon glyphicon-trash text-dark'></a>
									</div>
	                            </div>
			            	</div>
			            	<div class='row'>
			            		<div class='col-lg-12'>
			            			<label for='descricao' class='col-lg-2 col-form-label text-lg-right' style='margin-top: 0.5%'>{{ 'Nome da Carteira' }}</label>
		                            <div class='col-lg-4'>
		                                <input id='nome' type='text' class='form-control' style='margin-top: 0.5%' name='nome' value="{{ $lista_carteiras[$i]->nome }}" required autofocus disabled>
		                            </div>
			            		</div>
			            	</div>
			        	</div>

			        	@php
					  		$contagem2 = 1;
					  	@endphp
						@for($j = 0; $j < count($lista_carteiras); $j++)
					  		@if($lista_carteiras[$i]->id == $lista_carteiras[$j]->carteira_mestre_id)
					  			<div class='col-lg-11 offset-lg-1 rounded' style='margin-top: 1%; background-color: #4CAF50;'>
					            	<div class='row'>
					            		<div class='row col-lg-6' style='margin-top: 0.5%;'>
					            			<label for='numero' class='col-lg-3 col-form-label text-lg-right' style='margin-top: 0.5%;'>{{ 'Numero' }}</label>
				                            <div class='col-lg-2'>
				                                <input id='numero' type='text' class='form-control text-center' style='margin-top: 0.5%' name='numero' value="{{ $contagem.'.'.$contagem2 }}" required autofocus disabled>
				                            </div>
					            		</div>
					            	</div>
					            	<div class='row'>
					            		<div class='row col-lg-6' style='margin-top: 0.5%;'>
					            			<label for='nome' class='col-lg-3 col-form-label text-lg-right' style='margin-top: 0.5%;'>{{ 'Nome da Carteira' }}</label>
				                            <div class='col-lg-9'>
				                                <input id='nome' type='text' class='form-control' style='margin-top: 0.5%' name='nome' value="{{ $lista_carteiras[$j]->nome }}" required autofocus disabled>
				                            </div>
					            		</div>
					            		<div class='row col-lg-6 text-lg-right' style='margin-top: 0.5%;'>
					            			<div class='col-lg-12 text-lg-right'>
				                                <a href='{{ url('/carteira/'.$lista_carteiras[$j]->id.'/edit') }}' title='Editar' style='cursor: pointer;' class='glyphicon glyphicon-edit text-dark'></a>  |  
												<a href='{{ url('/carteira/'.$lista_carteiras[$j]->id.'') }}' title='Detalhes' style='cursor: pointer;' class='glyphicon glyphicon-th text-dark'></a>  |  
												<a href='{{ url('/carteira/'.$lista_carteiras[$j]->id.'/desativar') }}' title='Apagar' id='deletar' style='cursor: pointer;' class='glyphicon glyphicon-trash text-dark'></a>
											</div>
			                            </div>
					            	</div>
					            	<div class='row'>
					            		<div class='col-lg-12'>
					            			<label for='descricao' class='col-lg-2 col-form-label text-lg-right' style='margin-top: 0.5%'>{{ 'Nome da Carteira' }}</label>
				                            <div class='col-lg-4'>
				                                <input id='nome' type='text' class='form-control' style='margin-top: 0.5%' name='nome' value="{{ $lista_carteiras[$j]->nome }}" required autofocus disabled>
				                            </div>
					            		</div>
					            	</div>
					        	</div>
					        	@php
									$contagem2++;
								@endphp
					  		@endif
					  	@endfor
					  	@php
							$contagem++;
						@endphp
						<div class='row' style='margin-bottom: 10%;'>
						</div>
		        	@endif
	        	@endfor
	        </div>
	    </div>
    </div>























































	<div class='row justify-content-center'>
		<div class='col-lg-12'>
	        <div class='col-lg-12' style='margin-top: 0.5%;'>
	            <div class='card col-lg-12'>
	                <div class='card-header row'>
						<div class='col-lg-6 rounded'>
			    			<h1>Lista de Carteiras</h1>
			    		</div>
			    		<div class='col-lg-2 offset-lg-4' style='margin-top: 0.3%;'>
			    			<a class='btn btn-digo' href='{{ url('/carteira/create') }}'>
			    				<span class='glyphicon glyphicon-plus'></span>
			    				Nova Carteira
			    			</a>
			    		</div>
	                </div>

	                <div class='card-body'>
	                	@php
					  		$contagem = 1;
					  	@endphp
					  	@for($i = 0; $i < count($lista_carteiras); $i++)
					  		@if(is_null($lista_carteiras[$i]->carteira_mestre_id))
			                	<div class='card col-lg-12' style='margin-bottom: 5%;'>
					                <div class='card-header row rounded' style='background-color: #4CAF50;'>
				                            <label for='nome' class='col-lg-2 col-form-label text-lg-right' style='margin-top: 0.5%'>{{ 'Nome da Carteira' }}</label>
				                            <div class='col-md-4'>
				                                <input id='nome' type='text' class='form-control' style='margin-top: 0.5%' name='nome' value="{{ $lista_carteiras[$i]->nome }}" required autofocus disabled>
				                            </div>

				                            <label for='balanco' class='col-lg-2 col-form-label text-lg-right' style='margin-top: 0.5%'>{{ 'Balanço' }}</label>
				                            <div class='col-md-4'>
				                                <input id='balanco' type='text' class='form-control' style='margin-top: 0.5%' name='balanco' value="{{ 'R$  000,00' }}" required autofocus disabled>
				                            </div>

				                            <label for='data_criacao' class='col-lg-2 col-form-label text-lg-right' style='margin-top: 0.5%'>{{ 'Data Criação' }}</label>
				                            <div class='col-md-4'>
				                                <input id='data_criacao' type='text' class='form-control' style='margin-top: 0.5%' name='data_criacao' value="{{ $lista_carteiras[$i]->created_at }}" required autofocus disabled>
				                            </div>

				                            <label for='data_alteracao' class='col-lg-2 col-form-label text-lg-right' style='margin-top: 0.5%'>{{ 'Data Alteração' }}</label>
				                            <div class='col-md-4'>
				                                <input id='data_alteracao' type='text' class='form-control' style='margin-top: 0.5%' name='data_alteracao' value="{{ $lista_carteiras[$i]->updated_at }}" required autofocus disabled>
				                            </div>

				                            <label for='descricao' class='col-lg-2 col-form-label text-lg-right' style='margin-top: 0.5%'>{{ 'Descrição' }}</label>
				                            <div class='col-md-10'>
				                                <input id='descricao' type='text' class='form-control' style='margin-top: 0.5%' name='descricao' value="{{ $lista_carteiras[$i]->descricao }}" required autofocus disabled>
				                            </div>

				                            <label for='acoes' class='col-lg-2 col-form-label text-lg-right' style='margin-top: 0.5%'>{{ 'Ações' }}</label>
				                            <div class='col-md-10'>
				                                <a href='{{ url('/carteira/'.$lista_carteiras[$i]->id.'/edit') }}' title='Editar' style='cursor: pointer;' class='glyphicon glyphicon-edit text-dark'></a>  |  
												<a href='{{ url('/carteira/'.$lista_carteiras[$i]->id.'') }}' title='Detalhes' style='cursor: pointer;' class='glyphicon glyphicon-th text-dark'></a>  |  
												<a href='{{ url('/carteira/'.$lista_carteiras[$i]->id.'/desativar') }}' title='Apagar' id='deletar' style='cursor: pointer;' class='glyphicon glyphicon-trash text-dark'></a>
				                            </div>
					                </div>

					                <div class='card-body' style='background-color: #CCDFCB;'>
					                	<label for='subcarteiras' class='col-lg-2 rounded' style='background-color: #393836;
  										color: gold; text-align: center; height: 50px; padding-top: 12px;'>{{ 'Subcarteiras' }}</label>
					                	@php
									  		$contagem2 = 1;
									  	@endphp
										@for($j = 0; $j < count($lista_carteiras); $j++)
									  		@if($lista_carteiras[$i]->id == $lista_carteiras[$j]->carteira_mestre_id)
										  		<div class='card col-lg-12 rounded' style='margin-bottom: 1%;'>
									                <div class='card-header row'>
								                            <label for='nome' class='col-lg-2 col-form-label text-lg-right'>{{ 'Nome da Carteira' }}</label>
								                            <div class='col-md-4'>
								                                <input id='nome' type='text' class='form-control' name='nome' value="{{ $lista_carteiras[$j]->nome }}" required autofocus disabled>
								                            </div>

								                            <label for='balanco' class='col-lg-2 col-form-label text-lg-right'>{{ 'Balanço' }}</label>
								                            <div class='col-md-4'>
								                                <input id='balanco' type='text' class='form-control' name='balanco' value="{{ 'R$  000,00' }}" required autofocus disabled>
								                            </div>

								                            <label for='data_criacao' class='col-lg-2 col-form-label text-lg-right'>{{ 'Data Criação' }}</label>
								                            <div class='col-md-4'>
								                                <input id='data_criacao' type='text' class='form-control' name='data_criacao' value="{{ $lista_carteiras[$j]->created_at }}" required autofocus disabled>
								                            </div>

								                            <label for='data_alteracao' class='col-lg-2 col-form-label text-lg-right'>{{ 'Data Alteração' }}</label>
								                            <div class='col-md-4'>
								                                <input id='data_alteracao' type='text' class='form-control' name='data_alteracao' value="{{ $lista_carteiras[$j]->updated_at }}" required autofocus disabled>
								                            </div>

								                            <label for='descricao' class='col-lg-2 col-form-label text-lg-right'>{{ 'Descrição' }}</label>
								                            <div class='col-md-10'>
								                                <input id='descricao' type='text' class='form-control' name='descricao' value="{{ $lista_carteiras[$j]->descricao }}" required autofocus disabled>
								                            </div>
									                </div>
									            </div>
									  		@endif
									  	@endfor
									</div>
					            </div>
					        @endif
			            @endfor
					</div>
	            </div>
	        </div>
	    </div>
    </div>



















































	<div class='row justify-content-center'>
		<div class='col-lg-12'>
	        <div class='col-lg-12' style='margin-top: 0.5%;'>
	            <div class='card col-lg-12'>
	                <div class='card-header row'>
						<div class='col-lg-6 rounded'>
			    			<h1>Lista de Carteiras</h1>
			    		</div>
			    		<div class='col-lg-2 offset-lg-4' style='margin-top: 0.3%;''>
			    			<a class='btn btn-digo' href='{{ url('/carteira/create') }}'>
			    				<span class='glyphicon glyphicon-plus'></span>
			    				Nova Carteira
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
							        <th>Data Registro</th>
							        <th>Data Alteração</th>
							        <th>Ativo</th>
							        <th>Ações</th>
							    </tr>
						    </thead>
						  <tbody>
						  	@if(count($lista_carteiras) < 1)
						  		<tr>
									<td colspan='8'>{{ "Não há registros no sistema!" }}</td>
								</tr>
						  	@else
							  	@php
							  		$contagem = 1;
							  	@endphp
							  	@for($i = 0; $i < count($lista_carteiras); $i++)
							  		@if(is_null($lista_carteiras[$i]->carteira_mestre_id))
										<tr>
											<td>{{ $contagem }}</td>
											<td>{{ $lista_carteiras[$i]->id }}</td>
											<td>{{ $lista_carteiras[$i]->nome }}</td>
											<td>{{ $lista_carteiras[$i]->descricao }}</td>
											<td>{{ $lista_carteiras[$i]->created_at }}</td>
											<td>{{ $lista_carteiras[$i]->updated_at }}</td>
											<td>{{ (($lista_carteiras[$i]->ativo == 1) ? 'Sim' : 'Não') }}</td>
											<td>
												<a href='{{ url('/carteira/'.$lista_carteiras[$i]->id.'/edit') }}' title='Editar' style='cursor: pointer;' class='glyphicon glyphicon-edit text-dark'></a>  |  
												<a href='{{ url('/carteira/'.$lista_carteiras[$i]->id.'') }}' title='Detalhes' style='cursor: pointer;' class='glyphicon glyphicon-th text-dark'></a>  |  
												<a href='{{ url('/carteira/'.$lista_carteiras[$i]->id.'/desativar') }}' title='Apagar' id='deletar' style='cursor: pointer;' class='glyphicon glyphicon-trash text-dark'></a>

												{{-- O DELETE Não SERÁ UTILIZADO, já que deve se manter dados no sistema. Para isso foi criado uma rota 'desativar', acima, para alterar o "ativo" 
												{{ Form::open(['url' => 'carteira/' . $lista_carteiras[$i]->id, 'class' => 'pull-right']) }}
													{{ Form::hidden('_method', 'DELETE') }}
													{{ Form::submit('Deletar', array('class' => 'btn btn-warning')) }}
												{{ Form::close() }}
												--}}
											</td>
										</tr>
										
										@php
									  		$contagem2 = 1;
									  	@endphp
										@for($j = 0; $j < count($lista_carteiras); $j++)
									  		@if($lista_carteiras[$i]->id == $lista_carteiras[$j]->carteira_mestre_id)
												<tr>
													<td>{{ $contagem.'.'.$contagem2 }}</td>
													<td>{{ $lista_carteiras[$j]->id }}</td>
													<td>{{ $lista_carteiras[$j]->nome }}</td>
													<td>{{ $lista_carteiras[$j]->descricao }}</td>
													<td>{{ $lista_carteiras[$j]->created_at }}</td>
													<td>{{ $lista_carteiras[$j]->updated_at }}</td>
													<td>{{ (($lista_carteiras[$j]->ativo == 1) ? 'Sim' : 'Não') }}</td>
													<td>
														<a href='{{ url('/carteira/'.$lista_carteiras[$j]->id.'/edit') }}' title='Editar' style='cursor: pointer;' class='glyphicon glyphicon-edit text-dark'></a>  |  
														<a href='{{ url('/carteira/'.$lista_carteiras[$j]->id.'') }}' title='Detalhes' style='cursor: pointer;' class='glyphicon glyphicon-th text-dark'></a>  |  
														<a href='{{ url('/carteira/'.$lista_carteiras[$j]->id.'/desativar') }}' title='Apagar' id='deletar' style='cursor: pointer;' class='glyphicon glyphicon-trash text-dark'></a>

														{{-- O DELETE Não SERÁ UTILIZADO, já que deve se manter dados no sistema. Para isso foi criado uma rota 'desativar', acima, para alterar o "ativo" 
														{{ Form::open(['url' => 'carteira/' . $lista_carteiras[$i]->id, 'class' => 'pull-right']) }}
															{{ Form::hidden('_method', 'DELETE') }}
															{{ Form::submit('Deletar', array('class' => 'btn btn-warning')) }}
														{{ Form::close() }}
														--}}
													</td>
												</tr>
												@php
													$contagem2++;
												@endphp
											@endif
										@endfor
										@php
											$contagem++;
										@endphp
									@endif
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