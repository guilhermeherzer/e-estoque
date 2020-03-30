@extends('layouts.layout')
@section('content')
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="d-none d-sm-inline-block h3 mb-0 text-gray-800">Marcas de Produtos</h1>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#marcaModal">
			<i class="fas fa-plus fa-sm text-white-50"></i> Cadastrar Marca
		</a>
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
							<th width="10%"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($data['marcas'] as $m)
						<tr>
							<td>{{ $m->id }}</td>
							<td>{{ $m->nome }}</td>
							<td>
								<a href="#" data-toggle="modal" data-target="#marcaModal{{ $m->id }}">
									<i class="far fa-edit"></i>
								</a>
								<a href="#" data-toggle="modal" data-target="#deleteModal{{ $m->id }}">
									<i class="far fa-trash-alt" style="color: red;"></i>
								</a>
							</td>
						</tr>
						<!-- Alteração de Produto Modal -->
						<div class="modal fade" id="marcaModal{{ $m->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Formulário de Alteração de Marcas de Produto</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form method="post" action="{{ route('marcas-produtos-alterar', ['id' => $m->id]) }}">
										@csrf
										<div class="modal-body">
											<div class="form-row">
												<div class="col-md-8">
													<div class="form-row mb-2">
														<div class="col-md-8">
															<label>Nome</label>
															<input name="nome" class="form-control form-control-sm" value="{{ $m->nome }}" autocomplete="false" required>
														</div>
													</div>
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
						<div class="modal fade" id="deleteModal{{ $m->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Deseja excluir a Marca {{ $m->nome }}?</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form method="post" action="{{ route('marcas-produtos-deletar', ['id' => $m->id]) }}">
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
<!-- Cadastro de Tipo de Produto Modal -->
<div class="modal fade" id="marcaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Formulário de Cadastro de Marca de Produto</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form method="post" action="{{ route('marcas-produtos-cadastrar') }}">
				@csrf
				<div class="modal-body">
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Nome</label>
							<input name="nome" class="form-control form-control-sm" required>
						</div>
					</div>
					<div class="form-row mb-2">
						<div class="col-md-10">
							<label>Imagem</label>
							<input type="file" name="img" id="img" class="form-control form-control-sm" required>
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