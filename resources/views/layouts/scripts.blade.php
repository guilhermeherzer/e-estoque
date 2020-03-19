	<!-- Bootstrap core JavaScript-->
	<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!-- Core plugin JavaScript-->
	<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
	<!-- Custom scripts for all pages-->
	<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
	<!-- Core plugin DataTables-->
	<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
	<!-- Page level plugins -->
	<script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
  	<!-- Page level custom scripts -->
  	<script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
	<!-- Mensagem Modal -->
	@if(Session::has('mensagem'))
		<script type="text/javascript">
			$(document).ready(function(){
				$('#mensagemModal').modal('show');
			});
		</script>
	@endif