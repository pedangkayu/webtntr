@extends('layouts.app')
@section('meta')
	<link type="text/css" rel="stylesheet" href="/css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989" />
	<style type="text/css">
		table.loading tbody {
		    position: relative;
		}

		table.loading tbody:after {
		    position: absolute;
		    top: 0;
		    left: 0;
		    right: 0;
		    bottom: 0;
		    background-color: rgba(0, 0, 0, 0.1);
		    background-image: url('/img/loader.gif');
		    background-position: center;
		    background-repeat: no-repeat;
		    background-size: 50px 50px;
		    content: "";
		    width: 100;
		}
	</style>
@endsection
@section('content')
 
	<div class="card">
		<div class="card-head">
			 
			<div class="col-sm-12">
				<div class="header-nav header-nav-options">
					 <a href="javascript:void(0)" class="btn btn-primary create"><i class="fa fa-plus"></i> Pesanan Manual</a>
				</div>
			</div>

		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table target" id="datatable">
					<thead>
						<tr>
							<td>No</td>
							<td>Kode</td>
							<td>Kategori Pesan</td>
							<td>Nama</td>
							<td>Judul</td>
							<td>Kontak</td>
							<td>Keterangan</td>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

	<div class="modal fade" id="detailproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Rincian Pesanan</h5>
	      </div>
	      <div class="modal-body" id="modalvalue">
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="createproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Tambah Pesanan</h5>
	      </div>
	      <div class="modal-body">
	        
	      	<form method="post" action="/product/post/manual" class="formorder">
		       {{ csrf_field() }}
		            <div class="form-group">
		                <label class="first"><b>Title</b> *</label>
		                <input name="title" type="text" class="required form-control" placeholder="Title" value="{{ old('title') }}" required>
		            </div>
		            <div class="form-group">
		                <label class="first">Name *</label>
		                <input name="name" type="text" class="required form-control" placeholder="Name" value="{{ old('name') }}" required>
		            </div>
		          
		            <div class="form-group">
		                <label>Email *</label>
		                <input name="email" type="email" class="required form-control forminput" value="{{ old('email') }}" placeholder="Email" required>
		            </div>
		            <div class="form-group">
		                <label>Phone *</label>
		                <input name="phone" type="number" pattern="^\d{3}-\d{3}-\d{4}$" class="required form-control forminput" value="{{ old('phone') }}" placeholder="phone" required>
		            </div>
		          	
		            <div class="form-group">
		            	<label>Produk</label>
		            	<?php
		            		$products = App\Models\data_product::groupBy('code')->get();
		            	?>
		            	<select class="forminput form-control" name="product">
		                    @foreach($products as $item)
		                    	<option value="{!! $item->id_product !!}">{!! $item->product !!}</option>
		                    @endforeach
		                </select>
		            </div>

		            <div class="form-group">
		                <label>QTY *</label><br>
		                  <select class="forminput form-control" name="qty">
		                    <?php 
		                      for ($i=1; $i < 15; $i++) { 
		                        echo '<option class="required form-control" value="'.$i.'">'.$i.'</option>';
		                      }
		                    ?>
		                  </select>
		            </div>
		            <div class="form-group">
		                <label>Country Origin *</label><br>
		                  <select name="country" class="forminput form-control">
		                    <?php
		                      $countries = App\Models\ref_country::where('status', 1)->get();
		                      if (count($countries)) {
		                        foreach ($countries as $country) {
		                          if ($country->id_country == 100) {
		                            $selected = 'selected';
		                          } else {
		                            $selected = '';
		                          }
		                          echo '<option value="'.$country->id_country.'" '.$selected.'>'.$country->nm_country.'</option>';
		                        }
		                      }

		                    ?>
		                  </select>
		            </div>
		          
		           <div class="form-group">
		              <label>City *</label>
		                <input name="city" type="text" class="required form-control" value="{{ old('city') }}" placeholder="City" required>
		            </div>
		           	<div class="form-group">
		              <label>Address</label>
		              <textarea rows="10" name="address" class="form-control">{{ old('address') }}</textarea>
		          	</div>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Simpan</button>
	      </div>
	    	</form
	    </div>
	  </div>
	</div>
 
@endsection
@section('footer')
<script src="/js/core/demo/DemoTableDynamic.js"></script>
<script src="/js/libs/DataTables/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		datatables = '';
		datatables = $('#datatable').DataTable({
			'processing' : true,
			'serverSide' : true,
			'ajax'	: '/get-data',
			'columns' : [
				{'data' : 'no'},
				{'data' : 'code'},
				{'data' : 'categori'},
				{'data' : 'title'},
				{'data' : 'name'},
				{'data' : 'contact'},
				{'data' : 'keterangan'},
			]
		});

		$('table tbody').on('click', '.detail', function(event)
		    {
		        var r=$(this).closest('tr');
      			td = $(r).find('td');
      			code = td.eq(1).text();
      			$.ajax({
      				beforeSend:function() { 
				        $('.target').addClass('loading');
				    },
	                url: base_url('/product-detail/' + code),
	                method: 'get',
	                dataType : 'json',
	                success: function(resp) {
	                	eHtml = '<table>'+
						        	'<tr><td>Kode</td><td>: '+resp.order.code+'</td></tr>'+
						        	'<tr><td>Kategori Pesan</td><td>: '+resp.categori+'</td></tr>'+
						        	'<tr><td>Judul</td><td>: '+resp.order.title+'</td></tr>'+
						        	'<tr><td>Nama</td><td>: '+resp.order.name_customer+'</td></tr>'+
						        	'<tr><td>Email</td><td>: '+resp.order.email+'</td></tr>'+
						        	'<tr><td>No Telp</td><td>: '+resp.order.phone+'</td></tr>'+
						        	'<tr><td>Produk</td><td>: '+resp.product.product+'</td></tr>'+
						        	'<tr><td>Jumlah Pesanan</td><td>: '+resp.order.qty_pesanan+' Unit</td></tr>'+
						        	'<tr><td>Negara</td><td>: '+resp.country.nm_country+'</td></tr>'+
						        	'<tr><td>Kota</td><td>: '+resp.order.city+'</td></tr>'+
						        	'<tr><td>Alamat</td><td>: '+resp.order.address+'</td></tr>'+
						        '</table>';
						$('#modalvalue').empty().append(eHtml);
	                	$('#detailproduct').modal('show');
	                	$('.target').removeClass('loading');
	                	reload();
	                }
	            });
		    }
		);

		function reload(){
			datatables.ajax.url('/get-data').load();
		}

		$('table tbody').on('click', '.delete', function(event)
		    {
		        var r=$(this).closest('tr');
      			td = $(r).find('td');
      			code = td.eq(1).text();
	      		var c = confirm('Apakah anda yakin ingin menghapus data ini');
	      		if (c) {
	      			$.ajax({
	      				beforeSend:function() { 
					        $('.target').addClass('loading');
					    },
		                url: base_url('/product-delete/' + code),
		                method: 'get',
		                dataType : 'json',
		                success: function(resp) {
		                	console.log(resp);
		                	if (resp.status == 'sukses') {
		                		reload();
		                		$('.target').removeClass('loading');
		                		toastr.success('Data berhasil dihapus');
		                	} else {
		                		toastr.error('Data gagal dihapus');
		                	}
		                	
		                }
		            });
	      		}	
		    }
		);

		$('body').on('click', '.create', function(){
			$('#createproduct').modal('show');  
		});
		

	});
</script>
@endsection