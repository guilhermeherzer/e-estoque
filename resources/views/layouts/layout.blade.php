<!DOCTYPE html>
<html lang="pt">
<head>
	@include('layouts.head')
</head>
<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<!-- Sidebar -->
		@include('layouts.sidebar')
		<!-- End of Sidebar -->
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				<!-- Topbar -->
				@include('layouts.topbar')
				<!-- End of Topbar -->
				<!-- Begin Page Content -->
				@yield('content')
				<!-- /.container-fluid -->
			</div>
			<!-- End of Main Content -->
			<!-- Footer -->
			@include('layouts.footer')
			<!-- End of Footer -->
		</div>
		<!-- End of Content Wrapper -->
	</div>
	<!-- End of Page Wrapper -->
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
	<!-- Modals-->
	@include('layouts.modals')
	@include('layouts.scripts')
</body>
</html>