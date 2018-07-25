@extends('layouts.app')
@section('meta')
	<link type="text/css" rel="stylesheet" href="/css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989" />
@endsection
@section('content')
 
	<div class="card">
		<div class="card-head">
			 
			<div class="col-sm-12">
				<div class="header-nav header-nav-options">
					 <a href="/list-produk/create" class="btn btn-primary"><i class="fa fa-plus"></i> New Product</a>
				</div>
			</div>

		</div>

		<div class="card-body">
			@if(count($rows))
				<div class="table-responsive">
					<table class="table" id="datatable1">
						<thead>
							<tr>
								<td>No</td>
								<td>Produk</td>
								<td>Merchant</td>
								<td>Harga</td>
								<td></td>
							</tr>
						</thead>
						<?php $no = 1; ?>
						<tbody>
							@foreach($rows as $row)
							<?php $languages = App\Models\languages::get(); ?>

								<tr>
									<td>{!! $no++ !!}</td>
									<td>
										@foreach($languages as $item)
											<?php 
												$produk = App\Models\data_product::where('lang_id', $item->id)->where('code', $row->code)->first();
												$merchant = App\Models\data_merchant::where('id_merchant', $row->id_merchant)->first();
												echo $produk->product.'<br>';
											?>
										@endforeach
									</td>
									<td>
										{!! $merchant->merchant !!}
									</td>
									<td>
										Rp. {!! number_format($row->price_publish) !!}
									</td>
									<td>
										<a href="javascript:;"><span class="md md-remove-red-eye"></span></a> | 
										<a href="/list-produk/edit/{!! $row->code !!}"><span class="md md-edit"></span></a> |
										<a href="javascript:;"><span class="fa fa-trash"></span></a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@else
				<p>DATA MASIH KOSONG</p>
			@endif
		</div>
	</div>

 
@endsection
@section('footer')
<script src="/js/core/demo/DemoTableDynamic.js"></script>
<script src="/js/libs/DataTables/jquery.dataTables.min.js"></script>
@endsection