@extends('layouts.layout')
@section('content')
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Entrada de Produtos</h1>
		<a href="#" data-toggle="modal" data-target="#entradaModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Cadastrar Entrada</a>
	</div>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="10%">Id</th>
							<th width="10%">Produto</th>
							<th width="10%">Quant.</th>
							<th width="10%">Valor Unit.</th>
							<th width="10%">Valor Total</th>
							<th width="20%">Fornecedor</th>
							<th width="10%">Data Solic.</th>
							<th width="10%">Data Entr.</th>
							<th width="10%"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($data['entradas'] as $e)
						<tr>
							<td>{{ $e->id }}</td>
							<td>{{ $e->produto }}</td>
							<td>{{ $e->quantidade }}</td>
							<td>{{ $e->valor_unit }}</td>
							<td>{{ $e->valor_total }}</td>
							<td>{{ $e->fornecedor }}</td>
							<td>{{ $e->data_solicitacao }}</td>
							<td>{{ $e->data_entrega }}</td>
							<td>
								<a href="#" data-toggle="modal" data-target="#entradaModal{{ $e->id }}">
									<i class="far fa-edit"></i>
								</a>
								<a href="#" data-toggle="modal" data-target="#deleteModal{{ $e->id }}">
									<i class="far fa-trash-alt" style="color: red;"></i>
								</a>
							</td>
						</tr>
						<!-- Alteração de Produto Modal -->
						<div class="modal fade" id="entradaModal{{ $e->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Formulário de Alteração de Produto</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form method="post" action="{{ route('produtos-alterar', ['id' => $e->id]) }}">
										@csrf
										<div class="modal-body">
											<div class="form-row mb-2">
												<div class="col-md-6">
													<label>Nome</label>
													<input name="nome" class="form-control form-control-sm" value="{{ $e->nome }}" autocomplete="false" required>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
											<button class="btn btn-primary">Alterar</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Deletar Produto Modal -->
						<div class="modal fade" id="deleteModal{{ $e->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Deseja excluir o produto {{ $e->nome }}?</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form method="post" action="{{ route('produtos-deletar', ['id' => $e->id]) }}">
										@csrf
										<div class="modal-body">
											<div class="form-row mb-2">
												<div class="col-md-6">
													<label>Senha</label>
													<input type="password" name="senha" class="form-control form-control-sm" autocomplete="false" required>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
											<button class="btn btn-primary">Sim</button>
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
<!-- Cadastro de Produto Modal -->
<div class="modal fade" id="entradaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Formulário de Cadastro de Produto</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form method="post" action="{{ route('entradas-cadastrar') }}">
				@csrf
				<div class="modal-body">
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Produto</label>
							<input name="produto" class="form-control form-control-sm" required>
						</div>
					</div>
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Quantidade</label>
							<input type="number" name="quantidade" id="quantidade" class="form-control form-control-sm" min="1" onchange="total()" required>
						</div>
					</div>
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Valor Unitário</label>
							<input name="valor_unit" id="valor_unit" class="form-control form-control-sm" onchange="total()" required>
						</div>
					</div>
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Valor Total</label>
							<input name="valor_total" id="valor_total" class="form-control form-control-sm" required>
						</div>
					</div>
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Fornecedor</label>
							<input name="fornecedor" class="form-control form-control-sm" required>
						</div>
					</div>
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Data de Solicitação</label>
							<input type="date" name="data_solicitacao" class="form-control form-control-sm" required>
						</div>
					</div>
					<div class="form-row mb-2">
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
<script type="text/javascript">
	function total(){
		var n1 = document.getElementById('quantidade').value;
		var n2 = document.getElementById('valor_unit').value;
		var result = n1 * n2.replace(',','.');
		document.getElementById('valor_total').value = result;
	}
</script>
@endsection