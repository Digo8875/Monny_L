@extends('templates/geral_view')

@section('titulo')
	Criar/Editar Objetivo
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
		    			    {{((isset($obj->id)) ? 'Editar Objetivo' : 'Novo Objetivo')}}
		    			</h1>
		    		</div>
                </div>

                <div class='card-body'>
                    @if(!(isset($obj->id)))
					{{ Form::open(['url' => 'objetivo', 'method' => 'POST']) }}
					@else
					{{ Form::open(['url' => 'objetivo/'.$obj->id.'', 'method' => 'PATCH']) }}
					@endif

						@csrf

						{!! Form::token() !!}

						{{ Form::hidden('id', $obj->id) }}
						{{ Form::hidden('carteira_id', $obj->carteira_id) }}

						@if(!(isset($obj->id)))
							{{ Form::hidden('usuario_id', Auth::user()->id) }}
						@else
							{{ Form::hidden('usuario_id', $obj->usuario_id) }}
						@endif

					  	<div class='form-group row'>
					  		{{ Form::label('nome', 'Nome do Objetivo:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

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
					  		{{ Form::label('descricao', 'Descrição do Objetivo:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

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
					  		{{ Form::label('valor', 'Valor do Objetivo:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

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
							@php
								$checked = false;
								if($obj->ativo == 1 or !(isset($obj->id)))
									$checked = true;
							@endphp

					  		{{ Form::label('ativo', 'Objetivo Ativo', ['class' => 'col-md-4 col-form-label text-md-right']) }}

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