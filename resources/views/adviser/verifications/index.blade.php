@extends('layouts.adviser')
@section('title') | Verification-details @endsection
@section('content')



<script>
 $('input').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });
</script>
<section class="content-header">
      <h1>
        Profile {{$pw}}% complete
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
        <li class="active">Payment Detail</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section class="content">
  <div class="row basicdetail">
    <div class="col-lg-offset-1 col-lg-10">
      <div class="col-md-3">
        <small>Qualification Letter</small>
        <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->qualification) }}">Download</a></strong></p>
        <small>College Degree</small>
        <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->degree) }}">Download</a></strong></p>
      </div>
      <div class="col-md-3">
        <small>Govt. Auth. Letter</small>
        <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->govt_auth_letter) }}">Download</a></strong></p>
        <small>Award Certificate</small>
        <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->award_certi) }}">Download</a></strong></p>
      </div>
      <div class="col-md-3">
        <small>Experience Letter</small>
        <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->exp_letter) }}">Download</a></strong></p>
        <small>Id Proof</small>
        <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->id_proof) }}">Download</a></strong></p>
      </div>
      <div class="col-md-3">
        <small>Aadhar Card</small>
        <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->aadhar_card) }}">Download</a></strong></p>
      </div>
    </div>
  </div>
</section>


@endsection
