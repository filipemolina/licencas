{{-------------------------- Sidebar  -----------------------------}}

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

      <li class="active treeview">
        <a href="#">
          <i class="fa fa-files-o"></i> <span>Licenças</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="index.html"><i class="fa fa-circle-o text-red"></i> Vencidas</a></li>
          <li><a href="index2.html"><i class="fa fa-circle-o text-green"></i> Renovadas</a></li>
          <li><a href="index2.html"><i class="fa fa-circle-o text-yellow"></i> Todas as Licenças</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-building-o"></i>
          <span>Empresas</span>
          <span class="label label-primary pull-right">4</span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
          <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Todas as Empresas</a></li>
        </ul>
      </li>

      <li>
        <a href="pages/widgets.html">
          <i class="fa fa-users"></i> <span>Usuários</span> <small class="label pull-right bg-green">new</small>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
          <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Todos os Usuários</a></li>
        </ul>
      </li>

      <li class="treeview">
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