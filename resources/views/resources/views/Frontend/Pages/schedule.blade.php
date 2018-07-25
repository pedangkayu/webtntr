@extends('layouts.Frontend.content')
@section('title_page', $page->name)
@section('content')
		 
<!-- Blog -->
        <section class="blog">
            <div class="container">
                <div class="row">     
                    <div class="col-md-9">
                    	
                        <ul class="blog-list">
                        	@foreach($schedule as $key => $value)
									<?php
										$lang = App\Models\languages::where('code', \App::getLocale())->first();
										$post = strlen($value->post); 
										$substrPost = substr($value->post, 0,200).' [...]';
										$categoriPosts = App\Models\categori_posts::where('code_posts', $value->code_posts)->get();
										$postTags = App\Models\post_tags::where('code_posts', $value->code_posts)->get();
									?>	

                            <li class="row vertical-align"> 
                                <div class="col-md-6 mt20 mb20">
									@if($value->thumb != 'null')
									<img class="img-responsive width100" src="/img/posts/{!! $value->thumb !!}" alt="#">
									@else
									<img class="img-responsive width100" src="/img/posts/thumb/default.png" alt="#">
									@endif
                                </div>

                                <div class="col-md-6">
                                    <div class="post-header">
                                    	<h4><strong><a href="{{ url(App::getLocale().'/'.$page->slug.'/'.$value->slug) }}" !!}>
                                    			{!! $value->title !!}</strong></a></h4>

                                        <h5>
                                        	<a href="#" class="color">{!! $value->date_add !!} </a>
                                        	<p>
	                                        	<small>
	                                        	<?php
	                                        	    echo '<b>Kategori :</b> ';
												  	if(count($categoriPosts)){
													    foreach ($categoriPosts as $key => $value) {
													      $categori = App\Models\categories::where('lang_id', $lang->id)->where('code', $value->code_categories)->first();
													      if($categori){
													        echo $categori->name.'';
													      }
													    }
												  	} else {
												    echo 'uncategories';
												  	}
	                                            	echo '<br />';
	                                            	echo '<b>Tags :</b> ';
												    if (count($postTags)) {
											            foreach ($postTags as $key => $value) {
											              $tag = App\Models\tags::where('id', $value->tag_id)->first();
											              if($tag){
											                echo $tag->name.', ';
											              } 
										            }
											          } else {
											            echo 'none';
											          }
													?>
												</small>
											</p>
                                        </h5>
                                    </div>
											
                                    <p>{!! $post > 200 ? $substrPost : $value->post !!} </p>
                                </div>
                            </li>
                            @endforeach
                        </ul> 

                        <!-- Pagination -->
                        <div class="col-md-12 text-center"> 
                             {!! $schedule->render() !!} 
                        </div>
                        <!-- End Pagination -->
                    </div>

                    <!-- Sidebar -->
                    <div class="col-md-3 sidebar"> 
                        <div class="blog-widget">
                            <h5>Categories</h5>
                            <ul class="category-list list-icons">
                                <li><a href="#"><i class="ion-ios-arrow-right"></i>Travel</a></li>
                                <li><a href="#"><i class="ion-ios-arrow-right"></i>Lifestyle</a></li>
                                <li><a href="#"><i class="ion-ios-arrow-right"></i>Wander</a></li>  
                                <li><a href="#"><i class="ion-ios-arrow-right"></i>Graphics</a></li>
                                <li><a href="#"><i class="ion-ios-arrow-right"></i>Other Bits</a></li>
                            </ul> 
                        </div> 

                        <div class="blog-widget blog-tags">
                            <h5>Tags</h5>
                            <ul class="tags-list">
                                <li><a href="#">Design</a></li>
                                <li><a href="#">Photography</a></li>
                                <li><a href="#">Branding</a></li> 
                                <li><a href="#">Videos</a></li>
                                <li><a href="#">Web Design</a></li>      
                                <li><a href="#">Apps</a></li>
                                <li><a href="#">Development</a></li> 
                            </ul>
                        </div> 

                        <div class="blog-widget">
                            <h5>Archives</h5>
                            <ul class="category-list list-icons">
                                <li><a href="#"><i class="ion-ios-arrow-right"></i>April 2016</a></li>
                                <li><a href="#"><i class="ion-ios-arrow-right"></i>March 2016</a></li>
                                <li><a href="#"><i class="ion-ios-arrow-right"></i>February 2016</a></li> 
                                <li><a href="#"><i class="ion-ios-arrow-right"></i>January 2016</a></li>
                                <li><a href="#"><i class="ion-ios-arrow-right"></i>December 2015</a></li>
                            </ul> 
                        </div>

                        <div class="sidebar-share"> 
                            <ul class="list-inline">
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-linkedin"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest"></i></a></li> 
                                <li><a href="#"><i class="ion-social-google"></i></a></li> 
                            </ul>
                        </div>  
                    </div>
                    <!-- End Sidebar --> 
                </div>
            </div>
        </section>            
        <!-- End Blog -->   
 
@endsection