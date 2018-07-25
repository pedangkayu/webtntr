@extends('layouts.app')
@section('meta')
	<link type="text/css" rel="stylesheet" href="/css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989" />
@endsection
@section('content')

	<div class="card">
		<div class="card-head">
			<header><a href="/pages/create" class="btn btn-primary"><i class="fa fa-plus"></i> New Pages</a></header>
		</div>
		<div class="card-body">
			@if(count($rows))

				<div class="table-responsive">
					<table class="table" id="datatable1">
						<thead>
							<tr>
							    <th>No.</th>
								<th>Nama Halaman</th>
								<th>Bahasa</th>
								<th>Statis / Dinamis</th>
								<th>Kategori Halaman</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<?php $no = 0; ?>

						<tbody>
							@foreach($rows as $row)
							<?php 
								$no++;
							?>
								<tr>
								<?php 
									$pages = app\Models\pages::where('code', $row->code)->get(); 
								?>
	 
                                    <td>{!! $no !!}</td>
									<td>
										@foreach($pages as $page)
											{!! $page->name !!}<br>
										@endforeach
									</td>

									<td>
										@foreach($pages as $page)
										<?php $bahasa = App\Models\languages::where('id', $page->lang_id)->first(); ?>
											{!! $bahasa->code !!}<br>
										@endforeach
									</td>

									<td><span style="color: {!! $row->stsdms == 1 ? 'green' : 'blue'; !!}">{!! StsDms()[$row->stsdms] !!}</span></td>

									<td><span style="color: {!! $row->page_categori == 1 ? 'blue' : 'green'; !!}">{!! catHeader()[$row->page_categori] !!}</span></td>
									<td style="color: {!! $row->status == 1 ? 'blue' : 'red'; !!}">{!! arrStatus()[$row->status] !!}</td>
									
									<td><a href="/pages/edit/{!! $row->code !!}" class="btn btn-primary btn-xs">EDIT</a> <a class="btn btn-primary btn-xs" href="{!! '/pages/'.$page->slug.'/description' !!}">DESKRIPSI</a></td>
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