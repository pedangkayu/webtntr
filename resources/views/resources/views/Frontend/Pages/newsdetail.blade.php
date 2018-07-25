@extends('layouts.Frontend.content')
@section('content')

<!-- Project -->
        <section class="pt140 pb50">
            <div class="container">
                <div class="row">    
                    <div class="col-md-12 text-center">
                        <h1><strong> {!! $post->title !!}</strong></h1>
                        <p class="lead">Digital advertising campaigns and product design, we approach<br>our projects with strategic and creative thinking</p>
                    </div>
                    
                    <div class="col-md-8 mt20 mb40">
                        <div data-autoplay="false" data-speed="4000" data-touch-drag="true" data-loop="false">
                            @if($post->thumb != 'null')
                                  <?php $image = '<img class="img-responsive width100" src="/img/posts/'.$post->thumb.'" alt="#">'; ?>  
                            @else
                                  <?php $image = '<img class="img-responsive width100" src="/img/posts/default.png" alt="#">'; ?>  
                            @endif
                            <div><?php echo $image; ?></div>
                        </div>


                        <div class="post-header">
                            <h5><span>In</span> <strong><a href="#" class="color">Tinatar Innovation</a></strong></h5>
                            <a class="link-to-post" href="#"><h3><strong></strong></h3></a>
                        </div>
                        
                        <p>{!! $post->post !!} </p>
                        
                        <div class="post-tags">
                        <a href="#" rel="tag">Workshop</a>
                            <a href="#" rel="tag">Technologi</a>
                            <a href="#" rel="tag">Startup Life</a>
                            <a href="#" rel="tag">Laravel</a>
                        </div>
                        
                        <div class="post-share">
                            <a href="#"><i class="ion-social-facebook"></i> <span>Share</span></a>
                            <a href="#"><i class="ion-social-twitter"></i> <span>Tweet</span></a>
                            <a href="#"><i class="ion-social-pinterest"></i> <span>Pin it</span></a>
                            <a href="#"><i class="ion-social-googleplus"></i></a>
                        </div> 
                    </div>
                    
                    <!-- Sidebar -->
                    <div class="col-md-4 project-sidebar"> 
                        <div>
                            <h4><strong>Project Portofolio</strong></h4>
                            <?php
                            $lang = App\Models\languages::where('code', \App::getLocale())->first();
                            $listPost = App\Models\posts::where('status', 1)->where('type', 1)->where('lang_id', $lang->id)
                            ->orderBy(\DB::raw('RAND()'))->limit(10)->get();
                            ?>
                            @foreach($listPost as $post)
                            <p><i class="ion-android-checkmark-circle"></i> <a href="{{ url(App::getLocale().'/'.$page->slug.'/'.$post->slug) }}" !!}>{!! $post->title !!}</a></p>
 
                            @endforeach
                                @if(count($listPost) > 10)
                                  <p>Selengkapnya</p>
                                @endif
                                
                                <p><a href="{{ url(App::getLocale().'/'.$page->slug) }}" !!}>check other</a></p>
                        </div>  

                        <div class="project-info">
                            <div>
                                <p>Client</p>
                                <p>Tinatar Project</p>
                            </div>
                            <div>
                                <p>Date</p>
                                <p>{!! $post->date_add !!}</p>
                            </div>
                            <div>
                                <p>Kategori</p>
                                <p>
                                  <?php 
                                      $postKategori = App\Models\categori_posts::where('code_posts', $post->code_posts)->get();
                                      if (count($postKategori)) {
                                      foreach ($postKategori as $key => $value) {
                                      $categories = App\Models\categories::where('code', $value->code_categories)->first();
                                              echo "<u><a href='#'>".$categories->name."</a></u> ";
                                      }
                                    }
                                  ?>
                                  
                                </p>
                            </div>
                            <div>
                                <p>Tag</strong></p>
                                <p> <?php 
                                        $postTags = App\Models\post_tags::where('code_posts', $post->code_posts)->get();
                                        if (count($postTags)) { 
                                          foreach ($postTags as $key => $value) {
                                          $tags = App\Models\tags::where('id', $value->tag_id)->first();    
                                              if($tags){
                                                  echo "<u><a href='#'>".$tags->name."</a></u> ";
                                              }
                                          }
                                        }
                                      ?>

                                </p>
                            </div> 
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
        <!-- End Project -->      
        
        <section class="project-nav">
            <a href="project-video.html"><i class="ion-android-arrow-back"></i><h5><strong>Previous</strong></h5></a>
            <a href="portfolio-contained.html"><h5><strong>All Projects</strong></h5></a>
            <a href="project-gallery.html"><h5><strong>Next</strong></h5><i class="ion-android-arrow-forward"></i></a> 
        </section>

@endsection