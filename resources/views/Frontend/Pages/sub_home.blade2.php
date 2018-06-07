@extends('Frontend.home')
@section('sub_home')
<?php
use App\Models\languages;
use App\Models\pages;
use App\Models\posts;
$transnews = trans('main.news');
$lang = languages::where('code', \App::getLocale())->first();

$intros = posts::where('type', 0)->where('status', 1)->where('lang_id', $lang->id)->orderBy('date_add', 'ASC')->limit(1)->get();

$news = posts::where('type', 1)->where('status', 1)->
where('lang_id', $lang->id)->
// orderBy('date_add', 'ASC')->
orderBy(\DB::raw('RAND()'))->
limit(9)->get();

$schedulers = posts::where('type', 2)->where('status', 1)->where('lang_id', $lang->id)->orderBy('date_schedule_start', 'ASC')->limit(6)->get();


$primarySchedule = posts::where('type', 2)->where('status', 1)->where('lang_id', $lang->id)->orderBy('date_schedule_start', 'ASC')->first();


?>



<!--  INTRO -->
<!-- /. Services Start ./-->
	<section id="hservices">
	  <div class="container">
		  <div class="row">
			 <div class="col-lg-12 col-md-6 col-sm-6">
				<div class="hservice">
					@if(count($intros))
						@foreach($intros as $key => $value)
						  <p>{!! $value->post !!}</p>
						@endforeach
					@endif
				</div>
			 </div>
		  </div>
	  </div>
	</section>
<!-- #END KOLOM INTRO -->



<!-- /.signup Start ./-->
  <section class="services">
	    <div class="container"><!-- SERVICES -->
	      	<div class="row">
		        <div class="col-lg-12 col-md-12">
		          <h1 class="main-title">What We Do ?</h2>
		          <!-- h4 class="sub-title">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</h4 -->
		        </div>
		        <div class="gap-35"></div>
	      	</div>

      		<div class="row service-grid">
		        <div class="col-sm-4">
			          <ul>
			            <li><span><i class="fa fa-cogs"></i></span></li>
			            <li>
			              <h3> Software & Multimedia</h3>
			              <h6> Website Personal, Website Komunitas, Company Profile, ERP, Online Store, Sistem Informasi Geografis, Web Apps, Otomasi Laporan, Data Integrasi, Interactive Apps, dan.  </h6>
			            </li>
			            <!-- li>
			              <button onclick="window.location.href='services-details.html'">Read More</button>
			            </li -->
			          </ul>
		        </div>

		        <div class="col-sm-4">
			          <ul>
			            <li><span><i class="fa fa-user-md"></i></span></li>
			            <li>
			              <h3> IT Consultant</h3>
			              <h6> Kami memberikan solusi cepat dan tepat untuk setiap permasalah IT di perusahaan anda. kami akan memberikan solusi terbaik dalam presentasi singkat dan lugas.</h6>
			            </li>
 
			          </ul>
		        </div>

		        <div class="col-sm-4">
			          <ul>
			            <li><span><i class="fa fa-desktop"></i></span></li>
			            <li>
			              <h3> Hardware</h3>
			              <h6> Perusahaan anda memiliki kebutuhan terhadap perangkat keras untuk mendukung operasional perusahaan? diskusikan dengan kami, Tim kami akan segera menyediakan untuk anda. </h6>
			            </li>
 
			          </ul>
		        </div>
	    	</div>
      	</div><!-- END SERVICE -->
      <div class="gap-35"></div>
  </section>
<!-- /.Cart End ./-->
 

 

<!-- HOWTOWORK BOX -->
    <!-- /. More Services start ./-->
    <section id="services" style="background: #F7F8FA;">
      <div class="container">
        <div class="row">
			    <div class="col-lg-6 col-md-6 col-sm-6">
				   <div class="col-lg-12" style="color: #DA0000;">	
                         <h1> {!! trans('main.advantages') !!}</h1> 
					</div>

					<div class="panel-group" id="accordion">
					    <div class="panel panel-default">
						    <div class="panel-heading">
								    <h4 class="panel-title">
								        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
								        	 <i class="fa fa-check fa-1x" aria-hidden="true"></i> A n a l y s i s
								        </a>
								    </h4>
						    </div>

						    <div id="collapse1" class="panel-collapse icollapse in">
							    	<div class="panel-body">
							         	Ceritakan kepada kami masalah & ide Anda. dengan pengalaman yang kami miliki. kami dapat memberikan saran terbaik untuk aplikasi anda
							     	</div>
						    </div>
					    </div>

					    <div class="panel panel-default">
						    <div class="panel-heading">
							      	<h4 class="panel-title">
							        	<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapse2">
							          		<i class="fa fa-check fa-1x" aria-hidden="true"></i> D e s i g n
							        	</a>
							      	</h4>
						    </div>
						    <div id="collapse2" class="panel-collapse collapse">
							      	<div class="panel-body">
							        	Selanjutnya tim kami akan melakukan sketsa design product secara UI dan UX untuk memberikan gambaran kepada anda akan seperti apa kebutuhan aplikasi sistem sebelum masuk ke tahap development.
							      	</div>
						    </div>
					    </div>

					    <div class="panel panel-default">
						    <div class="panel-heading">
							      	<h4 class="panel-title">
							        	<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapse3">
							          		<i class="fa fa-check fa-1x" aria-hidden="true"></i> A c c e p t a n c e
							        	</a>
							      	</h4>
						    </div>
						    <div id="collapse3" class="panel-collapse collapse">
							      	<div class="panel-body">
							        	Setelah sesi presentasikan dari analisa dan penjabaran design dan fitur, dan seluruh presentasi telah disepakati, maka kita akan melakukan persetujuan administrasi.
							      	</div>
						    </div>
					    </div>

					    <div class="panel panel-default">
						    <div class="panel-heading">
							      	<h4 class="panel-title">
							        	<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapse4">
							          		<i class="fa fa-check fa-1x" aria-hidden="true"></i> D e v e l o p m e n t
							        	</a>
							      	</h4>
						    </div>
						    <div id="collapse4" class="panel-collapse collapse">
							      	<div class="panel-body">
											ini adalah tahap yang kami lakukan dengan gembira. kami Develop Apps berdasarkan Ide Anda + Core Feature Apps Bisnis Kami Untuk menekan durasi waktu dan biaya kami mempunyai Core Feature Aplikasi Bisnis. tim kami akan berkonsentrasi penuh di bagian ini. 
							      	</div>
						    </div>
					    </div>

					    <div class="panel panel-default">
						    <div class="panel-heading">
							      	<h4 class="panel-title">
							        	<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapse5">
							          		<i class="fa fa-check fa-1x" aria-hidden="true"></i> I m p l e m e n t a t i o n 
							        	</a>
							      	</h4>
						    </div>
						    <div id="collapse5" class="panel-collapse collapse">
							      	<div class="panel-body">
							        	Implementasi dilakukan setelah Aplikasi direview bersamaan dengan anda. Apakah sudah sesuai dengan kebutuhan atau perlu penambahan. selanjutkan akan segera dilakukan Implementasi & Training ke tim ataupun Karyawan anda.
							      	</div>
						    </div>
					    </div>

					    <div class="panel panel-default">
						    <div class="panel-heading">
							      	<h4 class="panel-title">
							        	<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapse6">
							          		<i class="fa fa-check fa-1x" aria-hidden="true"></i> M a i n t e n a n c e 
							        	</a>
							      	</h4>
						    </div>
						    <div id="collapse6" class="panel-collapse collapse">
							      	<div class="panel-body">
							        	Bila dibutuhkan, kami siap untuk membantu anda melakukan maintenance dan update secara periodik, baik dari sisi Sistem aplikasi, database ataupun perawatan hardware pendukung sistem.
							      	</div>
						    </div>
					    </div>
					</div><!-- END Accordion -->
			    </div>


			  <div class="col-lg-6 col-md-6 col-sm-6 ">	
				   <div class="col-lg-12" style="color: #DA0000;">	
                         <h1>Our Strategic Partnership</h1>
					</div>

				   <div class="col-lg-2" style="color: #DA0000;">	
					    <i class="fa fa-compass fa-4x" aria-hidden="true"></i>
					</div>	
					<div class="col-lg-10" id="appsbox">	
					    <h3> Big Passion & Focus</h3>
				        Tim Kami memiliki passion yang besar di dalam dunia softwere developer, kami mengkhususkan pada Teknologi Digital. kami berusaha untuk selalu menjadi yang terbaik di bidang ini.
					</div>

				   <div class="col-lg-2" style="color: #DA0000;">	
					    <i class="fa fa-dashboard fa-4x" aria-hidden="true"></i>
					</div>	
					<div class="col-lg-10" id="appsbox">	
					     <h3> Intelligent Design UI UX</h3>
				        Tim Analisis dan Desainer Kami memiliki intuisi yang tajam dalam memecahkan permasalahan teknis. dari sisi kegunaan, fungsionalitas dan detail yang ditunjukkan melalui pekerjaan kami. kami percaya  buatan kami sangat menyenangkan untuk digunakan.
					</div>

					<div class="col-lg-2" style="color: #DA0000;">	
					    <i class="fa fa-code-fork fa-4x" aria-hidden="true"></i>
					</div>	
					<div class="col-lg-10" id="appsbox">	
					     <h3> Flexibility and Functionality</h3>
				        Kami dapat merancang dan membuat aplikasi khusus, atau memperbaiki aplikasi yang Anda gunakan saat ini.
					</div>

					<div class="col-lg-2" style="color: #DA0000;">	
					    <i class="fa fa-cogs fa-4x" aria-hidden="true"></i>
					</div>	
					<div class="col-lg-10" id="appsbox">	
					     <h3> Support & Maintenance After Sales</h3>
				        Setelah projek selesai, kami selalu menyediakan dukungan teknis yang solid melalui telepon, email, remote desktop dan tatap muka.
					</div>
			  </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
      <div class="gap-35"></div>
    </section>
    <!-- /. More Services End ./-->
<!-- HOWTOWORK BOX -->

  
@if(count($primarySchedule))
@foreach($news as $key => $value)
@endforeach
@endif



<!-- /. Staff Start ./-->
  
  <section class="staff-wrapp">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <!-- h2 class="main-title">{!! trans('main.capNews'); !!}</h2 -->
          <h4 class="sub-title">{!! trans('main.AllProject'); !!} <a href="{!! App::getLocale().'/'.$transnews !!}"> [portofolio]</a></h4>
        </div>
      </div>

      <div class="row">
 @if(count($news))
	        <div class="col-lg-12 col-md-3 col-sm-6">
				<?php
				  $post = strlen($value->post); 
				  $substrPost = substr($value->post, 0,100).' [...]';
				  $pageHome = App\Models\pages::where('lang_id', $lang->id)->where('code', 11111)->first();
                ?>
 
			        <ul class="lb-album">
			          	@foreach($news as $key => $value)
				            <li id="spaceimg"> 
				              	@if($value->thumb != 'null')
				              	<a href="#project-{!! $value->slug !!}"><img src="/img/posts/thumb/{!! $value->thumb !!}"> <span><i class="fa fa-search-plus"></i></span> </a>
			                	@else
			                    <img src="/img/posts/thumb/default-lite.png" alt="NOPIC">
			                	@endif

				                <div class="lb-overlay" id="project-{!! $value->slug !!}"> <img src="/img/posts/{!! $value->thumb !!}"/>
				                	<div>
				                  		<a href="#" class="homeSlug" data-home="{!! $pageHome->slug !!}" data-slug="{!! $value->slug !!}" alt="{!! $value->date_add !!}">{!! $value->title !!}</a>
				                	</div>
				                	<a href="#page" class="lb-close"><i class="fa fa-times-circle fa-1x"></i></a>
				                </div>
				            </li>
				        @endforeach
			        </ul>   
			         <div class="gap-clear"></div>
 
	        </div>
        @endif
    
         
      </div>
    </div>
  </section>
  
  <!-- /. Staff End ./-->
 


 




<!-- /. CONTENT -- Footer Start ./-->
<section id="footer">
  <!-- /. Footer Bottom Bar ./-->
  <section class="footer-mid">
  <div class="footer-midbg">
    <div class="container">
      <div class="row">
		@if(count($primarySchedule))
			<div class="col-lg-3 col-md-4 col-sm-6 getintouch">
				<?php 
				  $pageHome = App\Models\pages::where('lang_id', $lang->id)->where('code', 22222)->first(); 
				?>	
			    <h3>Recent Schedule</h3>
	  					@if($primarySchedule->thumb != 'null')
							<div class="title-primaryschedule" id="primary-schedule">
								{!! $primarySchedule->title !!}
							</div>
							<a href="javascript:;" class="homeSlug" data-home="{!! $pageHome->slug !!}" data-slug="{!! $primarySchedule->slug !!}"><img class="img-responsive" src="/img/posts/{!! $primarySchedule->thumb !!}" alt="#"></a>
						@else
							<div class="title-primaryschedule" id="primary-schedule">
								{!! $primarySchedule->title !!}
							</div>	
							<a href="javascript:;" class="homeSlug" data-home="{!! $pageHome->slug !!}" data-slug="{!! $primarySchedule->slug !!}"><img class="img-responsive" src="/img/posts/default.png" alt="#"></a>
						@endif
	        </div>

	        <div class="col-lg-9 col-md-3 col-sm-6">
				<?php
				 $post = strlen($primarySchedule->post); 
				 $substrPost = substr($primarySchedule->post, 0,200).' [...]';
				?>
	          	<h3>{!! trans('main.schedule') !!}</h3>
			        <ul class="recent-posts">
			        	@foreach($schedulers as $key => $value)
			            	<li><a href="javascript:;" class="homeSlug" data-home="{!! $pageHome->slug !!}" data-slug="{!! $value->slug !!}">{!! $value->title !!}</a></li>
			            @endforeach
			        </ul>
	        </div>
        @endif

      </div><!-- end ROW -->
    </div>
  </div>
</section>
<!-- /. Footer Copy rights ./-->
  
 

@endsection