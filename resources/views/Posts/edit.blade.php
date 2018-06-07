@extends('layouts.app')
@section('meta')
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

	    .middle {
		  opacity: 0;
		  position: absolute;
		  top: 5%;
		  left: 5%;
		  transform: translate(-50%, -50%);
		  -ms-transform: translate(-50%, -50%)
		}

		#displayImage:hover .image {
		  opacity: 0.3;
		}

		#displayImage:hover .middle {
		  opacity: 1;
		} 
	    .nodisplay{
	    	display: none;
	    }
    </style>
@endsection


@section('content')
    <div class="row">
      <div class="col-sm-12">
		<form method="post" id="myForm" enctype="multipart/form-data">
			<div class="card">
				<div class="card-head">
					<ul class="nav nav-tabs" data-toggle="tabs">
						<?php $no = 0; ?>
							@foreach($languages as $language)
							<?php $no++ ?>
								<li class="{!! $no == 1 ? 'active' : '' !!}"><a href="#{!! $language->id !!}">{!! $language->name !!}</a></li>
							@endforeach

						<div class="pull-right">
							@foreach(typePost() as $key => $value)
								<label class="radio-inline radio-styled {!! $key != $postFirst->type ? 'hidden' : '' !!}">
									<input type="radio" name="type" id="type" {!! $key == $postFirst->type ? 'checked' : '' !!} value="{!! $key !!}">{!! $value !!}
								</label>
							@endforeach
						</div>

					</ul>
				</div><!--end .card-head -->
				<div class="card-body tab-content">
					<?php $no = 0; ?>
					@foreach($languages as $language)
					<?php 
						$no++;
						$posts = App\Models\posts::where('lang_id', $language->id)->where('code_posts', $code)->first();
					?>
						<div class="tab-pane {!! $no == 1 ? 'active' : '' !!}" id="{!! $language->id !!}">
							<div class="form-group">
								<label for="judul">Judul</label>
								<input type="text" name="judul[{!! $language->id !!}]" value="{!! $posts->title !!}" class="form-control">
							</div>

							<div class="form-group">
								<label for="post">Deskripsi</label>
					          	<textarea name="post[{!! $language->id !!}]" id="{!! 'description'.$language->id !!}" class="form-control ckeditor description CKfinder">{!! $posts->post !!}</textarea>
					      	</div>
						</div>
					@endforeach
					
 

					<div class="form-group posting">
						<label for="tag">Tags</label>
						<textarea name="tag" class="form-control" id="tags">{!! $formTags !!}</textarea>
					</div>



					<div class="form-group posting">
						<label for="kategori">Kategori</label>
						<select class="form-control select2-list" name="kategori[]" data-placeholder="Select an item" multiple>
							@foreach($categories as $categori)	
								<option value="{!! $categori->code !!}" {!! in_array($categori->code, $formCategories) ? 'selected' : '' !!} >{!! $categori->name !!}</option>
							@endforeach
						</select>
					</div>



					<div class="form-group">
						<label for="status">Status Posting</label>
						<br>
						<div class="col-sm-12">
							@foreach(arrStatus() as $key => $value)
								<div class="radio radio-styled">
									<label>
										<input type="radio" required="" name="status" value="{!! $key !!}" {!! $key == $postFirst->status ? 'checked' : '' !!} >
										<span>{!! $value !!}</span>
									</label>
								</div>
							@endforeach
						</div>
					</div>


					<div class="agenda">
     			      		<div class="form-group">
								<label>Waktu Kegiatan</label>
								<input type="text" id="daterange" placeholder="daterange" style="cursor: pointer;" class="form-control" value="{!! $postFirst->date_schedule_start !!} - {!! $postFirst->date_schedule_end !!}">
	                            <input type="hidden" class="form-control" id="jadwal_agenda_mulai" name="jadwal_agenda_mulai" value="{!! $postFirst->date_schedule_start !!}" autofocus="">
	                            <input type="hidden" class="form-control" id="jadwal_agenda_selesai" name="jadwal_agenda_selesai" value="{!! $postFirst->date_schedule_end !!}" autofocus="">
							</div>
			        </div>



					<div class="form-group posting">
						<label for="file">Upload Image</label>
						<div class="row">
							<div class="col-md-12">
								<div align="center" id="displayImage">
									<img id="blah" src="#" alt="your image"/>
									<input type="text" id="newImage" value="null" name="newImage" form-control">
									<div class="middle">
									    <div style="color: red;"><a href="javascript:;" id="reset"><i class="fa fa-remove"> RESET</i></a></div>
									</div>
								</div>
								<div align="center" id="lastImage">
									@if($postFirst->thumb != 'null')
										<img width="300" height="300" name="myfile" src="/img/posts/thumb/{!! $postFirst->thumb !!}"/>
									@else
										<img width="300" height="300" name="myfile" src="/img/posts/thumb/default.png"/>
									@endif
								</div>
								<br>
								<input type="file" id="file" name="file" onchange="readURL(this);" class="clearfile form-control">
								<p class="help-block">change with image size 820x820</p>
							</div>
						</div>
					</div>


				</div><!--end .card-body -->

			</div><!--end .card -->

			<a href="/posts" class="btn btn-success">BATALKAN</a>
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
<!-- script type="text/javascript" src="/js/jcrop/jquery.Jcropv0.9.12.js"></script -->
<!-- script type="text/javascript" src="/js/jcrop/cropping.js"></script -->
<!-- script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3STOH44jKGz1o_ud_Y5dIHC7cwJlQIR4&libraries=places&callback=initMap"></script -->
<script type="text/javascript">
	
	$('#tags').tagEditor({
        autocomplete: { delay: 0, position: { collision: 'flip' }, source: <?php echo json_encode($tags); ?> },
        forceLowercase: false,
        placeholder: 'Tags ...'
    });

	var type = <?php echo $postFirst->type; ?>;

	if (type == 0) {
		$('.posting').remove();
		$('.agenda').remove();
	}
	if (type == 1) {
		$('.agenda').remove();
		$('.posting').removeClass('nodisplay');
	}
	if (type == 2) {
		$('.agenda').removeClass('nodisplay');
		$('.posting').removeClass('nodisplay');
	}

    var image = <?php echo json_encode($postFirst->thumb) ? 1 : 0; ?>;
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

	$('input[type=radio]').on('click', function() {
		var type = $('input:radio[name=type]:checked').val();
		console.log(type);
		if (type == 1) {
			$('#agenda').hide();
		} else {
			$('#agenda').show();
		}
	});

	$('#reset').on('click', function(){
		$('#file').val('');
		$('#lastImage').show();
        $('#displayImage').hide();
        $('#newImage').attr('value', 'null');
	});

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

	/*
	$('#refresh').on('click', function(){
		$("#views").empty();
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