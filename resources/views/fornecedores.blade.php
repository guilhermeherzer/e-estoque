@extends('layouts.layout')
@section('content')
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Fornecedores</h1>
		<a href="#" data-toggle="modal" data-target="#fornecedorModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Cadastrar Fornecedor</a>
	</div>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="20%">Nome</th>
							<th width="15%">Representante</th>
							<th width="15%">Contato 1</th>
							<th width="15%">Contato 2</th>
							<th width="30%">Endereço</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($data['fornecedores'] as $f)
						<tr>
							<td>{{ $f->nome }}</td>
							<td>{{ $f->representante }}</td>
							<td>{{ cel($f->contato_1) }}</td>
							<td>{{ cel($f->contato_2) }}</td>
							<td>{{ $f->endereço }}</td>
							<td>
								<a href="#" data-toggle="modal" data-target="#fornecedorModal{{ $f->id }}">
									<i class="far fa-edit"></i>
								</a>
								<a href="#" data-toggle="modal" data-target="#deleteModal{{ $f->id }}">
									<i class="far fa-trash-alt" style="color: red;"></i>
								</a>
							</td>
						</tr>
						<!-- Alteração de Produto Modal -->
						<div class="modal fade" id="fornecedorModal{{ $f->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Formulário de Alteração de Fornecedor</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form method="post" action="{{ route('fornecedores-alterar', ['id' => $f->id]) }}">
										@csrf
											<div class="modal-body">
												<div class="form-row mb-2">
													<div class="col-md-6">
														<label>Nome</label>
														<input name="nome" class="form-control form-control-sm" value="{{ $f->nome }}" required>
													</div>
												</div>
												<div class="form-row mb-2">
													<div class="col-md-6">
														<label>Representante</label>
														<input name="representante" class="form-control form-control-sm" value="{{ $f->representante }}" required>
													</div>
												</div>
												<div class="form-row mb-2">
													<div class="col-md-4">
														<label>Contato 1</label>
														<input name="contato_1" class="form-control form-control-sm" value="{{ $f->contato_1 }}" required>
													</div>
													<div class="col-md-4">
														<label>Contato 2</label>
														<input name="contato_2" class="form-control form-control-sm" value="{{ $f->contato_2 }}" required>
													</div>
												</div>
												<div class="form-row mb-2">
													<div class="col-md-12">
														<label>Endereço</label>
														<input name="endereço" class="form-control form-control-sm" value="{{ $f->endereço }}" required>
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
						<div class="modal fade" id="deleteModal{{ $f->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Deseja excluir o fornecedor {{ $f->nome }}?</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form method="post" action="{{ route('fornecedores-deletar', ['id' => $f->id]) }}">
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
<div class="modal fade" id="fornecedorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Formulário de Cadastro de Fornecedor</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form method="post" action="{{ route('fornecedores-cadastrar') }}">
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
							<label>Representante</label>
							<input name="representante" class="form-control form-control-sm" required>
						</div>
					</div>
					<div class="form-row mb-2">
						<div class="col-md-4">
							<label>Contato 1</label>
							<input name="contato_1" class="form-control form-control-sm" placeholder="(xx) xxxxx-xxxx" required>
						</div>
						<div class="col-md-4">
							<label>Contato 2</label>
							<input name="contato_2" class="form-control form-control-sm" placeholder="(xx) xxxxx-xxxx" required>
						</div>
					</div>
					<div class="form-row mb-2">
						<div class="col-md-12">
							<label>Endereço</label>
							<input name="endereço" class="form-control form-control-sm" required>
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