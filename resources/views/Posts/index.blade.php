@extends('layouts.app')
@section('meta')
	<link type="text/css" rel="stylesheet" href="/css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989" />
@endsection
@section('content')
 
	<div class="card">
		<div class="card-head">
				<div class="col-sm-12">
					<div class="header-nav header-nav-options">
						 <a href="/posts/create" class="btn btn-primary"><i class="fa fa-plus"></i> New Post</a>
					</div>
				</div>
		</div>

		<div class="card-body">
			@if(count($rows))
				<div class="table-responsive">
					<table class="table" id="datatable1">
						<thead>
							<tr>
								<th width="5%">No.</th>
								<th width="20%">Tanggal</th>
								<th width="70%">Judul</th>
								 
								<th width="5%">&middot;</th>
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
										$items = app\Models\posts::where('code_posts', $row->code_posts)->get(); 
									?>
									<td>{!! $no !!}</td>

									<td><small>{!! $row->date_add !!}</small><br />

									    <span class="btn btn-default btn-xs" style="color: {!! $row->type == 1 ? '#8B8E91' : '#81AB00'; !!}">{!! typePost()[$row->type] !!}</span>
									    <span class="btn btn-default btn-xs" style="color: {!! $row->status == 1 ? '#8B8E91' : '#FF4064'; !!}">{!! arrStatus()[$row->status] !!}</span>
									  
									</td>

									<td>
										@foreach($items as $item)
											{!! ucwords($item->title) !!}<br>
										@endforeach
									</td>
 

									<td>
										<a href="/posts/edit/{!! $row->code_posts !!}" class="btn btn-primary btn-xs">EDIT</a>
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