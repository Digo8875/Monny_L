<!DOCTYPE html>
<html lang="pt-br">
    <head> 

        <meta charset="utf-8">
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.mask.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/popper.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/front.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/Main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/Init.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/Url.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/legend.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.pt-BR.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/chosen.jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/chosen.proto.js') }}"></script>

        <!-- Styles // Fonts // Images -->
        <link href="{{ asset('imagens/pageicon.jpg') }}" rel='shortcut icon'>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/glyphicons.css') }}" rel="stylesheet">
        <link href="{{ asset('css/site.css') }}" rel="stylesheet">
        <link href="{{ asset('css/default.css') }}" rel="stylesheet">

        <title>@yield('titulo')</title>

    </head>
    <body>
        <div class='div-mestre container-fluid'>
            <div class='topo rounded'>
                <div class='row col-lg-12 justify-content-center'>
                    <div class='img-logo col-lg-1'>
                        <div>
                            <img src="{{ asset('imagens/logo.jpg') }}" width='150' height='150' alt='' class='rounded'>
                        </div>
                    </div>
                    <div class='nav-site col-lg-8 offset-lg-1'>
                        <div class='row justify-content-center'>
                            @if(Auth::check())
                               <div class='navbar col-lg-12'>
                                    <ul class='rounded col-lg-12'>
                                        <li class='col-lg-6'><a href='#' class='rounded'>{{ Auth::user()->nome_pessoal }}</a></li>
                                        <li class='col-lg-2 offset-lg-2'><a href="{{ route('logout') }}" class='rounded' onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">Logout</a></li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <li class='col-lg-2'><a href="#" class='rounded'>Configurações</a></li>
                                    </ul>
                                </div>
                            @else
                                <div class='navbar col-lg-12'>
                                    <ul class='rounded col-lg-12'>
                                        <li class='col-lg-2 offset-lg-8'><a href="{{ route('login') }}" class='rounded'>Login</a></li>
                                        <li class='col-lg-2'><a href="{{ route('register') }}" class='rounded'>Cadastrar</a></li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class='row justify-content-center'>
                            <div class='navbar col-lg-12'>
                                <ul class='rounded col-lg-12'>
                                    <li class='col-lg-2'><a href='{{url('/')}}' class='active rounded'>Inicio</a></li>
                                    <li class='col-lg-2'><a href='#' class='rounded'>Sobre</a></li>
                                    <li class='col-lg-2'><a href='#' class='rounded'>Contato</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class='avisos col-lg-2 text-center'>
                        @if(Auth::guest())
                            Avisos
                        @endif

                        @if(Auth::check())
                            @if(is_null(Auth::user()->email_verified_at))
                                @if (session('resent'))
                                    <div class='alert alert-success col-lg-12' role='alert'>
                                        {{ __('Um novo link de validação foi enviado ao seu e-mail.') }}
                                    </div>
                                @else
                                <div class='alert alert-danger col-lg-12' role='alert'>
                                    {{ __('E-mail não Validado') }}. {{ __('Verifique em seu e-mail o link de ativação.') }} <a href="{{ route('verification.resend') }}" class='alert-link'>{{ __('Enviar novo Link') }}</a>.
                                </div>
                                @endif
                            @else
                                Nenhum Aviso!
                            @endif
                        @endif
                    </div>
                </div>
                                    <!--
                                    @if(Auth::check())
                                       Conteúdo protegido
                                    @endif

                                    @if(Auth::guest())
                                    Conteúdo para não logado(um form de login etc)
                                    @endif
                                    -->
                @if(Auth::check())
                    <div class='nav-usuario rounded col-lg-12'>
                        <nav class='navbar rounded col-lg-12'>
                            <div class='dropdown col-lg-2'>
                                <button class='btn btn-digo dropdown-toggle col-lg-8 offset-lg-2' type='button' id='dropdownMenuFuncionalidades' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Funcionalidades
                                </button>
                                <div class='dropdown-menu col-lg-12' aria-labelledby='dropdownMenuFuncionalidades'>
                                    <a class='dropdown-item rounded' href='{{ route('registro_financeiro.index') }}'>Registro Financeiro</a>
                                    <div class="dropdown-divider"></div>
                                    <a class='dropdown-item rounded' href='{{ route('carteira.index') }}'>Carteira</a>
                                    <div class="dropdown-divider"></div>
                                    <a class='dropdown-item rounded' href='{{ route('objetivo.index') }}'>Objetivos</a>
                                    <div class="dropdown-divider"></div>
                                    <a class='dropdown-item rounded' href='{{ route('divida.index') }}'>Dívidas</a>
                                    <div class="dropdown-divider"></div>
                                    <a class='dropdown-item rounded' href='{{ url('/venda') }}'>Agendamentos</a>
                                </div>
                            </div>

                            <div class='dropdown col-lg-2'>
                                <button class='btn btn-digo dropdown-toggle col-lg-8 offset-lg-2' type='button' id='dropdownMenuFuncionalidades' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Relatórios
                                </button>
                                <div class='dropdown-menu col-lg-12' aria-labelledby='dropdownMenuFuncionalidades'>
                                    <a class='dropdown-item rounded' href='{{ url('/relatorio_estoque') }}'>Balanços</a>
                                    <div class="dropdown-divider"></div>
                                    <a class='dropdown-item rounded' href='{{ url('/relatorio_venda') }}'>Categorias</a>
                                    <div class="dropdown-divider"></div>
                                    <a class='dropdown-item rounded' href='{{ url('/venda') }}'>Objetivos</a>
                                    <div class="dropdown-divider"></div>
                                    <a class='dropdown-item rounded' href='{{ url('/venda') }}'>Dívidas</a>
                                    <div class="dropdown-divider"></div>
                                    <a class='dropdown-item rounded' href='{{ url('/venda') }}'>Doações</a>
                                </div>
                            </div>

                            <div class='dropdown col-lg-2'>
                                <button class='btn btn-digo dropdown-toggle col-lg-8 offset-lg-2' type='button' id='dropdownMenuFuncionalidades' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Administração
                                </button>
                                <div class='dropdown-menu col-lg-12' aria-labelledby='dropdownMenuFuncionalidades'>
                                    <a class='dropdown-item rounded' href='{{ route('categoria.index') }}'>Categorias</a>
                                    <div class="dropdown-divider"></div>
                                    <a class='dropdown-item rounded' href='{{ route('sub_categoria.index') }}'>Subcategorias</a>
                                    <div class="dropdown-divider"></div>
                                    <a class='dropdown-item rounded' href='{{ route('tipo_dinheiro.index') }}'>Moeda</a>
                                    <div class="dropdown-divider"></div>
                                    <a class='dropdown-item rounded' href='{{ route('responsavel.index') }}'>Responsáveis</a>
                                </div>
                            </div>

                            <div class='dropdown col-lg-6'>
                            </div>
                        </nav>
                    </div>
                @endif
            </div>

            <div class='conteudo rounded'>
                @yield('conteudo')
            </div>

            <div class='rodape container-fluid'>
                <div class='copylefts rounded text-center col-lg-12'>
                    <p> Copyleft - 2019 - BY Rodrigo Cândido </p>
                </div>
            </div>
        </div>
    </body> 
</html>