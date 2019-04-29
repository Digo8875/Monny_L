@extends('templates/geral_view')

@section('titulo')
	Criar/Editar Carteira
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
		    			    {{((isset($obj->id)) ? 'Editar Carteira' : 'Nova Carteira')}}
		    			</h1>
		    		</div>
                </div>

                <div class='card-body'>
                    @if(!(isset($obj->id)))
					{{ Form::open(['url' => 'carteira', 'method' => 'POST']) }}
					@else
					{{ Form::open(['url' => 'carteira/'.$obj->id.'', 'method' => 'PATCH']) }}
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
					  		{{ Form::label('nome', 'Nome da Carteira:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

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
					  		{{ Form::label('descricao', 'Descrição da Carteira:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

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
					  		{{ Form::label('carteira_mestre_id', 'Selecione a Carteira Mestre:', ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class='col-md-6'>
                            	{{ Form::select('carteira_mestre_id', ['0' => 'É uma carteira raiz'] + $lista_carteiras_mestre, $obj->carteira_mestre_id, ['class' => 'form-control', 'id' => 'carteira_mestre_id']) }}

                            	@if($errors->has('carteira_mestre_id'))
									<span class='alert alert-danger'>
										<strong>{{ $errors->first('carteira_mestre_id') }}</strong>
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

					  		{{ Form::label('ativo', 'Carteira Ativa', ['class' => 'col-md-4 col-form-label text-md-right']) }}

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