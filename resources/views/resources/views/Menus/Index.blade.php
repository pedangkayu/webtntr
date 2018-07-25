@extends('layouts.app')

@section('meta')
	<link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/libs/nestable/nestable.css?1423393667') }}" />
@endsection

@section('content')
	
	<div class="card">
		<div class="card-head">
			<header>Posisi Navigasi</header>
			<div class="tools">
				<a href="{{ url('/menu/create') }}" title="Tambah menu" class="btn btn-icon-toggle"><i class="md md-playlist-add"></i></a>
			</div>
		</div><!--end .card-head -->
		<div class="card-body">
			<div class="dd nestable-list">
				<ol class="dd-list">
					@foreach($menu_main->roots() as $item)
						@if($item->url() != 'home')
		                    <li class="dd-item list-group" {!! $item->attributes() !!}>
		                    	<div class="dd-handle btn btn-default-light"></div>
								<div class="btn btn-default-light menu-body" data-index="{{ $item->navigasi_id }}">
									{!! $item->icon !!}
		                            {{ $item->title }}

		                            <div class="pull-right action-{{ $item->navigasi_id }}" style="display:none;">
		                            	@if(!$item->hasChildren())
		                            		<a href="javascript:delete_menu({{ $item->navigasi_id }});"><i class="md md-delete"></i></a>
		                            	@endif
		                            	<a href="{{ url('/menu/' . $item->navigasi_id . '/edit') }}"><i class="md md-mode-edit"></i></a>&nbsp;&nbsp;
		                            </div>
								</div>

		                        <!-- ANak menu -->
		                        @if($item->hasChildren())
		                            <ol class="dd-list">
		                            @foreach($item->children() as $child)
		                                <li class="dd-item list-group" {!! $child->attributes() !!}>
					                    	<div class="dd-handle btn btn-default-light"></div>
											<div class="btn btn-default-light menu-body" data-index="{{ $child->navigasi_id }}">
												{!! $child->icon !!}
		                            			{{ $child->title }}

		                            			<div class="pull-right action-{{ $child->navigasi_id }}" style="display:none;">
					                            	@if(!$child->hasChildren())
					                            		<a href="javascript:delete_menu({{ $child->navigasi_id }});"><i class="md md-delete"></i></a>
					                            	@endif
					                            	<a href="{{ url('/menu/' . $child->navigasi_id . '/edit') }}"><i class="md md-mode-edit"></i></a>&nbsp;&nbsp;
					                            </div>
											</div>
							

		                                    <!-- cucu menu -->
		                                    @if($child->hasChildren())
		                                        <ol class="dd-list">
		                                            @foreach($child->children() as $cucu)
		                                                <li class="dd-item list-group" {!! $cucu->attributes() !!}>
									                    	<div class="dd-handle btn btn-default-light"></div>
															<div class="btn btn-default-light menu-body" data-index="{{ $cucu->navigasi_id }}">
																{!! $cucu->icon !!}
		                            							{{ $cucu->title }}

		                            							<div class="pull-right action-{{ $cucu->navigasi_id }}" style="display:none;">
									                            	@if(!$cucu->hasChildren())
									                            		<a href="javascript:delete_menu({{ $cucu->navigasi_id }});"><i class="md md-delete"></i></a>
									                            	@endif
									                            	<a href="{{ url('/menu/' . $cucu->navigasi_id . '/edit') }}"><i class="md md-mode-edit"></i></a>&nbsp;&nbsp;
									                            </div>

															</div>
		                                                </li>
		                                            @endforeach
		                                        </ol>
		                                    @endif

		                                </li>
		                            @endforeach
		                            </ol>
		                        @endif

		                    </li>
	                    @endif
	                @endforeach
	                </ol>
				</div><!--end .dd.nestable-list -->
			</div>
		</div>
	</div>

@endsection

@section('footer')
	<script src="{{ asset('/js/libs/nestable/jquery.nestable.js') }}"></script>
	<script src="{{ asset('/js/modules/menus/index.js') }}"></script>
@endsection