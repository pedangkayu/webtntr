@extends('layouts.app')

@section('content')
    <div class="row">

      <!-- BEGIN ALERT - REVENUE -->
      <div class="col-md-3 col-sm-6">
        <div class="card">
          <div class="card-body no-padding">
            <div class="alert alert-callout alert-info no-margin">
              <strong class="pull-right text-success text-lg">{{ $book->total_book > 0 ? number_format((($book->new / $book->total_book) * 100),0, '.',',') : 0 }}%</strong>
              <strong class="text-xl">{{ $book->new }}</strong><br/>
              <span class="opacity-50">New Booking</span>
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
              <strong class="pull-right text-warning text-lg">{{ $book->total_book > 0 ? number_format((($book->unpaid / $book->total_book) * 100),0,'.',',') : 0 }}%</strong>
              <strong class="text-xl">{{ $book->unpaid }}</strong><br/>
              <span class="opacity-50">Unpaid Booking</span>
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
              <strong class="pull-right text-danger text-lg">{{ $book->total_book > 0 ? number_format((($book->paid / $book->total_book) * 100),0,'.',',') : 0 }}%</strong>
              <strong class="text-xl">{{ $book->paid }}</strong><br/>
              <span class="opacity-50">Paid Booking</span>
            </div>
          </div><!--end .card-body -->
        </div><!--end .card -->
      </div><!--end .col -->
      <!-- END ALERT - BOUNCE RATES -->

      <!-- BEGIN ALERT - TIME ON SITE -->
      <div class="col-md-3 col-sm-6">
        <div class="card">
          <div class="card-body no-padding">
            <div class="alert alert-callout alert-warning no-margin">
              <strong class="pull-right text-danger text-lg">{{ $book->total_book > 0 ? number_format((($book->cancel / $book->total_book) * 100),0,'.',',') : 0 }}%</strong>
              <strong class="text-xl">{{ $book->cancel }}</strong><br/>
              <span class="opacity-50">Cancel Booking</span>
            </div>
          </div><!--end .card-body -->
        </div><!--end .card -->
      </div><!--end .col -->
      <!-- END ALERT - TIME ON SITE -->

    </div><!--end .row -->

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <select name="tahun_income" class="pull-right" onchange="getIncome(this.value);">
                @for($i = 2000; $i <= date('Y'); $i++)
                  <option value="{{ $i }}" {!! date('Y') == $i ? 'selected' : '' !!}>{{ $i }}</option>
                @endfor
              </select>
              <h4 class="text-muted">STATISTIC INCOME</h4>
            </div>
            <canvas id="income" width="100%" height="30"></canvas>
          </div>

          <div class="card-body">
            <table class="table table-income">
              <tr>
                <td>Loading...</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('footer')
	<script type="text/javascript" src="{{ asset('/vendor/chartjs/Chart.bundle.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/modules/dasboard/dasboard.js') }}"></script>
@endsection
