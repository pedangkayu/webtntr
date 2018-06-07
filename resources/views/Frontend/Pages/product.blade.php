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
                        <h1><strong>Our Product</strong></h1>
                        <p class="lead">we have several products that may be needed in your business. please do not hesitate to contact us</p>
                    </div>
 
 
  
                    <div class="col-md-12 pt40 pb40">
                    

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
                        
                    </div>

           
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
 


