@extends('layouts.adviser')
@section('title') | Verification-details @endsection
@section('content')



<section class="content-header">
      <h1>
        Profile {{$pw}}% complete
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
        <li class="active">Verification Detail</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section class="content">
<div class="row">
    <div class="col-sm-12">
        <h4><b>ATTACHMENTS</b></h4>
        <p>1.Please upload your qualication,Degree, Govt. authority letter,Award certification, Experience letter, ID proof,</br>  AAdhar Card/Firm SRN/TIN certication, these things will not be visible to user & this is adviseli verification & process only.</br></br>2.File should not be more than 5 MB</p>

        </div>
         <div class="col-md-8 col-md-offset-2">
           {!! Form::open(['route' => ['adviser.verifications.store'], 'method' => 'POST', 'files' => true]) !!}
             <div class="form-group">
               <table class="table">
                 <tbody>
                   <tr>
                   <td style="border:none">
                     {{ Form::label('qualification', 'QUALIFICATION CERTIFICATE (Only pdf) *', ['style' => 'margin-top:20px']) }}
                     {{ Form::file('qualification', ['class' => 'form-control']) }}
                   </td>
                   <td style="border:none">
                     {{ Form::label('degree', 'COLLEGE DEGREE (Only pdf) *', ['style' => 'margin-top:20px']) }}
                     {{ Form::file('degree', ['class' => 'form-control']) }}
                   </td>
                 </tr>
                 <tr>
                 <td style="border:none">
                   {{ Form::label('govt_auth_letter', 'GOVT. AUTHEORIZE LETTER (Only pdf) *', ['style' => 'margin-top:20px']) }}
                   {{ Form::file('govt_auth_letter', ['class' => 'form-control']) }}
                 </td>
                 <td style="border:none">
                   {{ Form::label('award_certi', 'AWARD CERTIFICATE (Only pdf)', ['style' => 'margin-top:20px']) }}
                   {{ Form::file('award_certi', ['class' => 'form-control']) }}
                 </td>
               </tr>
                 <tr>
                 <td style="border:none">
                   {{ Form::label('exp_letter', 'EXPERIENCE LETTER (Only pdf)', ['style' => 'margin-top:20px']) }}
                   {{ Form::file('exp_letter', ['class' => 'form-control']) }}
                 </td>
                 <td style="border:none">
                   {{ Form::label('id_proof', 'ID PROOF (Only jpeg) *', ['style' => 'margin-top:20px']) }}
                   {{ Form::file('id_proof', ['class' => 'form-control']) }}
                 </td>
                  </tr>
                  <tr>
                  <td style="border:none">
                    {{ Form::label('aadhar_card', 'AADHAR CARD (Only jpeg) *', ['style' => 'margin-top:20px']) }}
                    {{ Form::file('aadhar_card', ['class' => 'form-control']) }}
                  </td>
                  <td style="border:none">

                  </td>
                   </tr>
                 </tbody>
               </table>
               <input type="checkbox" name="agree" value="1"> I agree with terms & conditions
               <br>
               <div class="row">
                 <div class="col-md-2 col-md-offset-5">
                   {{ Form::submit('Save & Next', ['class' => 'btn btn-success']) }}
                 </div>
               </div>
             </div>
             {!! Form::close() !!}
        </div>
</div>
</section>


@endsection
