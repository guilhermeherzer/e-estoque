@extends('layouts.layout')
@section('content')
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Produtos</h1>
		<a href="#" data-toggle="modal" data-target="#produtoModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Cadastrar Produto</a>
	</div>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="10%">Id</th>
							<th width="60%">Nome</th>
							<th width="10%">Preço Loja</th>
							<th width="10%">Preço App</th>
							<th width="10%"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($data['produtos'] as $p)
						<tr>
							<td>{{ $p->id }}</td>
							<td>{{ $p->nome }}</td>
							<td>R$ {{ n($p->preco_loja) }}</td>
							<td>R$ {{ n($p->preco_app) }}</td>
							<td>
								<a href="#" data-toggle="modal" data-target="#produtoModal{{ $p->id }}">
									<i class="far fa-edit"></i>
								</a>
								<a href="#" data-toggle="modal" data-target="#deleteModal{{ $p->id }}">
									<i class="far fa-trash-alt" style="color: red;"></i>
								</a>
							</td>
						</tr>
						<!-- Alteração de Produto Modal -->
						<div class="modal fade" id="produtoModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Formulário de Alteração de Produto</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form method="post" action="{{ route('produtos-alterar', ['id' => $p->id]) }}">
										@csrf
										<div class="modal-body">
											<div class="form-row mb-2">
												<div class="col-md-6">
													<label>Nome</label>
													<input name="nome" class="form-control form-control-sm" value="{{ $p->nome }}" autocomplete="false" required>
												</div>
											</div>
											<div class="form-row mb-2">
												<div class="col-md-4">
													<label>Preço Loja</label>
													<input name="preco_loja" class="form-control form-control-sm" value="{{ n($p->preco_loja) }}" autocomplete="false" required>
												</div>
												<div class="col-md-4">
													<label>Preço App</label>
													<input name="preco_app" class="form-control form-control-sm" value="{{ n($p->preco_app) }}" autocomplete="false" required>
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
						<div class="modal fade" id="deleteModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Deseja excluir o produto {{ $p->nome }}?</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form method="post" action="{{ route('produtos-deletar', ['id' => $p->id]) }}">
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
<div class="modal fade" id="produtoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Formulário de Cadastro de Produto</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form method="post" action="{{ route('produtos-cadastrar') }}">
				@csrf
				<div class="modal-body">
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Nome</label>
							<input name="nome" class="form-control form-control-sm" required>
						</div>
					</div>
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Preço Loja</label>
							<input name="preco_loja" class="form-control form-control-sm" required>
						</div>
						<div class="col-md-6">
							<label>Preço App</label>
							<input name="preco_app" class="form-control form-control-sm" required>
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
@endsection