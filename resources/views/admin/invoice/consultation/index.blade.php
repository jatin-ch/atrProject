@extends('layouts.app')
@section('content')

<!-- <div class="container">
    <div class="row"> -->
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Generated Consultation Invoices
                </div>

                <div class="panel-body">
                 <table class="table">
                   <thead>
                     <th>Invoice Number</th>
                     <th>Booking</th>
                     <th>Booking Type</th>
                     <th>Invoice Date</th>
                     <th>Status</th>
                     <th>Consulting Fees</th>
                     <th></th>
                   </thead>
                   <tbody>
                     @foreach($invoices as $invoice)
                     <tr>
                     <th>{{ $invoice->id }}</th>
                     <td>{{ $invoice->booking }}</td>
                     <td>Consultation</td>
                     <td>{{ date('jS M Y', strtotime($invoice->created_at)) }}</td>
                     <td>{{ $invoice->status }}</td>
                     <td>INR {{ $invoice->consulting_fee }}/-</td>
                     <td>
                       <button class="btn btn-default btn-sm" data-target="#sl2{{$invoice->id}}" data-toggle="modal">View</button>
                      <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl2{{$invoice->id}}" tabindex="-1">
                      <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                      <div class="modal-header">
                      <button class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Invoice Number <strong>{{ $invoice->id }}</strong>, Invoice Date <strong>{{ date('jS M Y', strtotime($invoice->created_at)) }}</strong></h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-3">
                            <small>Invoice By</small>
                            <p><strong>{{ $invoice->user->name }}</strong></p>
                          </div>
                          <div class="col-md-3">
                            <small>Invoice To</small>
                            <p><strong>{{ $invoice-> }}</strong></p>
                          </div>
                        </div>

                        <table class="table">
                          <thead>
                            <th>Sr. No.</th>
                            <th>Booking ID</th>
                            <th>Expertise</th>
                            <th>Consultation Mode</th>
                            <th>Consulting Fees</th>
                            <th>Adviceli Commision</th>
                          </thead>
                          <tbody>
                            @foreach($invoice->ConsultationInvoiceDetails as $detail)
                            <tr>
                              <th>{{ $detail->id }}</th>
                              <td>{{ $detail->consultation_booking_id }}</td>
                              <td>{{ $detail->experties }}</td>
                              <td>{{ $detail->consultation_mode }}</td>
                              <td>INR {{ $detail->consulting_fee }}/-</td>
                              <td>INR {{ $detail->adviceli_commision }}/-</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      </div>
                      </div>
                      </div>
                     </td>
                     <tr>
                       @endforeach
                   </tbody>
                 </table>
                </div>
            </div>
        </div>
    <!-- </div>
</div> -->

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
    var max_fields1      = 4;
    var wrapper1         = $(".input_fields_wrap1");
    var add_button1      = $(".add_field_button1");

    var x1 = 1;
    $(add_button1).click(function(e){
        e.preventDefault();
        if(x1 < max_fields1){
            x1++;
            $(wrapper1).append('<div style="margin-top:20px"><input type="text" name="benifit[]" class="form-control"><a href="#" class="remove_field">Remove</a></div>');
        }
    });

    $(wrapper1).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x1--;
    });


    var max_fields2      = 4;
    var wrapper2         = $(".input_fields_wrap2");
    var add_button2      = $(".add_field_button2");

    var x2 = 1;
    $(add_button2).click(function(e){
        e.preventDefault();
        if(x2 < max_fields2){
            x2++;
            $(wrapper2).append('<div style="margin-top:20px"><input type="text" name="include[]" class="form-control"><a href="#" class="remove_field">Remove</a></div>');
        }
    });

    $(wrapper2).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x2--;
    });


    $("#field1").keyup(function(){
          $("#field3").val($("#field1").val() - $("#field2").val());
    });
    $("#field2").keyup(function(){
          $("#field3").val($("#field1").val() - $("#field2").val());
    });

});
</script
