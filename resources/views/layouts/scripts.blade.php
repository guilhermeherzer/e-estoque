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
	<script type="text/javascript">
		function number_format(number, decimals, dec_point, thousands_sep) {
	  		// *     example: number_format(1234.56, 2, ',', ' ');
	  		// *     return: '1 234,56'
	  		number = (number + '').replace(',', '').replace('', '');
	  		var n = !isFinite(+number) ? 0 : +number,
	    	prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	    	sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
	    	dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
	    	s = '',
	    	toFixedFix = function(n, prec) {
	      		var k = Math.pow(10, prec);
	      		return '' + Math.round(n * k) / k;
	    	};
	  		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	  		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	  		if (s[0].length > 3) {
	    		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	  		}
	  		if ((s[1] || '').length < prec) {
	    		s[1] = s[1] || '';
	    		s[1] += new Array(prec - s[1].length + 1).join('0');
	  		}
	  		return s.join(dec);
		}

		Chart.defaults.global.tooltips.callbacks.label = function(tooltipItem, chart) {
			          		var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
			          		return datasetLabel + number_format(tooltipItem.yLabel);
			        	}

		Chart.scaleService.updateScaleDefaults('linear', {
	  						ticks: {
	    						callback: function(value, index, values) {
			            			return number_format(value);
			          			}
	  						}
						});
	</script>