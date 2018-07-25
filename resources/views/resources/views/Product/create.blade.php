@extends('layouts.app')

@section('content')
  <form method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-sm-12">

		<div class="card">
			<div class="card-head">
				<ul class="nav nav-tabs" data-toggle="tabs">
					<?php $no = 0; ?>
					@foreach($languages as $language)
					<?php $no++ ?>
						<li class="{!! $no == 1 ? 'active' : '' !!}"><a href="#{!! $language->id !!}"> {!! $language->name !!}</a></li>
					@endforeach
				</ul>
			</div><!--end .card-head -->
			<div class="card-body tab-content">
				<?php $no = 0; ?>
				@foreach($languages as $language)
				<?php $no++ ?>
					<div class="tab-pane {!! $no == 1 ? 'active' : '' !!}" id="{!! $language->id !!}">
						<input type="hidden" name="lang[{!! $language->id !!}]" value="{!! $language->id !!}">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" name="nama[{!! $language->id !!}]" id="nama{!! $language->id !!}" class="form-control">
						</div>

						<div class="form-group">
							<label for="nama">Slug</label>
							<input type="text" name="slug[{!! $language->id !!}]" id="slug{!! $language->id !!}" class="form-control">
						</div>

						<div class="form-group">
							<label for="post">Deskripsi</label>
				          	<textarea name="post[{!! $language->id !!}]" id="{!! 'description'.$language->id !!}" class="form-control ckeditor description CKfinder"></textarea>
				      	</div>

					</div>

				@endforeach

				<div class="form-group">
					<label for="status">Status</label>
					<br>
					<div class="col-sm-12">
						@foreach(arrStatus() as $key => $value)
							<div class="radio radio-styled">
								<label>
									<input type="radio" required="" name="status" value="{!! $key !!}" {!! $key == '1' ? 'checked' : '' !!}>
									<span>{!! $value !!}</span>
								</label>
							</div>
						@endforeach
					</div>
				</div>

				<div class="form-group">
					<label for="merchant">Merchant</label>
					<select name="merchant" class="form-control">
						@if(count($merchants))	
							@foreach($merchants as $item)
								<option value="{!! $item->id_merchant !!}">{!! $item->merchant !!}</option>
							@endforeach
						@else
							<option>Merchant tidak tersedia</option>
						@endif
					</select>
				</div>

				<div class="form-group">
					<label for="nama">Harga</label>
					<input type="text" name="harga" id="harga" class="form-control">
				</div>

				<div>
					<label for="image">Gambar</label>
					<input type="file" name="file" class="clearfile form-control">
				</div>

			</div><!--end .card-body -->

		</div><!--end .card -->

		<a href="/pages" class="btn btn-success">Batal</a>
		<input type="submit" name="btn" class="btn btn-primary" value="SAVE">

    </div>
    {{ csrf_field() }}
  </form>
@endsection
@section('footer')

<script src="/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

	$("#nama1").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug1").val(Text);        
	});

	$("#nama2").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug2").val(Text);        
	});

	var dengan_rupiah = document.getElementById('harga');
	dengan_rupiah.addEventListener('keyup', function(e)
	{
		dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
	});

	function formatRupiah(angka, prefix)
	{
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split	= number_string.split(','),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}

	$(document).ready(function() {

		CKEDITOR.replace( 'description1', {
            extraPlugins: 'uploadimage,html5audio,pagebreak,youtube',
            height: 200,

            // Upload images to a CKFinder connector (note that the response type is set to JSON).
            uploadUrl: '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

            // Configure your file manager integration. This example uses CKFinder 3 for PHP.
            filebrowserBrowseUrl: '/js/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: '/js/ckfinder/ckfinder.html?type=Images',
            filebrowserUploadUrl: '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

            // The following options are not necessary and are used here for presentation purposes only.
            // They configure the Styles drop-down list and widgets to use classes.

            stylesSet: [
                { name: 'Narrow image', type: 'widget', widget: 'image', attributes: { 'class': 'image-narrow' } },
                { name: 'Wide image', type: 'widget', widget: 'image', attributes: { 'class': 'image-wide' } }
            ],

            // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
            // resizer (because image size is controlled by widget styles or the image takes maximum
            // 100% of the editor width).
            image2_alignClasses: [ 'image-align-left', 'image-align-center', 'image-align-right' ],
            image2_disableResizer: true
        } );

        CKEDITOR.replace( 'description2', {
            extraPlugins: 'uploadimage,html5audio,pagebreak,youtube',
            height: 200,

            // Upload images to a CKFinder connector (note that the response type is set to JSON).
            uploadUrl: '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

            // Configure your file manager integration. This example uses CKFinder 3 for PHP.
            filebrowserBrowseUrl: '/js/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: '/js/ckfinder/ckfinder.html?type=Images',
            filebrowserUploadUrl: '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

            // The following options are not necessary and are used here for presentation purposes only.
            // They configure the Styles drop-down list and widgets to use classes.

            stylesSet: [
                { name: 'Narrow image', type: 'widget', widget: 'image', attributes: { 'class': 'image-narrow' } },
                { name: 'Wide image', type: 'widget', widget: 'image', attributes: { 'class': 'image-wide' } }
            ],

            // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
            // resizer (because image size is controlled by widget styles or the image takes maximum
            // 100% of the editor width).
            image2_alignClasses: [ 'image-align-left', 'image-align-center', 'image-align-right' ],
            image2_disableResizer: true
        } );

    });

</script>
@endsection