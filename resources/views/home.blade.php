@extends('layouts.layout')
@section('content')
				<div class="container-fluid">
					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
						<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
					</div>
					<!-- Content Row -->
					<div class="row">
						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Vendas Mensal ({{ date('M') }})</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ n($data['saida_mensal']) }}</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-donate fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Pending Requests Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Lucro Mensal ({{ date('M') }})</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ n($data['lucro_mensal']) }}</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Vendas Anual ({{ date('Y') }})</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ n($data['saida_anual']) }}</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-donate fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Lucro Anual ({{ date('Y') }})</div>
											<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">R$ {{ n($data['lucro_anual']) }}</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Content Row -->
					<div class="row">
						<!-- Últimas Entradas -->
						<div class="col-xl-6 col-lg-6">
							<div class="card shadow mb-4">
								<!-- Card Header - Dropdown -->
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary">Últimas Entradas</h6>
									<!--
									<div class="dropdown no-arrow">
										<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
											<div class="dropdown-header">Dropdown Header:</div>
											<a class="dropdown-item" href="#">Action</a>
											<a class="dropdown-item" href="#">Another action</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="#">Something else here</a>
										</div>
									</div>
									-->
								</div>
								<!-- Card Body -->
								<div class="card-body">
									<div class="pt-1 pb-1">
										<table class="text-center" width="100%">
											<thead>
												<tr>
													<th>Produto</th>
													<th>Data Recebimento</th>
													<th>Qnt.</th>
													<th>Custo Unit</th>
													<th>Custo Total</th>
												</tr>
											</thead>
											<tbody>
												@foreach($data['entradas'] as $e)
													<tr>
														<td>{{ $e->produto }}</td>
														<td>{{ d($e->data_entrega) }}</td>
														<td>{{ $e->quantidade }}</td>
														<td>{{ n($e->valor_unit) }}</td>
														<td>{{ n($e->valor_total) }}</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- Últimas Saidas -->
						<div class="col-xl-6 col-lg-6">
							<div class="card shadow mb-4">
								<!-- Card Header - Dropdown -->
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary">Últimas Saidas</h6>
									<!--
									<div class="dropdown no-arrow">
										<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
											<div class="dropdown-header">Dropdown Header:</div>
											<a class="dropdown-item" href="#">Action</a>
											<a class="dropdown-item" href="#">Another action</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="#">Something else here</a>
										</div>
									</div>
									-->
								</div>
								<!-- Card Body -->
								<div class="card-body">
									<div class="pt-1 pb-1">
										<table class="text-center" width="100%">
											<thead>
												<tr>
													<th>Produto</th>
													<th>Data</th>
													<th>Qnt.</th>
													<th>Preço Unit.</th>
													<th>Preço Total</th>
												</tr>
											</thead>
											<tbody>
												@foreach($data['saidas'] as $s)
													<tr>
														<td>{{ $s->produto }}</td>
														<td>{{ d($s->data_saida) }}</td>
														<td>{{ $s->quantidade }}</td>
														<td>{{ n($s->preco_unit) }}</td>
														<td>{{ n($s->preco_total) }}</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
@endsection