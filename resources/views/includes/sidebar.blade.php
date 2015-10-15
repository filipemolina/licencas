<?php

  // Definir qual dos links da sidebar irá aparecer como ativo

  $class_painel = '';
  $class_licencas = '';
  $class_empresas = '';
  $class_usuarios = '';
  $class_opcoes = '';

  switch($padrao['secao']){
    case "Painel":
      $class_painel = 'active';
      break;

    case "Licenças":
      $class_licencas = 'active';
      break;

    case "Tipos de Licença":
      $class_licencas = 'active';
      break;

    case "Empresas":
      $class_empresas = 'active';
      break;

    case "Usuários";
      $class_usuarios = 'active';
      break;

    case "Opções":
      $class_opcoes = 'active';
      break;
  }

  // Definir qual dos sub-links irá aparecer como ativo

?>

{{-------------------------- Sidebar  -----------------------------}}

<!-- URL PROGRAMA {{ $padrao['url'] }} -->

<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset($usuario->foto) }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ $usuario->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form -->
    <form action="{{ route('pages.busca') }}" method="POST" class="sidebar-form">

      {!! csrf_field() !!}

      <div class="input-group">
        <input type="text" name="termo" class="form-control" placeholder="Pesquisa...">
        <span class="input-group-btn">
          <button type="submit" name="btn-enviar" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <!-- /.search form -->

    <ul class="sidebar-menu">
      <li class="header">NAVEGAÇÃO PRINCIPAL</li>

      <li class="{{ Request::is('/') ? 'active' : '' }} treeview">
        <a href="{{ url('/') }}">
          <i class="fa fa-dashboard"></i>
          <span>Painel Principal</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
      </li>

      <li class="{{ $class_licencas }} treeview">
        <a href="#">
          <i class="fa fa-files-o"></i> <span>Licenças</span> 

          {{-- Mostrar a quantidade de licenças vencidas e à vencer --}}

          @if( (count($qtds['avencer']) > 0) && (count($qtds['vencidas'] > 0)) )

            <small class="label pull-right bg-red">{{ $qtds['avencer'] + $qtds['vencidas'] }}</small>

          @else

            {{-- Caso não haja nenhuma, mostrar a seta --}}

            <i class="fa fa-angle-left pull-right"></i>

          @endif

        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('licencas') ? 'active' : '' }}">
            <a href="{{ route('licencas.index') }}"><i class="fa fa-circle-o text-blue"></i> Todas</a>
          </li>
          <li class="{{ Request::is('licencas/avencer') ? 'active' : '' }}">

            {{-- Caso hajam licenças à vencer, mostrar o badge --}}

            @if(count($qtds['avencer']) > 0)

              <span class="label pull-right bg-yellow">{{ $qtds['avencer'] }}</span>              

            @endif

            <a href="{{ route('licencas.avencer') }}"><i class="fa fa-circle-o text-yellow"></i> À Vencer</a>
          </li>
          <li class="{{ Request::is('licencas/vencidas') ? 'active' : '' }}">

            {{-- Caso hajam licenças vencidas, mostrar o badge --}}

            @if(count($qtds['vencidas']) > 0)

              <span class="label pull-right bg-red">{{ $qtds['vencidas'] }}</span>              

            @endif

            <a href="{{ route('licencas.vencidas') }}"><i class="fa fa-circle-o text-red"></i> Vencidas</a>
          </li>
          <li class="{{ Request::is('licencas/create') ? 'active' : '' }}">
            <a href="{{ route('licencas.create') }}"><i class="fa fa-circle-o text-green"></i>Cadastrar</a>
          </li>

          {{-- Tipos de Licenças --}}

          <li class="{{ Request::is('tipos') ? 'active' : '' }}">
            <a href="#"><i class="fa fa-circle-o"></i>Tipos</a>

            <ul class="treeview-menu">
              <li class="{{ Request::is('tipos') ? 'active' : '' }}">
                <a href="{{ route('tipos.index') }}"><i class="fa fa-circle-o text-blue"></i>Todos</a>
              </li>
              <li class="{{ Request::is('tipos/create') ? 'active' : '' }}">
                <a href="{{ route('tipos.create') }}"><i class="fa fa-circle-o text-blue"></i>Cadastrar</a>
              </li>
            </ul>

          </li>
        </ul>
      </li>

      <li class="{{ $class_empresas }} treeview">
        <a href="#">
          <i class="fa fa-building-o"></i>
          <span>Empresas</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('empresas') ? 'active' : '' }}">
            <a href="{{ route('empresas.index') }}"><i class="fa fa-circle-o text-blue"></i> Todas as Empresas</a>
          </li>
          <li class="{{ Request::is('empresas/create') ? 'active' : '' }}">
            <a href="{{ route('empresas.create') }}"><i class="fa fa-circle-o text-green"></i> Cadastrar</a>
          </li>
        </ul>
      </li>

      {{-- Testar se o usuário atual possui permissões de alteração de usuários --}}

      @can('controlar-usuarios')

        <li class="{{ $class_usuarios }} treeview">
          <a href="pages/widgets.html">
            <i class="fa fa-users"></i> <span>Usuários</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            
            <li class="{{ Request::is('users') ? 'active' : '' }}">
              <a href="{{ route('users.index') }}">
                <i class="fa fa-circle-o text-blue"></i> 
                Todos os Usuários
              </a>
            </li>

            <li class="{{ Request::is('users/create') ? 'active' : '' }}">
              <a href="{{ route('users.create') }}">
                <i class="fa fa-circle-o text-green"></i> 
                Cadastrar
              </a>
            </li>

          </ul>
        </li>

      @endcan

      <li class="{{ $class_opcoes }} treeview">
        <a href="#">
          <i class="fa fa-gears"></i>
          <span>Opções</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          
          <li class="{{ Request::is('alterarfoto') ? 'active' : '' }}">
            <a href="{{ route('users.alterarfoto') }}">
              <i class="fa fa-circle-o text-blue"></i>
              Alterar Foto
            </a>
          </li>

          <li class="{{ Request::is('mudarsenha') ? 'active' : '' }}">
            <a href="{{ route('users.mudarsenha') }}">
              <i class="fa fa-circle-o text-blue"></i>
              Mudar Senha
            </a>
          </li>

        </ul>
      </li>

    </ul>

  </section>

  <!-- /.sidebar -->
</aside>