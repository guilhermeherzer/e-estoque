		<?php
			$itens = file_get_contents('C:/Users/guilh/e-com/resources/views/layouts/sidebar.json');
			$menus = json_decode($itens);
		?>
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion fixed-top" id="accordionSidebar">
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
			@foreach($menus->menus as $m)
				<!-- Heading -->
				<div class="sidebar-heading">
					{{ $m->span }}
				</div>
					@foreach($m->sub as $s)
						<li class="nav-item {{ Request::is($s->href) ? 'active' : '' }}">
							<a class="nav-link" href="{{ route($s->href) }}">
								<i class="fas fa-chevron-circle-right"></i>
								<span>{{ $s->span }}</span>
							</a>
						</li>
					@endforeach
				<!-- Divider -->
				<hr class="sidebar-divider">
			@endforeach
			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>