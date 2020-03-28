@extends('layouts.layout')
@section('content')
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Estoque</h1>
	</div>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="35%">Produto</th>
							<th width="20%">Entradas</th>
							<th width="20%">Saídas</th>
							<th width="20%">Estoque</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($data['estoque'] as $e)
						<tr>
							<td>{{ $e['produto'] }}</td>
							<td>{{ $e['entradas'] }}</td>
							<td>{{ $e['saidas'] }}</td>
							<td>{{ $e['entradas'] - $e['saidas'] }}</td>
							<td>
								<a href="#" data-toggle="modal" data-target="#entradaModal{{ $e['id'] }}">
									<i class="far fa-edit"></i>
								</a>
							</td>
						</tr>
						<!-- Entrada de Produto Modal -->
						<div class="modal fade" id="entradaModal{{ $e['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Dar Entrada no Produto {{ $e['produto'] }}</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form method="post" action="{{ route('entradas-cadastrar') }}">
										@csrf
										<div class="modal-body">
											<input name="url" value="{{ Request::path() }}" hidden="true">
											<input name="produto" value="{{ $e['id'] }}" hidden="true">
											<div class="form-row mb-2">
												<div class="col-md-6">
													<label>Quantidade</label>
													<input type="number" name="quantidade" id="quantidade{{ $e['id'] }}" class="form-control form-control-sm" min="1" onchange="total('{{ $e['id'] }}')" required>
												</div>
											</div>
											<div class="form-row mb-2">
												<div class="col-md-6">
													<label>Valor Unitário</label>
													<input name="valor_unit" id="valor_unit{{ $e['id'] }}" class="form-control form-control-sm" onchange="total('{{ $e['id'] }}')" required>
												</div>
												<div class="col-md-6">
													<label>Valor Total</label>
													<input name="valor_total" id="valor_total{{ $e['id'] }}" class="form-control form-control-sm" required>
												</div>
											</div>
											<div class="form-row mb-2">
												<div class="col-md-6">
													<label>Fornecedor</label>
													<select name="fornecedor" class="form-control form-control-sm" required>
														<option value=""></option>
														@foreach($data['fornecedores'] as $f)
															<option value="{{ $f->id }}">{{ $f->nome }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="form-row mb-2">
												<div class="col-md-6">
													<label>Data de Solicitação</label>
													<input type="date" name="data_solicitacao" class="form-control form-control-sm" required>
												</div>
												<div class="col-md-6">
													<label>Data de Entrega</label>
													<input type="date" name="data_entrega" class="form-control form-control-sm" required>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
											<button class="btn btn-primary">Cadastrar</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function total(id){
		var n1 = document.getElementById('quantidade'+id).value;
		var n2 = document.getElementById('valor_unit'+id).value;
		var n3 = n1 * n2.replace(',','.');
		var result = n3.toFixed(2).toString().replace('.',',');
		document.getElementById('valor_total'+id).value = result;
	}
</script>
@endsection