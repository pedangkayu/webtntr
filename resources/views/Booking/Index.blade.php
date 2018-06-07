@extends('layouts.app')

@section('meta')
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')

	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="booking-all">
					<thead>
						<tr>
							<th>CODE</th>
							<th>customer</th>
							<th>COUNTACT</th>
							<th>SPA DATE</th>
							<th>HOTEL CHECK-IN</th>
							<th class="text-right">TOTAL</th>
							<th>STATUS</th>
							<th><i class="fa fa-trash"></i></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

	<input type="hidden" name="status" value="{{ $status }}">
@endsection

@section('footer')
	<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
			$(function() {
				$('#booking-all').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: {
		            url: base_url('/listbooking/anydata'),
		            method: 'POST',
								data : {
									status : $('[name="status"]').val()
								}
		        },
		        columns: [
							{data: 0},
							{data: 1},
							{data: 2},
							{data: 3},
							{data: 4},
							{data: 5},
							{data: 6},
							{data: 7},
		        ],
		        initComplete: function () {
		            this.api().columns().every(function () {
		                var column = this;
		                var input = document.createElement("input");
		                $(input).appendTo($(column.footer()).empty())
		                .on('change', function () {
		                    column.search($(this).val()).draw();
		                });
		            });
		        }
		    });

				hapus = function(id, kode) {
					var c = confirm('Are you sure delete invoice #' + kode);
					if(c){
						$.ajax({
							type : 'DELETE',
							url : base_url('/booking/' + id),
							cache : false,
							dataType : 'json',
							success : function(json){
								toastr.success(json.err);
							}
						});
					}
				}
			});
	</script>
@endsection
