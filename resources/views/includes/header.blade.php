<header class="main-header">
	<!-- Logo -->
	<a href="index2.html" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>A</b>LT</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>Admin</b>LTE</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- Messages: style can be found in dropdown.less-->
				<li class="dropdown messages-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope-o"></i>
						<span class="label label-success">1</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">Você tem 1 mensagem</li>
						<li>
							<!-- inner menu: contains the actual data -->

							{{--------------- Mensagens ---------------}}

							<ul class="menu">
								<li><!-- start message -->
									<a href="#">
										<div class="pull-left">
											<img src="{{ asset('/img/user3-128x128.jpg')}}" class="img-circle" alt="User Image">
										</div>
										<h4>
											Support Team
											<small><i class="fa fa-clock-o"></i> 5 mins</small>
										</h4>
										<p>Why not buy a new awesome theme?</p>
									</a>
								</li><!-- end message -->
							</ul>
						</li>
						<li class="footer"><a href="#">Ver todas as mensagens</a></li>
					</ul>
				</li>
				<!-- Notifications: style can be found in dropdown.less -->
				<li class="dropdown notifications-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bell-o"></i>
						<span class="label label-warning">1</span>
					</a>

					{{--------------- Notificações  ---------------}}

					<ul class="dropdown-menu">
						<li class="header">Você tem 2 notificações</li>
						<li>
							<!-- inner menu: contains the actual data -->
							<ul class="menu">
								<li>
									<a href="#">
										<i class="fa fa-users text-aqua"></i> 5 novos membros
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
									</a>
								</li>
							</ul>
						</li>
						<li class="footer"><a href="#">Ver todas</a></li>
					</ul>
				</li>
				<!-- Tasks: style can be found in dropdown.less -->
				<li class="dropdown tasks-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-flag-o"></i>
						<span class="label label-danger">9</span>
					</a>

					{{----------------- Tarefas  -----------------}}

					<ul class="dropdown-menu">
						<li class="header">Você tem 1 tarefa</li>
						<li>
							<!-- inner menu: contains the actual data -->
							<ul class="menu">
								<li><!-- Task item -->
									<a href="#">
										<h3>
											Design some buttons
											<small class="pull-right">20%</small>
										</h3>
										<div class="progress xs">
											<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">20% Complete</span>
											</div>
										</div>
									</a>
								</li><!-- end task item -->
							</ul>
						</li>
						<li class="footer">
							<a href="#">Ver todas as tarefas</a>
						</li>
					</ul>
				</li>
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ asset($usuario->foto) }}" class="user-image" alt="User Image">
						<span class="hidden-xs">{{ $usuario->name }}</span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="{{ asset($usuario->foto) }}" class="img-circle" alt="User Image">
							<p>
								{{ $usuario->name }} - {{ $usuario->role->title }}
							</p>
						</li>

						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-right">
								<a href="{{ url('auth/logout') }}" class="btn btn-default btn-flat">Sair</a>
							</div>
						</li>
					</ul>
				</li>
				<!-- Control Sidebar Toggle Button -->
				<li>
					<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
				</li>
			</ul>
		</div>
	</nav>
</header>