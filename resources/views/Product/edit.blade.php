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
				<?php 
					$no++;
					$data = App\Models\data_product::where('code', $code)->where('lang_id', $language->id)->first();
				?>
					<div class="tab-pane {!! $no == 1 ? 'active' : '' !!}" id="{!! $language->id !!}">
						<input type="hidden" name="lang[{!! $language->id !!}]" value="{!! $language->id !!}">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" name="nama[{!! $language->id !!}]" id="nama{!! $language->id !!}" value="{!! $data->product !!}" class="form-control">
						</div>

						<div class="form-group">
							<label for="nama">Slug</label>
							<input type="text" name="slug[{!! $language->id !!}]" id="slug{!! $language->id !!}" value="{!! $data->slug !!}" class="form-control">
						</div>

						<div class="form-group">
							<label for="post">Deskripsi</label>
				          	<textarea name="post[{!! $language->id !!}]" id="{!! 'description'.$language->id !!}" class="form-control ckeditor description CKfinder">{!! $data->description !!}</textarea>
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
									<input type="radio" required="" name="status" value="{!! $key !!}" {!! $key == $productMerchant->status ? 'checked' : '' !!}>
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
								<option value="{!! $item->id_merchant !!}" {!! $item->id_merchant == $productMerchant->id_merchant !!}>{!! $item->merchant !!}</option>
							@endforeach
						@else
							<option>Merchant tidak tersedia</option>
						@endif
					</select>
				</div>

				<div class="form-group">
					<label for="nama">Harga</label>
					<input type="text" name="harga" value="{!! str_replace(',', '.',$price) !!}" id="harga" class="form-control">
				</div>

				<div class="form-group posting">
					<label for="file">Upload Image</label>
					<div class="row">
						<div class="col-md-12">
							<div align="center" id="displayImage">
								<img id="blah" src="#" alt="your image"/>
								<input type="hidden" id="newImage" value="null" name="newImage" form-control">
								<div class="middle">
								    <div style="color: red;"><a href="javascript:;" id="reset"><i class="fa fa-remove"> RESET</i></a></div>
								</div>
							</div>
							<div align="center" id="lastImage">
								@if($productMerchant->thumb != 'null')
									<img width="300" height="150" name="myfile" src="/img/produk/thumb/{!! $productMerchant->img_thumbnail !!}"/>
								@else
									<img width="300" height="150" name="myfile" src="/img/produk/thumb/default.png"/>
								@endif
							</div>
							<br>
							<input type="file" id="file" name="file" onchange="readURL(this);" class="clearfile form-control">
							<p class="help-block">change with image size 640x320</p>
						</div>
					</div>
				</div>

			</div><!--end .card-body -->

		</div><!--end .card -->

		<a href="/list-produk" class="btn btn-success">Batal</a>
		<input type="submit" name="btn" class="btn btn-primary" value="SAVE">

    </div>
    {{ csrf_field() }}
  </form>
@endsection
@section('footer')

<script src="/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

	var image = <?php echo json_encode($productMerchant->img_thumbnail) ? 1 : 0; ?>;
    if (image == 1) {
    	$('#displayImage').hide();
    }

    $('input[type="file"]').change(function(e){
		var fileName = e.target.files[0].name;
        console.log(fileName);
        if (fileName) {
        	$('#lastImage').hide();
        	$('#displayImage').show();
        }

    }); 

	$('#reset').on('click', function(){
		$('#file').val('');
		$('#lastImage').show();
        $('#displayImage').hide();
        $('#newImage').attr('value', 'null');
	});

	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result).width(300).height(150);
                $('#newImage').hide();
                $('#newImage').attr('value', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function(){
	   	$("#myForm").on("submit", function () {
	        var newData = $('#displayImage').text();
	        $(this).append("<input type='file' name='newFile`' value=' " + newData + " '/>");
	    });
	});

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