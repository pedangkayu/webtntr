@extends('layouts.Frontend.content')
@section('title_page', $page->name)
@section('content')
 

<style type="text/css">
	.postimage {
	    float: left;
		margin-right:15px;"
	}	
</style>

    <section id="hservices">
      <div class="container">
    
        <div class="row">
          <div class="col-md-9">

            <div class="gallery">
              <!-- /.Products row start ./-->
              <div class="row">
                <div class="col-sm-12">
                  <h3>Detail Agenda</h3>
                  <br>
                  <i class="fa fa-calendar"/></i> {!! $post->date_add !!}
                	@if($post->thumb != 'null')
    	                <?php $image = '<img class="img-responsive postimage" src="/img/thumb/'.$post->thumb.'" alt="#">'; ?>
    	            @else
    	                <?php $image = '<img class="img-responsive postimage" src="/img/imagesmall.jpeg" alt="#">'; ?>
    	            @endif
  	              <p align="justify"> <?php echo $image; ?> {!! $post->post !!} </p>
                  <table>
                      <tr>
                        <td>Tags</td>
                        <td>: 
                          <?php 
                            $postTags = App\Models\post_tags::where('code_posts', $post->code_posts)->get();
                            if (count($postTags)) { 
                              foreach ($postTags as $key => $value) {
                                $tags = App\Models\tags::where('id', $value->tag_id)->first();           
                                echo "<a href='#' class='btn btn-primary btn-small'>".$tags->name."</a>";
                              }
                            }
      									echo " &middot; ";
      									echo "Kategori : ";
      									$postKategori = App\Models\categori_posts::where('code_posts', $post->code_posts)->get();
      									if (count($postKategori)) {
      										foreach ($postKategori as $key => $value) {
      										$categories = App\Models\categories::where('code', $value->code_categories)->first();
      										echo "<a href='#'>".$categories->name."</a> , ";
      										}
									}
								?>
							</small>
							<hr />

							<div>{!! $post->post !!} </div>

                </div>
              </div>
              <!-- /.Products row end ./-->


              <hr />
              <h4>Berita Lainnya<h4>
                <?php
                $listPost = App\Models\posts::where('status', 1)->where('type', 1)->limit(5)->get();
                ?>
                @foreach($listPost as $post)
                  <div class="dateagenda"><i class="fa fa-calendar"/></i> {!! $post->date_add !!}</div>
                  <h4><a href="{{ url(App::getLocale().'/news/'.$post->slug) }}">{!! $post->title !!}</a></h4>
                @endforeach
                @if(count($listPost) > 5)
                  <p>Berita selengkapnya >>></p>
                @endif
            </div>
          </div>

          <div class="col-md-3">
            <div class="gallery">
              <!-- /.Products row start ./-->
              <div class="row">
                <div class="col-sm-12">
                  <h4>Kategori</h4>
                  <?php 
                  $language = App\Models\languages::where('status', '1')->where('code', \App::getLocale())->first();
                  $categories = App\Models\categories::where('lang_id', $language->id)->where('status', 1)->get();
                  if (count($categories)) {
                    foreach ($categories as $key => $value) {
                      echo "<a href='#'>".$value->name."</a> ";
                    }
                  }
                  ?>
                </div>
              </div>
              <br><br>
              <div class="row">
                <div class="col-sm-12">
                  <h4>Tags</h4> 
                  <?php 
                  $tags = App\Models\tags::get();
                  if (count($tags)) {
                    foreach ($tags as $key => $value) {
                      echo "<a href='#'>".$value->name."</a> ";
                    }
                  }
                  ?>
                </div>
              </div>
             
              <!-- div class="row">
                <div class="col-sm-12">
                  <h4>Agenda</h4>
                  <?php 
                  $agenda = App\Models\posts::where('type', 2)->orderBy('date_schedule_start', 'DESC')->limit(5)->get();
                    if (count($agenda)) {
                      foreach ($agenda as $key => $value) {
                        echo "<div class=\"dateagenda\"><i class='fa fa-calendar'/></i> ".$value->date_add."</div>";
                        echo "<div class=\"posttitle\"><a href='".url(App::getLocale()."/news/".$value->slug)."'>".$value->title."</a></div>";
                      }
                    }
                  ?>
                </div>
              </div  --><!-- end div row -->

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /. Services End ./-->
    <br>
@endsection