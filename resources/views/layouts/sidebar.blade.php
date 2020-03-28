		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
				<div class="sidebar-brand-icon">
					<img src="{{ asset('assets/img/logo.png') }}" style="width: 50px;">
				</div>
				<div class="sidebar-brand-text mx-3">e-Com</div>
			</a>
			<!-- Divider -->
			<hr class="sidebar-divider my-0">
			<!-- Nav Item - Dashboard -->
			<li class="nav-item active">
				<a class="nav-link" href="{{ route('home') }}">
					<i class="fas fa-chart-line"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<!-- Divider -->
			<hr class="sidebar-divider">
			<!-- Heading -->
			<div class="sidebar-heading">
				Produtos
			</div>
			<!-- Nav Item - Charts -->
			<li class="nav-item">
				<a class="nav-link" href="{{ route('produtos') }}">
					<i class="fas fa-chevron-circle-right"></i>
					<span>Produtos</span>
				</a>
				<a class="nav-link" href="{{ route('produtos') }}">
					<i class="fas fa-chevron-circle-right"></i>
					<span>Categorias</span>
				</a>
				<a class="nav-link" href="{{ route('produtos') }}">
					<i class="fas fa-chevron-circle-right"></i>
					<span>Marcas</span>
				</a>
			</li>
			<!-- Divider -->
			<hr class="sidebar-divider">
			<!-- Heading -->
			<div class="sidebar-heading">
				Fornecedores
			</div>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('fornecedores') }}">
					<i class="fas fa-chevron-circle-right"></i>
					<span>Fornecedores</span>
				</a>
			</li>
			<!-- Divider -->
			<hr class="sidebar-divider">
			<!-- Heading -->
			<div class="sidebar-heading">
				Entradas e Saidas
			</div>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('entradas') }}">
					<i class="fas fa-chevron-circle-right"></i>
					<span>Entradas</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('saidas') }}">
					<i class="fas fa-chevron-circle-right"></i>
					<span>Saidas</span>
				</a>
			</li>
			<!-- Divider -->
			<hr class="sidebar-divider">
			<!-- Heading -->
			<div class="sidebar-heading">
				Estoque
			</div>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('estoque') }}">
					<i class="fas fa-chevron-circle-right"></i>
					<span>Estoque</span>
				</a>
			</li>
			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">
			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>