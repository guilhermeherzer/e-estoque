@extends('layouts.layout')
@section('content')
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Saida de Produtos</h1>
		<a href="#" data-toggle="modal" data-target="#saidaModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Cadastrar Saida</a>
	</div>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="5%">Id</th>
							<th width="25%">Produto</th>
							<th width="5%">Quant.</th>
							<th width="10%">Data Saida</th>
							<th width="10%">Tipo</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($data['saidas'] as $s)
						<tr>
							<td>{{ $s->id }}</td>
							<td>{{ $s->produto }}</td>
							<td>{{ $s->quantidade }}</td>
							<td>{{ date('d/m/Y H:i', strtotime($s->data_saida)) }}</td>
							<td>{{ $s->tipo }}</td>
							<td>
								<a href="#" data-toggle="modal" data-target="#saidaModal{{ $s->id }}">
									<i class="far fa-edit"></i>
								</a>
								<a href="#" data-toggle="modal" data-target="#deleteModal{{ $s->id }}">
									<i class="far fa-trash-alt" style="color: red;"></i>
								</a>
							</td>
						</tr>
						<!-- Saida de Produto Modal -->
						<div class="modal fade" id="saidaModal{{ $s->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Formulário de Saida de Produto</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form method="post" action="{{ route('saidas-alterar', ['id' => $s->id]) }}">
										@csrf
										<div class="modal-body">
											<div class="form-row mb-2">
												<div class="col-md-6">
													<label>Tipo</label>
													<select name="tipo" id="tipo{{ $s->id }}" class="form-control form-control-sm" onchange="mudarTipo('{{ $s->id }}')" required>
														@foreach($data['tipos'] as $t)
															<option @if($t->nome == $s->tipo) selected @endif value="{{ $t->id }}">{{ $t->nome }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="form-row mb-2">
												<div class="col-md-6">
													<label>Produto</label>
													<select name="produto" id="produto{{ $s->id }}" class="form-control form-control-sm" onchange="preencheCidades(this.value, '{{ $s->id }}')" required>
														@foreach($data['produtos'] as $p)
															<option @if($p->nome == $s->produto) selected @endif value="{{ $p->id }}">{{ $p->nome }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="form-row mb-2">
												<div class="col-md-6">
													<label>Quantidade</label>
													<input type="number" name="quantidade" id="quantidade{{ $s->id }}" class="form-control form-control-sm" min="1" value="{{ $s->quantidade }}" onchange="valores('{{ $s->id }}');" required>
												</div>
											</div>
											<div class="form-row mb-2">
												<div class="col-md-6">
													<label>Preço Unit.</label>
													<input name="preco_unit" id="preco_unit{{ $s->id }}" class="form-control form-control-sm" value="{{ n($s->preco_unit) }}" required>
												</div>
												<div class="col-md-6">
													<label>Preço Total</label>
													<input name="preco_total" id="preco_total{{ $s->id }}" class="form-control form-control-sm" value="{{ n($s->preco_total) }}" required>
												</div>
											</div>
											<div class="form-row mb-2">
												<div class="col-md-6">
													<label>Data de Saida</label>
													<input type="datetime-local" name="data_saida" class="form-control form-control-sm" value="{{ date('Y-m-d\TH:i:s', strtotime($s->data_saida)) }}" required>
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
						<div class="modal fade" id="deleteModal{{ $s->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Deseja dar saida no produto {{ $s->produto }}?</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<form method="post" action="{{ route('saidas-deletar', ['id' => $s->id]) }}">
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
<!-- Saida de Produto Modal -->
<div class="modal fade" id="saidaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Formulário de Saida de Produto</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form method="post" action="{{ route('saidas-cadastrar') }}">
				@csrf
				<div class="modal-body">
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Tipo</label>
							<select name="tipo" id="tipo" class="form-control form-control-sm" onchange="mudarTipo('')" required>
								<option value=""></option>
								@foreach($data['tipos'] as $t)
									<option value="{{ $t->id }}">{{ $t->nome }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Produto</label>
							<select name="produto" id="produto" class="form-control form-control-sm" onchange="preencheCidades(this.value, '')" required>
								<option value=""></option>
								@foreach($data['produtos'] as $p)
									<option value="{{ $p->id }}">{{ $p->nome }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Quantidade</label>
							<input type="number" name="quantidade" id="quantidade" class="form-control form-control-sm" min="1" onchange="valores('');" required>
						</div>
					</div>
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Preço Unit.</label>
							<input name="preco_unit" id="preco_unit" class="form-control form-control-sm" required>
						</div>
						<div class="col-md-6">
							<label>Preço Total</label>
							<input name="preco_total" id="preco_total" class="form-control form-control-sm" required>
						</div>
					</div>
					<div class="form-row mb-2">
						<div class="col-md-6">
							<label>Data de Saida</label>
							<input type="datetime-local" name="data_saida" class="form-control form-control-sm" required>
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
	function valores(id){
		var unit = document.getElementById('preco_unit'+id).value;
		var qnt = document.getElementById('quantidade'+id).value;
		var total = unit.replace(',','.') * qnt;
		document.getElementById('preco_total'+id).value = total.toFixed(2).toString().replace('.',',');
	}
</script>

<script type="text/javascript">
	function mudarTipo(id){
		if(document.getElementById('produto'+id).value !== ''){
			preencheCidades($('#produto'+id+' option:selected').val(), id);
		}
	}
</script>

<script type="text/javascript">
	function preencheCidades(produto, id) {
		var tipo = $('#tipo'+id+' option:selected').text();

		$(arrProdutos).each(function() {
			if (produto==this.id) 
				if(tipo == 'Venda'){
					document.getElementById('preco_unit'+id).value = this.preco_loja.toFixed(2).toString().replace('.',',');
				}else if(tipo == 'Zé Delivery'){
					document.getElementById('preco_unit'+id).value = this.preco_app.toFixed(2).toString().replace('.',',');
				}
		});

		if(document.getElementById('quantidade'+id).value !== ''){
			valores(id);
		}
	}

	var arrProdutos = <?php echo json_encode($data['produtos']); ?>;
</script>
@endsection