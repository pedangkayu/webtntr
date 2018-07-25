@extends('layouts.app')

@section('content')

<!-- BEGIN ALERT - REVENUE -->
<div class="col-md-3 col-sm-6">
  <div class="card">
    <div class="card-body no-padding">
      <div class="alert alert-callout alert-info no-margin">
        <strong class="pull-right text-success text-lg">{{ $count->total_all > 0 ? number_format((($count->unpaid / $count->total_all) * 100),0, '.',',') : 0 }}%</strong>
        <strong class="text-xl">{{ $count->unpaid }}</strong><br/>
        <span class="opacity-50">UNPAID</span>
        <div class="stick-bottom-left-right">
          <div class="height-2 sparkline-revenue" data-line-color="#bdc1c1"></div>
        </div>
      </div>
    </div><!--end .card-body -->
  </div><!--end .card -->
</div><!--end .col -->
<!-- END ALERT - REVENUE -->

<!-- BEGIN ALERT - VISITS -->
<div class="col-md-3 col-sm-6">
  <div class="card">
    <div class="card-body no-padding">
      <div class="alert alert-callout alert-danger no-margin">
        <strong class="pull-right text-warning text-lg">{{ $count->total_all > 0 ? number_format((($count->moderator / $count->total_all) * 100),0,'.',',') : 0 }}%</strong>
        <strong class="text-xl">{{ $count->moderator }}</strong><br/>
        <span class="opacity-50">ON MODERATOR</span>
        <div class="stick-bottom-right">
          <div class="height-1 sparkline-visits" data-bar-color="#e5e6e6"></div>
        </div>
      </div>
    </div><!--end .card-body -->
  </div><!--end .card -->
</div><!--end .col -->
<!-- END ALERT - VISITS -->

<!-- BEGIN ALERT - BOUNCE RATES -->
<div class="col-md-3 col-sm-6">
  <div class="card">
    <div class="card-body no-padding">
      <div class="alert alert-callout alert-success no-margin">
        <strong class="pull-right text-danger text-lg">{{ $count->total_all > 0 ? number_format((($count->paid / $count->total_all) * 100),0,'.',',') : 0 }}%</strong>
        <strong class="text-xl">{{ $count->paid }}</strong><br/>
        <span class="opacity-50">PAID</span>
      </div>
    </div><!--end .card-body -->
  </div><!--end .card -->
</div><!--end .col -->
<!-- END ALERT - BOUNCE RATES -->

<!-- BEGIN ALERT - TIME ON SITE -->
<div class="col-md-3 col-sm-6">
  <div class="card">
    <div class="card-body no-padding">
      <a href="{{ url('/bandung/invoice') }}">
      <div class="alert alert-callout alert-warning no-margin">
        <strong class="text-xl">{{ $count->new_invoice }} INVOICE</strong><br/>
        <span class="opacity-50">ON MODERATOR</span>
      </div>
      </a>
    </div><!--end .card-body -->
  </div><!--end .card -->
</div><!--end .col -->
<!-- END ALERT - TIME ON SITE -->

</div><!--end .row -->

    <div class="row">
      <div class="col-sm-9">

        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <select name="tahun_income" class="pull-right" onchange="getIncome(this.value);">
                @for($i = 2000; $i <= date('Y'); $i++)
                  <option value="{{ $i }}" {!! date('Y') == $i ? 'selected' : '' !!}>{{ $i }}</option>
                @endfor
              </select>
              <h4 class="text-muted">STATISTIC INCOME BANDUNG TEAM</h4>
            </div>
            <canvas id="income" width="100%" height="40"></canvas>


          </div>
        </div>

      </div>
      <div class="col-sm-3">

        <div class="card">
          <div class="card-body">
            <h4 class="text-muted">UNPAID SHARE PROFIT</h4>
            <table class="table">
                <thead>
                  <tr>
                    <th>CURRENCY</th>
                    <th class="text-right">TOTAL</th>
                  </tr>
                </thead>
                <tbody class="list-share-profit">
                  <tr>
                    <td colspan="2">Loading...</td>
                  </tr>
                </tbody>
            </table>
          </div>

        </div>


      </div>
    </div>

    <div class="card">
  		<div class="card-body">

        <h4>PROFIT BANDUNG TEAM <span class="tahun">{{ date('Y') }}</span></h4>
        <table class="table table-income">
          <tr>
            <td>Loading...</td>
          </tr>
        </table>

  		</div>
  	</div>

@endsection


@section('footer')
	<script type="text/javascript" src="{{ asset('/vendor/chartjs/Chart.bundle.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/modules/bandung/dashboard.js') }}"></script>
@endsection
