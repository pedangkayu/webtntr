@extends('layouts.app')
@section('meta')
	<link rel="stylesheet" href="/js/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" href="/js/tag-editor/jquery.tag-editor.css">
	<link type="text/css" rel="stylesheet" href="/css/theme-default/libs/select2/select2.css?1424887856" />
	<link class="jsbin" href="/js/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/js/daterange/daterangepicker.css" />
	<style>
    .controls {
      margin-top: 10px;
      border: 1px solid transparent;
      border-radius: 2px 0 0 2px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      height: 32px;
      outline: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #pac-input {
      background-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 12px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 300px;
    }

    #pac-input:focus {
      border-color: #4d90fe;
    }

    .pac-container {
      font-family: Roboto;
    }

    #type-selector {
      color: #fff;
      background-color: #4d90fe;
      padding: 5px 11px 0px 11px;
    }

    #type-selector label {
      font-family: Roboto;
      font-size: 13px;
      font-weight: 300;
    }
    #target {
        width: 345px;
      }
    .nodisplay{
    	display: none;
    }
    </style>
@endsection
@section('content')
    <div class="row">
      <div class="col-sm-12">
		<form id="form" method="post" enctype="multipart/form-data">
			<div class="card">
				<div class="card-head">
					<ul class="nav nav-tabs" data-toggle="tabs">
						<?php $no = 0; ?>
						@foreach($languages as $language)
						<?php $no++ ?>
							<li class="{!! $no == 1 ? 'active' : '' !!}"><a href="#{!! $language->id !!}">{!! $language->name !!}</a></li>
						@endforeach
						<div class="pull-right">
							<span style="padding: 30px; font-size: 15px; font-weight:bold;">Type Post</span>
							@foreach(typePost() as $key => $value)
								<label class="radio-inline radio-styled {!! $key == '3' ? 'hidden' : '' !!}">
									<input type="radio" name="type" id="type" {!! $key == '0' ? 'checked' : '' !!} value="{!! $key !!}">{!! $value !!}
								</label>
							@endforeach
						</div>
					</ul>
				</div><!--end .card-head -->

				<div class="card-body tab-content">
					<?php $no = 0; ?>
					@foreach($languages as $language)
					<?php $no++ ?>
						<div class="tab-pane {!! $no == 1 ? 'active' : '' !!}" id="{!! $language->id !!}">
							<div class="form-group">
								<label for="judul">Judul</label>
								<input type="text" name="judul[{!! $language->id !!}]" class="form-control">
							</div>
							<div class="form-group">
								<label for="post">Deskripsi</label>
					          	<textarea name="post[{!! $language->id !!}]" id="{!! 'description'.$language->id !!}" class="form-control ckeditor description CKfinder"></textarea>
					      	</div>
						</div>
					@endforeach
					

					<div class="form-group posting">
						<label for="tag">Tags</label>
						<textarea name="tag" class="form-control tags"></textarea>
					</div>

					<div class="form-group posting">
						<label for="kategori">Kategori</label>
						<select class="form-control select2-list" name="kategori[]" data-placeholder="Select an item" multiple>
							<optgroup label="Kategori">
								@foreach($categories as $categori)	
									<option value="{!! $categori->code !!}">{!! $categori->name !!}</option>
								@endforeach
							</optgroup>
						</select>
					</div>

					<div class="agenda">
                		<div class="form-group">
							<label>Waktu Kegiatan</label>
							<input type="text" id="daterange" placeholder="daterange" style="cursor: pointer;" class="form-control">
                            <input type="hidden" class="form-control" id="jadwal_agenda_mulai" name="jadwal_agenda_mulai" autofocus="">
                            <input type="hidden" class="form-control" id="jadwal_agenda_selesai" name="jadwal_agenda_selesai" autofocus="">
							<p class="help-block">Berakhirnya Masa Kegiatan Akan menghilangkan Posting</p>
						</div>
					</div>


					<div class="form-group">
						<label for="status">Status</label>
						<div class="col-sm-12">
							@foreach(arrStatus() as $key => $value)
								<div class="radio radio-styled">
									<label>
										<input type="radio" name="status" value="{!! $key !!}" {!! $key == '1' ? 'checked' : '' !!}>
										<span>{!! $value !!}</span>
									</label>
								</div>
							@endforeach
						</div>
					</div>


					<div class="form-group posting">
						<label for="file">Upload Images</label>
						<div class="col-md-12">
							<div align="center" id="displayImage">
								<!-- img id="blah" src="{{ asset('/img/post/' . 'default.png') }}" alt="your image" / -->
								<input type="hidden" id="newImage" value="null" name="newImage" form-control">
							</div>
							<br>
							<input type="file" id="file" name="file" onchange="readURL(this);" class="clearfile form-control">
							<p class="help-block">upload image with size 640x320</p>

						</div>
					</div>		 

				</div><!--end .card-body -->

			</div><!--end .card -->

			<a href="/posts" class="btn btn-success">CANCEL</a>
			<input type="submit" name="btn" class="btn btn-primary" value="SAVE">

		{{ csrf_field() }}
		</form>
	   </div>
    </div>
@endsection



@section('footer')
<script type="text/javascript" src="/js/daterange/moment.min.js"></script>
<script src="/js/daterange/daterangepicker.js"></script>
<script src="/js/ckeditor/ckeditor.js"></script>
<script src="/js/jquery-ui/jquery-ui.min.js"></script>
<script src="/js/tag-editor/jquery.caret.min.js"></script>
<script src="/js/tag-editor/jquery.tag-editor.js"></script>
<script src="/js/libs/select2/select2.min.js"></script>
<script src="/js/core/demo/DemoFormComponents.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3STOH44jKGz1o_ud_Y5dIHC7cwJlQIR4&libraries=places&callback=initMap"></script>
<!-- <script type="text/javascript" src="/js/jcrop/jquery.Jcropv0.9.12.js"></script>
<script type="text/javascript" src="/js/jcrop/cropping.js"></script> -->
<script type="text/javascript">
	$('.tags').tagEditor({
	    autocomplete: { delay: 0, position: { collision: 'flip' }, source: <?php echo json_encode($tags); ?> },
	    forceLowercase: false,
	    placeholder: 'Tags ...'
	});

	$('.posting').addClass('nodisplay');
	$('.agenda').addClass('nodisplay');

	if ($('input:radio[name=type]:checked').val() == 0) {
		$('.posting').addClass('nodisplay');
		$('.agenda').addClass('nodisplay');
	}

	$('input[type=radio]').on('click', function() {
		var type = $('input:radio[name=type]:checked').val();
		//console.log(type);
		if (type == 0) {
			$('.posting').addClass('nodisplay');
			$('.agenda').addClass('nodisplay');
		}
		if (type == 1) {
			$('.agenda').addClass('nodisplay');
			$('.posting').removeClass('nodisplay');
		}
		if (type == 2) {
			$('.agenda').removeClass('nodisplay');
			$('.posting').removeClass('nodisplay');
		}	
	});

	/*
	$('#refresh').on('click', function(){
		
		//console.log($('#file')[0].files[0].name);
		//$('.clearfile').val('');
		$('#views').empty();
		var $el = $('.clearfile');
	   $el.wrap('<form>').closest('form').get(0).reset();
	   $el.unwrap();

	});

	$('#cropbutton').hide();
	$('#views').hide();

	$('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        console.log(fileName);
        if (fileName) {
        	$('#cropbutton').show();
        	$('#views').show();
        } else {
        	$('#cropbutton').hide();
        	$('#views').hide();
        }
    }); */

	/*$('#checkCrop').on('click', function(){
		//compress
		$('#checkCrop').children().toggleClass('fa-crop fa-compress');
		console.log($('#checkCrop').children().attr('class'));
		if ($('#checkCrop').children().attr('class') == 'fa fa-compress') {
			$('#crop').show();
		} else {
			$('#crop').hide();
		}
	}); */

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result).width(300).height(150);
                $('#newImage').attr('value', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#daterange').daterangepicker({
            "locale": {
                "direction": "ltr",
                "format": "YYYY-MM-DD",
                "separator": " - ",
                "applyLabel": "Apply",
                "cancelLabel": "Cancel",
                "fromLabel": "From",
                "toLabel": "To",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "Su",
                    "Mo",
                    "Tu",
                    "We",
                    "Th",
                    "Fr",
                    "Sa"
                ],
                "monthNames": [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December"
                ],
                "firstDay": 1
            },
            "alwaysShowCalendars": true,
        }, function(start, end, label) {
            var start = start.format('YYYY-MM-DD');
            var end = end.format('YYYY-MM-DD');
            $('#jadwal_agenda_mulai').val(start);
            $('#jadwal_agenda_selesai').val(end);
          //console.log("New date range selected: '" + start + "' to '" + end + "' (predefined range: '" + label + "')");
        });

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