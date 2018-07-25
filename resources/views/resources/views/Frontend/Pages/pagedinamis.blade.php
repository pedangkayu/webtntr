@extends('layouts.Frontend.content')
@section('title_page', $page->name)
@section('content')

<section class="blog">
	<div class="container">
		<div class="row">
			<!-- Content -->
			<div class="col-md-8 mr-auto">
				<div class="blog-post">
					@if($posts)
						{!! $posts->post !!}
					@else
						Belum ada deskripsi pada halaman ini
					@endif

				</div> 
		</div>
	</div>
</section> 


@endsection
