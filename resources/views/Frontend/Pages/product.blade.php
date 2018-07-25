@extends('layouts.Frontend.content')
@section('title_page', 'Product')
@section('content')
<?php 
use App\Models\data_product;
$lang = App\Models\languages::where('code', App::getLocale())->first();
$products = data_product::where('status', 1)->where('lang_id', $lang->id)->groupBy('code')->get();
?>


 

 <!-- Features -->
        <section id="elements-features" class="pt100 pb100">
            <div class="container">   
                <div class="row">

                    <div class="col-md-12 text-center">
                        <h1><strong>Digital Marketing Product</strong></h1>
                        <p class="lead">we have several products that may be needed in your business. please do not hesitate to contact us</p>
                    </div>
 
 

                   <!-- KOLOM DUA -->
                    <div class="col-md-12 pt40 pb40">

                        <div class="col-md-6 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-telescope size-4x color"></i>
                                <i class="icon-telescope back-icon"></i> 
                                <div>
                                    <h4><strong>ADWORDS</strong><br></h4>
                                    <p>Vestibulum id interdum magna. Nulla faucibus dignissim nisi, ac fringilla dolor consequat et. Pellentesque ut metus nisi. Sed non fiibus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-circle-compass size-4x color"></i>
                                <i class="icon-circle-compass back-icon"></i> 
                                <div class="feature-left-content">
                                    <h4><strong>SME</strong> PACKAGE</h4>
                                    <p>Vestibulum id interdum magna. Nulla faucibus dignissim nisi, ac fringilla dolor consequat et. Pellentesque ut metus nisi. Sed non fiibus.</p>
                                </div>
                            </div>
                        </div>

 

                        <div class="col-md-4 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-telescope size-4x color"></i>
                                <i class="icon-telescope back-icon"></i> 
                                <div>
                                    <h4><strong>SOCIAL </strong> ADS</h4>
                                    <p>Vestibulum id interdum magna. Nulla faucibus dignissim nisi, ac fringilla dolor consequat et. Pellentesque ut metus nisi. Sed non fiibus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-circle-compass size-4x color"></i>
                                <i class="icon-circle-compass back-icon"></i> 
                                <div class="feature-left-content">
                                    <h4><strong>SOCIAL</strong> INFLUENCER</h4>
                                    <p>Vestibulum id interdum magna. Nulla faucibus dignissim nisi, ac fringilla dolor consequat et. Pellentesque ut metus nisi. Sed non fiibus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-genius size-4x color"></i>
                                <i class="icon-genius back-icon"></i> 
                                <div class="feature-left-content">
                                    <h4><strong>SOCIAL </strong> MANAGEMENT</h4>
                                    <p>Vestibulum id interdum magna. Nulla faucibus dignissim nisi, ac fringilla dolor consequat et. Pellentesque ut metus nisi. Sed non fiibus.</p>
                                </div>
                            </div>
                        </div>
                        




                        <div class="col-md-6 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-telescope size-4x color"></i>
                                <i class="icon-telescope back-icon"></i> 
                                <div>
                                    <h4><strong>CAMPAIGN </strong> PRODUCT SERVICE</h4>
                                    <p>Vestibulum id interdum magna. Nulla faucibus dignissim nisi, ac fringilla dolor consequat et. Pellentesque ut metus nisi. Sed non fiibus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-circle-compass size-4x color"></i>
                                <i class="icon-circle-compass back-icon"></i> 
                                <div class="feature-left-content">
                                    <h4><strong>CAMPAIGN </strong> INDIVIDUAL / ORGANISATION</h4>
                                    <p>Vestibulum id interdum magna. Nulla faucibus dignissim nisi, ac fringilla dolor consequat et. Pellentesque ut metus nisi. Sed non fiibus.</p>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-6 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-telescope size-4x color"></i>
                                <i class="icon-telescope back-icon"></i> 
                                <div>
                                    <h4><strong>SEO & </strong> SEM</h4>
                                    <p>Vestibulum id interdum magna. Nulla faucibus dignissim nisi, ac fringilla dolor consequat et. Pellentesque ut metus nisi. Sed non fiibus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-circle-compass size-4x color"></i>
                                <i class="icon-circle-compass back-icon"></i> 
                                <div class="feature-left-content">
                                    <h4><strong>AUDIO & VIDEO </strong> DEVELOPMENT</h4>
                                    <p>Vestibulum id interdum magna. Nulla faucibus dignissim nisi, ac fringilla dolor consequat et. Pellentesque ut metus nisi. Sed non fiibus.</p>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-6 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-telescope size-4x color"></i>
                                <i class="icon-telescope back-icon"></i> 
                                <div>
                                    <h4><strong>CREATIVE CONTENT </strong> DEVELOPMENT</h4>
                                    <p>Vestibulum id interdum magna. Nulla faucibus dignissim nisi, ac fringilla dolor consequat et. Pellentesque ut metus nisi. Sed non fiibus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-circle-compass size-4x color"></i>
                                <i class="icon-circle-compass back-icon"></i> 
                                <div class="feature-left-content">
                                    <h4><strong>ECOMMERCE </strong> MAINTENANCE</h4>
                                    <p>Vestibulum id interdum magna. Nulla faucibus dignissim nisi, ac fringilla dolor consequat et. Pellentesque ut metus nisi. Sed non fiibus.</p>
                                </div>
                            </div>
                        </div>





                    </div>






 <!-- Start Price List 2 -->
        <section class="pt100 pb100 pricing-2">
            <div class="container">
                <div class="row"> 

                    <div class="col-md-12 mr-auto">
                        
                        <div class="col-md-6 price-table">
                            <div class="price-box"> 
                                <h3><strong>How We Do It ?</strong></h3>
 
                                <div class="price-features">  
                                    <p class="lead"><i class="ion-checkmark-round"></i> Research</p> 
                                    <p class="lead"><i class="ion-checkmark-round"></i> Planning</p>
                                    <p class="lead"><i class="ion-checkmark-round"></i> Development</p>
                                    <p class="lead"><i class="ion-checkmark-round"></i> Monitoring</p> 
                                    <p class="lead"><i class="ion-checkmark-round"></i> Optimization</p>
                                    <p class="lead"><i class="ion-checkmark-round"></i> Report</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 price-table">
                            <div class="price-box"> 
                                <h3><strong>&nbsp;</strong></h3>
                                <div class="price-features">  
                                    <p class="lead">Why Tinatar ?</p> 
                                    <p class="lead">What Tinatar ?</p>
                                    <p class="lead">Who Tinatar ?</p>
                                    <p class="lead">Where Tinatar ?</p> 
                                    <p class="lead">&nbsp;</p> 
                                    <p class="lead">&nbsp;</p> 
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
        </section>        
        <!-- End Price List 2 -->

















  
                    <!-- div class="col-md-12 pt40 pb40">
                    @if(count($products))
                        @foreach($products as $product)
                        <div class="col-md-12 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-telescope back-icon"></i> 
                                <div>
                                    <h4><strong>{!! $product->product !!}</strong></h4>

                                        @if($product->img_thumbnail == 'null')
                                        <img class="img-responsive" src="/img/produk/default.png" alt="#">
                                        @else
                                        <img class="img-responsive" src="/img/produk/{!! $product->img_thumbnail !!}" alt="#">
                                        @endif

                                    {!! $product->description !!}
                                </div>

                                <a href="{{ url(App::getLocale().'/'.$page->slug.'/'.$product->slug) }}" button type="button" class="btn btn-md btn-ghost"> ORDER </a>
                            </div>
                        </div>
                        @endforeach
                    @endif  
                    </div -->
                </div>
            </div>
        </section>
        <!-- End Features -->
@endsection



@section('js')
<script type="text/javascript">
  $('.order').click(function() {
    window.location.replace('/produk/');
  });
</script>
@endsection
 


