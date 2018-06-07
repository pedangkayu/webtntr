@extends('layouts.app')
@section('meta')
  <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/libs/summernote/summernote.css?1425218701') }}" />
@endsection
@section('content')

<form method="post">
    <div class="row">
      <div class="col-sm-10">

		<div class="card">
			<div class="card-head">
				<ul class="nav nav-tabs" data-toggle="tabs">
					<?php $no = 0; ?>
					@foreach($languages as $language)
					<?php $no++ ?>
						<li class="{!! $no == 1 ? 'active' : '' !!}"><a href="#{!! $language->id !!}">{!! $language->name !!}</a></li>
					@endforeach
				</ul>
			</div><!--end .card-head -->
			<div class="card-body tab-content">
				<?php $no = 0; ?>
				@foreach($languages as $language)
				<?php 
				$no++; 
				$post = App\Models\posts::where('lang_id', $language->id)->where('code_pages', $page->code)->first();
				?>
					<div class="tab-pane {!! $no == 1 ? 'active' : '' !!}" id="{!! $language->id !!}">

						<div class="form-group">
							<label for="deskripsi">DESKRIPSI</label>
				          	<textarea name="deskripsi[{!! $language->id !!}]"  id="{!! 'description'.$language->id !!}" class="form-control ckeditor description CKfinder">{!! $post->post !!}</textarea>
				      	</div>

					</div>

				@endforeach

			</div><!--end .card-body -->

		</div><!--end .card -->

		<a href="/pages" class="btn btn-success">CANCEL</a>
		<input type="submit" name="btn" class="btn btn-primary" value="SAVE">

    </div>
    {{ csrf_field() }}
  </form>

@endsection
@section('footer')
<script src="/js/ckeditor/ckeditor.js"></script>
<script src="/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">

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