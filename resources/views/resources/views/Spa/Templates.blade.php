@extends('layouts.app')

@section('meta')
<style media="screen">
  .btn-add{
    position: fixed;
    bottom: 10%;
    right: 5%;
  }
  .btn-back{
    position: fixed;
    bottom: 10%;
    right: 9%;
  }
</style>
@endsection

@section('content')
    <div class="row">
      @foreach($tems as $tmp)
      <div class="col-sm-3">
        <div class="card">
          <img src="{{ asset('/tems/' . $tmp->template_path . '/thumbnail.jpg') }}" class="img img-responsive" width="500" height="500">
          <div class="card-body text-center">
            <h4>{{ $tmp->template_name }}</h4>
          </div>
          @if($spa->template_id !=  $tmp->id)
            @if($tmp->for_premium == 1 && $spa->premium == 0)
              <div class="card-actionbar">
                  <div class="card-actionbar-row">
                      <button type="button" class="btn btn-block btn-danger" onclick="alert('You must upgrade to Premium Member');">PREMIUM TEMPLATE</button>
                  </div>
              </div>
            @else
            <div class="card-actionbar">
                <div class="card-actionbar-row">
                    <button onclick="use({{ $tmp->id }}, {{ $spa->id_spa }});" type="button" class="btn btn-block btn-flat btn-accent ink-reaction">Use Template</button>
                </div>
            </div>
            @endif
          @else
          <div class="card-actionbar">
              <div class="card-actionbar-row">
                  <a href="{{ url($spa->slug) }}" target="_blank" class="btn btn-default btn-block"><strong>Go PAGE</strong></a>
              </div>
          </div>
          @endif

        </div>

      </div>
      @endforeach
    </div>

    <a href="{{ url('/spa/' . $spa->id_spa) }}" title="Add new" class="animated bounceInDown btn ink-reaction btn-floating-action btn-primary btn-add"><i class="fa fa-chevron-left"></i></a>
@endsection

@section('footer')
  <script type="text/javascript">
    $(function(){
      use = function(id, id_spa){
        toastr.warning('Request...');
        $.post(base_url('/ajax/usetempate'), {
          template_id : id,
          id_spa : id_spa
        }, function(json){
          toastr.success(json.err);
          window.location.reload();
        });
      }

    });
  </script>
@endsection
