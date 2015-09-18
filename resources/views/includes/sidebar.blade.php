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
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Pesquisa...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
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
          <i class="fa fa-files-o"></i> <span>Licenças</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="index2.html"><i class="fa fa-circle-o text-yellow"></i> Todas as Licenças</a></li>
          <li class="active"><a href="index.html"><i class="fa fa-circle-o text-red"></i> Vencidas</a></li>
          <li><a href="index2.html"><i class="fa fa-circle-o text-green"></i> Renovadas</a></li>
        </ul>
      </li>

      <li class="{{ $class_empresas }} treeview">
        <a href="#">
          <i class="fa fa-building-o"></i>
          <span>Empresas</span>
          <span class="label label-primary pull-right">4</span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o text-blue"></i> Todas as Empresas</a></li>
          <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o text-green"></i> Cadastrar</a></li>
        </ul>
      </li>

      <li class="{{ $class_usuarios }} treeview">
        <a href="pages/widgets.html">
          <i class="fa fa-users"></i> <span>Usuários</span> <small class="label pull-right bg-green">new</small>
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

      <li class="{{ $class_opcoes }} treeview">
        <a href="#">
          <i class="fa fa-gears"></i>
          <span>Opções</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
      </li>

    </ul>

  </section>

  <!-- /.sidebar -->
</aside>