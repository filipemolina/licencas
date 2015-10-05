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
				<!-- Notifications: style can be found in dropdown.less -->
				<li class="dropdown notifications-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bell-o"></i>
						
						@if($qtds['avencer'] > 0)

							<span class="label label-warning">{{ $qtds['avencer'] }}</span>

						@endif

					</a>

					{{--------------- Licenças à Vencer  ---------------}}

					<ul class="dropdown-menu">
	
						@if($qtds['avencer'] < 1)

							<li class="header">Nenhuma licença à vencer.</li>

						@elseif($qtds['avencer'] == 1)

							<li class="header">Existe 1 licença à vencer.</li>

						@elseif($qtds['avencer'] > 1)

							<li class="header">Existem {{ $qtds['avencer'] }} licenças à vencer.</li>

						@endif

						<li>
							<!-- inner menu: contains the actual data -->
							<ul class="menu">
								
								@foreach($qtds['avencer_lista'] as $avencer_lista)
									
									<li>
										<a href="#">
											<i class="fa fa-warning text-yellow"></i> {{ $avencer_lista->empresa->razao_social }}
										</a>
									</li>

								@endforeach

							</ul>
						</li>
						<li class="footer"><a href="#">Ver todas</a></li>
					</ul>
				</li>
				<!-- Tasks: style can be found in dropdown.less -->
				<li class="dropdown tasks-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-flag-o"></i>

						@if($qtds['vencidas'] > 0)

							<span class="label label-danger">{{ $qtds['vencidas'] }}</span>
		
						@endif
					</a>

					{{----------------- Tarefas  -----------------}}

					<ul class="dropdown-menu">
						@if($qtds['vencidas'] < 1)

							<li class="header">Nenhuma licença vencida</li>

						@elseif($qtds['vencidas'] == 1)

							<li class="header">Existe 1 licença vencida</li>

						@elseif($qtds['vencidas'] > 1)

							<li class="header">Existem {{ $qtds['vencidas'] }} licenças vencidas</li>

						@endif
						<li>
							<!-- inner menu: contains the actual data -->
							<ul class="menu">
								@foreach($qtds['vencidas_lista'] as $vencidas_lista)
									
									<li>
										<a href="#">
											<i class="fa fa-warning text-yellow"></i> {{ $vencidas_lista->empresa->razao_social }}
										</a>
									</li>

								@endforeach
							</ul>
						</li>
						<li class="footer">
							<a href="#">Ver todas</a>
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