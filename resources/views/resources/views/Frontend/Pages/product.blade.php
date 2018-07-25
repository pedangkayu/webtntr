@extends('layouts.Frontend.content')
@section('title_page', 'Product')
@section('content')
<?php 
use App\Models\data_product;
$lang = App\Models\languages::where('code', App::getLocale())->first();
$products = data_product::where('status', 1)->where('lang_id', $lang->id)->groupBy('code')->get();
?>
  <section id="hservices">
    <div class="container">

      <div class="row gallery">
		@if(count($products))
		    @foreach($products as $product)

          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="hservice">
              <ul>
                <li>
				  <div class="posttitle" style="color: #82abea;">{!! $product->product !!}</div>
				  <div class="mtop1"></div>
                  <div class="block-image">
                     
                     @if($product->img_thumbnail == 'null')
					    <img class="img-responsive" src="/img/produk/default.png" alt="#">
					 @else
                        <img class="img-responsive" src="/img/produk/{!! $product->img_thumbnail !!}" alt="#">
                     @endif

                    <div class="img-overlay-3-up pat-override"></div>
                    <div class="img-overlay-3-down pat-override"></div>
                  </div>
                </li>

                <li>
                    <div class="postarchives">{!! $product->description !!}</div>
					 <div class="mtop1"></div>

					 <button type="button" class="btn btn-default slugdetail" data-slug="{!! $product->slug !!}" style="color: white"> ORDER </button>
                </li>
              </ul>
            </div>
          </div>
          @endforeach
		  @endif


       </div>
    </div>
  </section><!-- END KOLOM BERITA --> 
@endsection

@section('js')
<script type="text/javascript">
  $('.order').click(function() {
    window.location.replace('/produk/');
  });
</script>
@endsection


