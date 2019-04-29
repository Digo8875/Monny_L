@extends('templates/geral_view')

@section('titulo')
	Criar/Editar Registro Finenceiro
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
		    			    {{((isset($obj->id)) ? 'Editar Registro Financeiro' : 'Novo Registro Financeiro')}}
		    			</h1>
		    		</div>
                </div>

                <div class='card-body'>
                    @if(!(isset($obj->id)))
					{{ Form::open(['url' => 'registro_financeiro', 'method' => 'POST']) }}
					@else
					{{ Form::open(['url' => 'registro_financeiro/'.$obj->id.'', 'method' => 'PATCH']) }}
					@endif

						@csrf

						{!! Form::token() !!}

						{{ Form::hidden('id', $obj->id) }}

						@if(!(isset($obj->id)))
							{{ Form::hidden('usuario_id', Auth::user()->id) }}
						@else
							{{ Form::hidden('usuario_id', $obj->usuario_id) }}
						@endif

					  	<div class='form-group row'>
					  		{{ Form::label('nome', 'Nome do Registro Financeiro:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class='col-md-6'>
                            	{{ Form::text('nome', $obj->nome, ['class' => 'form-control']) }}

                            	@if($errors->has('nome'))
									<span class='alert alert-danger'>
										<strong>{{ $errors->first('nome') }}</strong>
									</span>
								@endif
                            </div>
                        </div>

                        <div class='form-group row'>
					  		{{ Form::label('descricao', 'Descrição do Registro Financeiro:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class='col-md-6'>
                            	{{ Form::text('descricao', $obj->descricao, ['class' => 'form-control']) }}

                            	@if($errors->has('descricao'))
									<span class='alert alert-danger'>
										<strong>{{ $errors->first('descricao') }}</strong>
									</span>
								@endif
                            </div>
                        </div>

                        <div class='form-group row'>
					  		{{ Form::label('tipo_registro_financeiro', 'Selecione o Tipo do Registro:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class='col-md-6'>
                            	{{ Form::select('tipo_registro_financeiro', ['' => 'Selecione', '1' => 'Entrada', '2' => 'Saída'], $obj->tipo, ['class' => 'form-control', 'id' => 'tipo_registro_financeiro']) }}

                            	@if($errors->has('tipo_registro_financeiro'))
									<span class='alert alert-danger'>
										<strong>{{ $errors->first('tipo_registro_financeiro') }}</strong>
									</span>
								@endif
                            </div>
                        </div>

                        <div class='form-group row'>
					  		{{ Form::label('data_pagamento', 'Selecione a Data do Pagamento:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class='col-md-6'>
                            	{{ Form::date('data_pagamento', $obj->data_pagamento, ['class'=>'form-control']) }}

                            	@if($errors->has('data_pagamento'))
									<span class='alert alert-danger'>
										<strong>{{ $errors->first('data_pagamento') }}</strong>
									</span>
								@endif
                            </div>
                        </div>

                        <div class='form-group row'>
					  		{{ Form::label('tipo_dinheiro_id', 'Selecione a Moeda:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class='col-md-6'>
                            	{{ Form::select('tipo_dinheiro_id', ['' => 'Selecione'] + $lista_tipo_dinheiros, $obj->tipo_dinheiro_id, ['class' => 'form-control', 'id' => 'tipo_dinheiro_id']) }}

                            	@if($errors->has('tipo_dinheiro_id'))
									<span class='alert alert-danger'>
										<strong>{{ $errors->first('tipo_dinheiro_id') }}</strong>
									</span>
								@endif
                            </div>
                        </div>

                        <div class='form-group row'>
					  		{{ Form::label('valor', 'Valor do Registro:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class='col-md-6'>
                            	{{ Form::number('valor', $obj->valor, ['class' => 'form-control' ,'step'=>'any']) }}

                            	@if($errors->has('valor'))
									<span class='alert alert-danger'>
										<strong>{{ $errors->first('valor') }}</strong>
									</span>
								@endif
                            </div>
                        </div>

                        <div class='form-group row'>
					  		{{ Form::label('sub_categoria_id', 'Selecione a Subcategoria [Categoria]:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class='col-md-6'>
                            	{{ Form::select('sub_categoria_id', ['' => 'Selecione'] + $lista_sub_categorias, $obj->sub_categoria_id, ['class' => 'form-control', 'id' => 'sub_categoria_id']) }}

                            	@if($errors->has('sub_categoria_id'))
									<span class='alert alert-danger'>
										<strong>{{ $errors->first('sub_categoria_id') }}</strong>
									</span>
								@endif
                            </div>
                        </div>

                        <div class='form-group row'>
					  		{{ Form::label('responsavel_id', 'Selecione o Responsável:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class='col-md-6'>
                            	{{ Form::select('responsavel_id', ['0' => 'Ninguém'] + $lista_responsaveis, $obj->responsavel_id, ['class' => 'form-control', 'id' => 'responsavel_id']) }}

                            	@if($errors->has('responsavel_id'))
									<span class='alert alert-danger'>
										<strong>{{ $errors->first('responsavel_id') }}</strong>
									</span>
								@endif
                            </div>
                        </div>

                        <div class='form-group row'>
					  		{{ Form::label('doacao', 'Doação:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class='col-md-6'>
                            	{{ Form::select('doacao', ['0' => 'Não', '1' => 'Sim'], $obj->doacao, ['class' => 'form-control', 'id' => 'doacao']) }}

                            	@if($errors->has('doacao'))
									<span class='alert alert-danger'>
										<strong>{{ $errors->first('doacao') }}</strong>
									</span>
								@endif
                            </div>
                        </div>

						<div class='form-group row'>
							@php
								$checked = false;
								if($obj->ativo == 1 or !(isset($obj->id)))
									$checked = true;
							@endphp

					  		{{ Form::label('ativo', 'Registro Financeiro Ativo', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class='col-md-6'>
                            	<div class='material-switch'>
		                            {{ Form::checkbox('ativo', Input::old('ativo'),  $checked) }}
		                            <label for='ativo' class='label-success'></label>
		                        </div>
                            </div>
                        </div>

                        <div class='form-group row justify-content-center'>
							@if(!isset($obj->id))
								{!! Form::submit('Cadastrar', ['class' => 'btn btn-digo btn-block col-lg-2']) !!}
							@else
								{!! Form::submit('Atualizar', ['class' => 'btn btn-digo btn-block col-lg-2']) !!}
							@endif
						</div>
					{{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop