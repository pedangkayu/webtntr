@extends('layouts.app')

@section('content')

  <div class="row">
    <div class="col-sm-4">
      <div class="card">
    		<div class="card-body">
          <strong class="pull-right label label-info">{{ $status[$book->status] }}</strong>
          <address>

            @if($book->paypal_status)
              <strong>PayPal Payment ID</strong>
              <p>{{ $book->paypal_payment_id }}</p>

              <strong>PayPal Date</strong>
              <p>{{ date('M d, Y \/ h:i A', strtotime($book->paypal_date)) }}</p>
            @endif

            <strong>How Many Person(s)</strong>
            <p>{{ $book->qty_person }} person</p>

            <strong>Spa Date & Time</strong>
            <p>{{ date('d M Y', strtotime($book->day_request)) }} at {{ date('h:i A', strtotime($book->time_request)) }}</p>

            <strong>Special Request</strong>
            <p>{{ $book->note }}</p>
            <hr />
            <strong>Name</strong>
            <p>{{ $book->title }} {{ $book->name_customer }}</p>

            <div class="row">
              <div class="col-sm-6">
                <strong>Email</strong>
                <p>{{ $book->email }}</p>
              </div>
              <div class="col-sm-6">
                <strong>Phone</strong>
                <p>{{ $book->phone }}</p>
              </div>
            </div>

            <strong>Address</strong>
            <p>{{ $book->address }}</p>

            <div class="row">
              <div class="col-sm-6">
                <strong>Country of Origin</strong>
                <p>{{ $book->nm_country }}</p>
              </div>
              <div class="col-sm-6">
                <strong>City</strong>
                <p>{{ $book->city }}</p>
              </div>
            </div>

            @if(!empty($book->hotel))
            <hr />
            <strong>Hotel In Bali</strong>
            <p>{{ $book->hotel }}</p>

            <div class="row">
              <div class="col-sm-6">
                <strong>Data Check In Hotel</strong>
                <p>{{ empty($book->checkin_hotel) ? '-' : date('d M Y', strtotime($book->checkin_hotel)) }}</p>
              </div>
              <div class="col-sm-6">
                <strong>Hotel Telephone</strong>
                <p>{{ $book->contact_hotel }}</p>
              </div>
            </div>
            @endif
          </address>

    		</div>
    	</div>
    </div>

    <div class="col-sm-4">
      <form class="form" action="{{ url('/booking/' . $book->id_booking) }}" method="post">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <div class="card">
      		<div class="card-body">
            <h4><strong>Biling #{{ $book->code }}</strong></h4>
      			<table class="table">
              <tbody>
                <tr>
                  <td>Sub Total</td>
                  <td class="text-right">{{ number_format($subtotal,2,'.',',') }} {{ $book->iso_code }}</td>
                </tr>

                <tr>
                  <td>Person/Pax &nbsp;&nbsp;
                    <select name="qty_person" class="pull-right">
                      @for($i = $service->minimal_pax; $i < ($service->minimal_pax + 50); $i++)
                        <option value="{{ $i }}" {!! $i == $book->qty_person ? 'selected' : '' !!}>{{ $i }}</option>
                      @endfor
                    </select>
                  </td>
                  <td class="text-right">{{ number_format($person,2,'.',',') }} {{ $book->iso_code }}</td>
                </tr>

                <tr>
                  <td>Discount <span class="pull-right"><input type="number" name="discount" style="width:50px;padding:1px;margin:0px;" class="text-right" value="{{ number_format($book->discount,0) }}">%</span></td>
                  <td class="text-right">{{ number_format($discount,2,'.',',') }} {{ $book->iso_code }}</td>
                </tr>

                <tr>
                  <td>Other</td>
                  <td class="text-right">
                    <input type="number" name="total_other" style="width:100px;padding:1px;margin:0px;" class="text-right" value="{{ $book->total_other }}">
                  </td>
                </tr>

                <tr>
                  <td>Tax & Service &nbsp;&nbsp;
                    <select name="tax" class="pull-right">
                      @foreach($taxs as $tax)
                        <option value="{{ $tax->tax }}" {!! $tax->tax == $book->tax ? 'selected' : '' !!}>{{ $tax->tax }}%</option>
                      @endforeach
                    </select>
                  </td>
                  <td class="text-right">{{ number_format($pajax,2,'.',',') }} {{ $book->iso_code }}</td>
                </tr>
                <tr>
                  <td><h4 class="text-danger"><strong>Total</strong></h4></td>
                  <td class="text-right"><h4 class="text-danger"><strong>{{ number_format($book->grandtotal,2,'.',',') }} {{ $book->iso_code }}</strong></h4></td>
                </tr>

                <tr>
                  <td colspan="2">
                    <textarea name="invoice_note" rows="5" class="form-control" placeholder="Invoice note...">{{ $book->invoice_note }}</textarea>
                  </td>
                </tr>

              </tbody>
      			</table>
      		</div>
      		<div class="card-actionbar">
      				<div class="card-actionbar-row">
      						<button type="submit" class="btn btn-flat btn-accent ink-reaction">Update Biling</button>
      				</div>
      		</div><!--end .card-actionbar -->

      	</div>
      </form>

      <div class="card">
    		<div class="card-body">
    			<table class="table">
            <thead>
              <tr>
                <th>Document</th>
                <th class="text-right">Process</th>
              </tr>
            </thead>
    			  <tbody>
    			    <tr>
    			      <td><strong>INVOICE - #{{ $book->code }}</strong></td>
                <td class="text-right">
                  <button type="button" name="button" class="btn btn-success btn-sm" title="send Invoice" onclick="sendInvoice({{ $book->id_booking }});"><i class="fa fa-paper-plane"></i></button>
                  <a class="btn btn-info btn-sm" title="Print Invoice" href="{{ url('/print/invoice/' . $book->id_booking) }}" target="_blank"><i class="fa fa-print"></i></a>
                </td>
    			    </tr>
              <tr>
    			      <td><strong>VOUCHER - #{{ $book->code }}</strong></td>
                <td class="text-right">
                  <button data-toggle="modal" data-target="#myModal" type="button" name="button" class="btn btn-success btn-sm" title="send Voucher"><i class="fa fa-paper-plane"></i></button>
                  <a target="_blank" class="btn btn-info btn-sm" title="Print Voucher" href="{{ url('/print/voucher/' . $book->id_booking) }}"><i class="fa fa-print"></i></a>
                </td>
    			    </tr>
    			  </tbody>
    			</table>
    		</div>
    	</div>
    </div>

    <div class="col-sm-4">
      <div class="card">
        <img src="{{ asset('/img/servicepack/' . $service->img_thumbnail) }}" class="img img-responsive">
    		<div class="card-body">

          <address>
            <strong>{{ $service->type == 1 ? 'Service' : 'Package' }}</strong>
            <p><a href="{{ url($spa->slug . '/servicepack/' . $service->slug) }}" target="_blank">{{ $service->servicepack }} <i class="fa fa-external-link"></i></a></p>
            <strong>Spa Name</strong>
            <p><a href="{{ url($spa->slug) }}" target="_blank">{{ $spa->spa }} <i class="fa fa-external-link"></i></a></p>
            <strong>Spa Level</strong>
            <p>{!! $spa->premium ? '<i class="fa fa-shield text-success"></i> Premium' : '<i class="fa fa-shield text-warning"></i> Free' !!}</p>
          </address>

    		</div>
    	</div>
    </div>

  </div>
@endsection

@section('footer')
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">VOUCHER NOTE</h4>
      </div>
      <div class="modal-body">
        <textarea name="voucher_note" style="width:100%;padding:10px;border-color:#ddd;" rows="5">{{ $book->note_voucher }}</textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-flat pull-left" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" onclick="sendVoucher({{ $book->id_booking }});">Send Voucher</button>
      </div>
    </div>
  </div>
  </div>

  <script type="text/javascript" src="{{ asset('/js/modules/booking/show.js') }}"></script>
@endsection
