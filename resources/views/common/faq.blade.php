@extends('layouts.website')
@section('title') | Faq @endsection
@section('content')
<style>
    p{
        font-size:14px;
        color:black;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <h2>CONSULTATION</h2><br>
        <h3>For Users</h3>
        </div>
         <div class="col-lg-12">
             <h3>How do I select and book a Consultation of my choice?</h3><br>
             <p>
                 You can select and book an Adviser/Expert for availing a Consultation from the Categories and Sub-Categories of the website.
You can further filter the options according to experience, Charges, Availability, etc.

             </p>
              <h3>How do I select and book a Consultation of my choice?</h3><br>
             <p>
                 In case of <b>Phone-call</b> appointment, our server will call you to connect with the Adviser. The minute you pick up the call, you will be connected to the Adviser.
             </p>
             <p>
                 In case of <b>Chat</b> appointment, either the User or the Adviser can initiate the chat from the Chat panel.
             </p>
             <p>
                In case of <b>Video-call</b> appointment, you need to be logged in and available before your system to take the call. Either you or the Adviser can initiate the call by clicking on Video-call button.
             </p>
              <p>
                In case of <b>Personal meeting</b> appointment, user will have to be present at the location given by Adviser for the meeting.
             </p>
         </div>
         <div class="col-lg-12">
             <h3>How much will I be paying for one Consultation?</h3>
<br>
<p>
   As each expert specializes in their respective fields; their fee varies from the area of consultation and expertise level.
</p>
<h3>Are the expert listed on Adviceli qualified or experienced enough to give advice?
</h3>
<br>
<p>
   We believe in serving you the best out of all. We personally verify their qualification and experience before listing them.

</p>
<h3>Is the consultation fee refundable?
</h3>
<br>
<p>
   Yes, the fee is 100% refundable, if you cancel the appointment or even if you are unsatisfied with the consultation provided by the expert.

</p>



<h3>What if I am not satisfied by the Consultation provided?
</h3>
<br>
<p>
   In case of dissatisfaction from a Consultation; the appointment will be rescheduled with the same Adviser or any other Adviser of User's choice.

</p>

<h3>Is there any extra cost involved in consulting an expert?
</h3>
<br>
<p>
   No, there is no extra cost. You only need to pay the consultation fee that is mentioned on the panel.

</p>
<h3>Can I cancel/reschedule the appointment? How?
</h3>
<br>
<p>
   Yes, you can do the same at least 4 hours prior to the scheduled time. For rescheduling the User have to book a fresh appointment with the Advisers.

</p>
<h3>Are there any cancellation charges?
</h3>
<br>
<p>
   Phone Call: If not canceled 30 Minutes in advance then penalty is INR 50 or 5% of the fees, whichever is higher.<br>
Video Call: If not canceled 1 hour in advance then penalty is INR 50.or 5% of the fees, whichever is higher.<br>
Change in Location: If not canceled 1 hour in advance then penalty is INR 100.or 5% of the fees, whichever is higher.<br>
Chat: If User does not reply on the chat till 12 hours then it will be auto canceled and the User will be penalized by 10% of the entire amount.
</p>

<h3>What if the Adviser cancels an appointment?
</h3>
<br>
<p>
   The probability is very less, but in case an Adviser cancels the appointment, we will inform you via SMS or drop an email at your registered mail id. You can then either book the appointment again or claim for 100% refund.

</p>
<h3>What if the Adviser is not available for Chat/ Video-call/ Phone-call at the scheduled time?
</h3>
<br>
<p>
   Two trials will be made within 2 minutes to connect you with the Adviser and after that the appointment will be canceled. The defaulter will be penalized.
</p>

<h3>What if, I am unable to take the scheduled call?
</h3>
<br>
<p>
   We will give another call after a 5 minutes interval. If this call goes unanswered as well then the appointment will be automatically canceled. You can always reschedule an appointment in advance.
</p>
<h3>What if, I am unable to attend scheduled Video-call or Personal Meeting?
</h3>
<br>
<p>
   We would insist that you attend the appointment as per schedule. In case of any unavoidable circumstances, you can always reschedule it 4 hours in advance.
</p>

<h3>What if, the phone call gets disconnected in between?
</h3>
<br>
<p>
   We will ensure about the connectivity. However, if it happens, we will regenerate the call within 5 minutes and the Consultation will proceed till the time slot ends.

</p>


<h3>What if, the Chat or Video-call gets disconnected in between?
</h3>
<br>
<p>
   We request you to check your Internet connection first, if that seems fine, you can re-initiate the chat or video-call from your panel and the remaining number of questions can be asked in chat or the remaining minutes of the time slot can be completed in the video call.
</p>
<h3>What if I want to send a few documents to expert to study my case/report before
 consultation?
</h3>
<br>
<p>
  You can upload the documents by logging in to your panel and select “upcoming appointments” section. There you will be able to upload the documents you want to send. Expert will receive the documents in their panel or via mail. All the documents are to be uploaded prior to the appointment.
</p>
<h3>Can adviser send their prescription/report to user post consultation?

</h3>
<br>
<p>
   Yes, if need be, advisers may send their report/prescription and the user will receive the same in the “completed order” section of their panel.


</p>
<h3>How long can I avail for a consultation through chat?
</h3>
<br>
<p>
  The chat is predetermined by the Adviser on the basis of number of questions. The Advisers will decide the number of questions he/she would answer in one scheduled Chat appointment.
  <br>
  P.S.<i> Users are requested to ask relevant questions because the chat will be auto-disconnected once the alloted number of questions are complete.</i>

</p>
<h3>What will be the duration of an appointment through Phone call or Video call?
</h3>
<br>
<p>
  Time slot for each consultation is decided by the Adviser only. The call will be auto-disconnected with a prior notification at the completion of the time slot.
  </p>
<h3>Can phone call discussions extend beyond the fixed time slot?
</h3>
<br>
<p>
   No, the call will be disconnected automatically after the fixed time slot. However, you can re-schedule a follow-up consultation with the same expert if you feel necessary.
</p>


<h3>Will I be refunded if the consultation is over before the fixed time slot?

</h3>
<br>
<p>
  No, you will be charged for the complete time slot, so we request you to utilize the time provided and clear all your queries.

</p>
<h3>How are the charges for a Consultation decided?

</h3>
<br>
<p>
  The Adviser decides the amount he/she would charge for each Consultation provided.

</p>
<h3>What are the payment options? How do I make a payment?

</h3>
<br>
<p>
   Online payment are to be made in advance through the payment forum in Advisers profile or you can pay directly to the Advisers in Personal Meetings.

<br>
If any of your queries are still unanswered, we would appreciate your message on connect@adviceli.com
</p>

<h2>For Advisers</h2><br>
<h3>How to define my consultation fee?
</h3>
<br>
<p>
   You can choose your consultation charges as per your choice; it will vary from expert to expert and category to category.
</p>
<h3>How will be the time slot for each appointment decided?

</h3>
<br>
<p>
  Time slot for each consultation is decided by the Adviser only. The call will be disconnected with a prior notification at the completion of the slot.
In case of Chat consultation, the Adviser decides the number of questions to be discussed during the session.

</p>
<h3>How and when do I get paid?
</h3>
<br>
<p>
   We transfer payments every Wednesday. All the appointments attended from Tuesday to Monday will be paid on Wednesday.
If due to any reason you have not received the payment, please feel free to write to us at advisershelp@adviceli.com
</p>
<h3>How do I register my bank account with my Adviceli account?
</h3>
<br>
<p>
   You can provide us your bank account details from your adviser panel. This account will be registered with us, where you will receive all your payments. No other account other than this will be funded by Adviceli.
</p>
<h3>Would there be any tax deduction for my consultations?
</h3>
<br>
<p>
   We do not deduct any taxes while paying you. You need to pay your tax individually.
</p>
<h3>What are the modes through which a user gets connected to me?
</h3>
<br>
<p>
   The user will book an appointment depending on the available dates on your profile. Please ensure that you regularly update your availability with us.<br>
In case of Phone-call appointment, our server will call you to connect with the user. The minute you pick up the call, you will be connected to your user.
<br>
In case of Chat appointment, either the User or the Adviser can initiate the chat from the Chat panel.<br>
In case of Video-call appointment, you need to be logged in and available before your system to take the call. Either you or the user can initiate the call by clicking on Video-call button.<br>
In case of Personal meeting appointment, user will be present on your given location for the meeting.

</p>
<h3>Can I edit my profile after registration?
</h3>
<br>
<p>
   Yes, you can edit your profile according to your ease.

</p>
<h3>Are my details and profile privacy secured?
</h3>
<br>
<p>
  Your details are completely safe and secure with us. We do not reveal your contact details with the user. Although, we do share your address and number that you provide for the personal meeting but it is shared only to the concerned user.
</p>
<h3>Where can I get details of upcoming events and past consultation?
</h3>
<br>
<p>
   You can check the same on your dashboard. User might upload documents in regards to the consultation, which will help you prepare for your advice.
</p>
<h3>What if I am unable to take the scheduled call?
</h3>
<br>
<p>
   We will give another call after a 5 minutes interval. If this call goes unanswered as well then the appointment will be automatically canceled.
</p>
<h3>Can phone call discussions extend beyond the fixed time slot?
</h3>
<br>
<p>
   No, the call will be disconnected automatically after the fixed time slot. However, you can re-schedule a follow-up consultation with the same expert if you feel necessary.
</p>
<h3>What if, I am unable to attend scheduled Video-call or Personal Meeting?
</h3>
<br>
<p>
   We would insist that you attend the appointment as per schedule. In case of any unavoidable circumstances, you can notify us and the User 4 hours in advance from “My account” section in your panel.
</p>



<h3>What if, the call gets disconnected in between?
</h3>
<br>
<p>
  We will ensure about the connectivity. However, if it happens, we will regenerate the call within 5 minutes and the Consultation will proceed till the time slot ends.
</p>
<h3>What if, the Chat or Video-call gets disconnected in between?
</h3>
<br>
<p>
   We request you to check your Internet connection first, if that seems fine, you can re-initiate the chat or video-call from your panel and the remaining number of questions will be asked or the remaining minutes of the time slot will be completed.
</p>
<h3>Can I cancel/reschedule the consultation confirmed earlier?
</h3>
<br>
<p>
We won’t recommend you to do that, but if it is necessary please reschedule it 4 hours prior to the scheduled time from your panel.
</p>
<h3>Are there any cancellation charges?
</h3>
<br>
<p>
   Phone Call: If not canceled 30 Minutes in advance then penalty is INR 50 or 5% of the fees, whichever is higher.<br>
Video Call: If not canceled 1 hour in advance then penalty is INR 50.or 5% of the fees, whichever is higher.<br>
Change in Location: If not canceled 1 hour in advance then penalty is INR 100.or 5% of the fees, whichever is higher.<br>
Chat: If Adviser does not reply on the chat till 12 hours then it will be auto canceled and Adviser will be penalized by 10% of the entire amount.

</p>
<h3>What if the User is not available for Chat/ Video-call/ Phone-call at the scheduled time?
</h3>
<br>
<p>
   Two trials will be made to connect you with the User and after that the appointment will be canceled. The defaulter will be penalized.
</p>
<h3>Would I be able to send reports/documents to the user after consultation?

</h3>
<br>
<p>
  You can do the same by selecting “completed appointments” section in your panel and there you can upload the documents. User will receive it in their panel or via mail. Documents can be sent within 5 days maximum from the day of consultation.
</p>
<h3>Can I, as an expert, seek advice from other experts in different domain?
</h3>
<br>
<p>
   Yes, you can book appointment with any expert available on the panel to get advice.
</p>
<h3>How can I get more appointments through Adviceli?
</h3>
<br>
<p>
   We will give another call after a 5 minutes interval. If this call goes unanswered as well then the appointment will be automatically canceled.
</p>
<h3>What if I am unable to take the scheduled call?
</h3>
<br>
<p>
 This depends on the factors given below:
Whether your profile on Adviceli is complete as complete profile attracts users.
You are not canceling/rescheduling any appointments as it might affect your profile review.
Your impression on the user is a positive one so that the user would give good rates on your profile.
Improve your ratings and reviews by adding informative blogs/ videos and by answering the questions on Ask Us forum.
</p>
<h3>Will I be held legally responsible for advice I give?
</h3>
<br>
<p>
   No we ensure our experts are protected and not liable for advice they sugges.
   <br>
If any of your queries are still unanswered, we would appreciate your message on advisersconnect@adviceli.com
</p>
<h1>SERVICES</h1><br>
<h2>For Users</h2><br>
<h3>How do I select and book a Service of my choice?
</h3>
<br>
<p>
   You can select and book an Adviser/Expert for availing a Consultation or Service from the Categories and Sub-Categories of the website.
You can further filter the options according to experience, Charges, Availability, etc.
</p>
<h3>How do I connect to the selected Adviser?
</h3>
<br>
<p>
  The user will book an appointment depending on the available dates on your profile. Please ensure that you regularly update your availability with us.
  <ul>
      <li>
          In case of Phone-call appointment, our server will call you to connect with the Adviser. The minute you pick up the call, you will be connected to the Adviser. </li>
               <li>
In case of Chat appointment, either the User or the Adviser can initiate the chat from the Chat panel. </li>
 <li>
In case of Video-call appointment, you need to be logged in and available before your system to take the call. Either you or the user can initiate the call by clicking on Video-call button. </li>
 <li>
In case of Personal meeting appointment, user will be present on your given location for the meeting.
      </li>
  </ul>
</p>
<h3>How much will I be paying for one Service?
</h3>
<br>
<p>
   Each expert specializes in their respective fields. Their fee varies from the area of consultation and expertise level.
</p>
<h3>Are the expert listed on Adviceli qualified or experienced enough to give advice?
</h3>
<br>
<p>
   We believe in serving you the best out of all. We personally verify their qualification and experience before listing them.
</p>
<h3>Is the Service charges refundable?
</h3>
<br>
<p>
   Yes, the fee is 100% refundable, if you cancel the appointment or even if you are unsatisfied with the consultation provided by the expert.
</p>



<h3>What if I am not satisfied by the Service provided?
</h3>
<br>
<p>
   In case of dissatisfaction from a Service provided; User will be provided another free service by the same Expert/ Adviser.
</p>
<h3>Is there any extra cost involved in the service provided by an expert?
</h3>
<br>
<p>
  No, there is no extra cost. You only need to pay the fee that is mentioned on the panel.
</p>
<h3>Can I cancel/reschedule the appointment? How?
</h3>
<br>
<p>
   Yes, you can do the same at least 4 hours prior to the scheduled time. For rescheduling the User have to book a fresh appointment with the Advisers.
</p>
<h3>Are there any cancellation charges?
</h3>
<br>
<p>
   Phone Call: If not canceled 30 Minutes in advance then penalty is INR 50 or 5% of the fees, whichever is higher.<br>
Video Call: If not canceled 1 hour in advance then penalty is INR 50.or 5% of the fees, whichever is higher.<br>
Change in Location: If not canceled 1 hour in advance then penalty is INR 100.or 5% of the fees, whichever is higher.<br>
Chat: If User does not reply on the chat till 12 hours then it will be auto canceled and the User will be penalized by 10% of the entire amount.

</p>
<h3>What if the experts cancel appointment?
</h3>
<br>
<p>
  The probability is very less, but in case an expert cancels the appointment, we will inform you via SMS or drop an email at your registered mail id. You can then either book the appointment again or claim for 100% refund.
</p>
<h3>What if the Adviser is not available for Chat at the scheduled time?
</h3>
<br>
<p>
  The Chat option will be available on the panel of both User and Adviser for 72 hours and after that the appointment will be canceled. The defaulter will be penalized.
</p>
<h3>What if, I am unable to take the scheduled Phone call?
</h3>
<br>
<p>
   We will give another call after a 5 minutes interval. If this call goes unanswered as well then the appointment will be automatically canceled. You can always reschedule in advance seeking your unavailability from “my account” section in your panel.
</p>
<h3>What if, I am unable to attend scheduled Video-call or Personal Meeting?
</h3>
<br>
<p>
   We would insist that you attend the appointment as per schedule. In case of any unavoidable circumstances, you can always reschedule it 4 hours in advance from “My account” section in your panel.
</p>
<h3>What if, the phone call gets disconnected in between?
</h3>
<br>
<p>
   We will ensure about the connectivity. However, if it happens, we will regenerate the call within 5 minutes and the appointment will proceed till the time slot ends.
</p>
<h3>What if, the Chat or Video-call gets disconnected in between?
</h3>
<br>
<p>
   We request you to check your Internet connection first, if that seems fine, you can re-initiate the chat or video-call from your panel and the remaining number of questions can be asked or the remaining minutes of the time slot can be completed.
</p>


<h3>What if I want to send a few documents to expert to study my case/report before consultation?
</h3>
<br>
<p>
  You can always upload the documents by logging in to your panel and select “upcoming appointments” section. There you will be able to upload the documents you want to send. Expert will receive the documents in their panel or via mail. Documents can be shared anytime.
</p>
<h3>Can adviser send their prescription/report to user post consultation?
</h3>
<br>
<p>
 Yes, if need be, advisers may send their report/prescription and the user will receive the same in their “completed order” section in their panel.
</p>
<h3>How long can I avail a service through chat?
</h3>
<br>
<p>
  The chat is predetermined by the Adviser on the basis of number of questions. The Advisers will decide the number of questions he/she would answer in one scheduled Chat appointment.
<br>
P.S. Users are requested to ask relevant questions because the chat will be auto-disconnected once the alloted number of questions are complete.
</p>

<h3>What will be the duration of an appointment through Phone call or Video call?
</h3>
<br>
<p>
   Time slot for each consultation is decided by the Adviser only. The call will be disconnected with a prior notification at the completion of the time slot.
</p>
<h3>Can phone call discussions extend beyond the fixed time slot?
</h3>
<br>
<p>
   No, the phone call will be disconnected automatically after the fixed time slot. You can re-schedule a follow-up consultation with the same expert.
</p>
<h3>Can Video-call/Personal Meeting extend beyond the fixed time slot?
</h3>
<br>
<p>
   We request you to check your Internet connection first, if that seems fine, you can re-initiate the chat or video-call from your panel and the remaining number of questions can be asked or the remaining minutes of the time slot can be completed.
</p>
<h3>What if, the Chat or Video-call gets disconnected in between?
</h3>
<br>
<p>
   We request you to check your Internet connection first, if that seems fine, you can re-initiate the chat or video-call from your panel and the remaining number of questions can be asked or the remaining minutes of the time slot can be completed.
</p>
<h3>What if, the Chat or Video-call gets disconnected in between?
</h3>
<br>
<p>
   We request you to check your Internet connection first, if that seems fine, you can re-initiate the chat or video-call from your panel and the remaining number of questions can be asked or the remaining minutes of the time slot can be completed.
</p>
<h3>What if, the Chat or Video-call gets disconnected in between?
</h3>
<br>
<p>
   No, the phone call will be disconnected automatically after the fixed time slot. You can re-schedule a follow-up consultation with the same expert.
</p>
<h3>What if, the Chat or Video-call gets disconnected in between?
</h3>
<br>
<p>
   We request you to check your Internet connection first, if that seems fine, you can re-initiate the chat or video-call from your panel and the remaining number of questions can be asked or the remaining minutes of the time slot can be completed.
</p>
<h3>Can Video-call/Personal Meeting extend beyond the fixed time slot?
</h3>
<br>
<p>
  It depends on your discussion with the adviser; if they feel necessary the discussion can continue for a few more minutes.
</p>
<h3>Will I be refunded if the consultation is over before the fixed time slot?
</h3>
<br>
<p>
   No, you will be charged for the complete time slot, so we request you to utilize the time provided and clear all your queries.
</p>


<h3>How are the charges for a Service decided?
</h3>
<br>
<p>
   The Adviser decides the amount he/she would charge for each Consultation or Service provide.
</p>
<h3>What are the payment options? How do I make a payment?
</h3>
<br>
<p>
   Online payment are to be made in advance through the payment forum in Advisers profile or you can pay directly to the Advisers in Personal Meetings.

<br>
If any of your queries are still unanswered, we would appreciate your message on connect@adviceli.com
</p>
<h1>For Advisers</h1>
<h3>How to define my fee?
</h3>
<br>
<p>
   You can choose your consultation charges as per your choice; it will vary from expert to expert and category to category.
</p>
<h3>How will be the time slot for each appointment decided?
</h3>
<br>
<p>
  Time slot for each appointment is decided by the Adviser only. The phone call and video call will be disconnected with a prior notification at the completion of the slot. <br>
In case of Chat, the Adviser decides the number of questions to be discussed during the session.

</p>
<h3>How and when do I get paid?
</h3>
<br>
<p>
   We transfer payments every Wednesday. All the appointments attended from Tuesday to Monday will be paid on Wednesday.
If due to any reason you have not received the payment, please feel free to write to us at advisershelp@adviceli.com
</p>
<h3>How do I register my bank account with my Adviceli account?
</h3>
<br>
<p>
   You can provide us your bank account details from your adviser panel. This account will be registered with us, where you will receive all your payments. No other account other than this will be funded by Adviceli.
</p>
<h3>Would there be any tax deduction from my payment?
</h3>
<br>
<p>
  We do not deduct any taxes while paying you. You need to pay your tax individually.
</p>
<h3>What are the modes through which a user gets connected to me?
</h3>
<br>
<p>
  The user will book an appointment depending on the available dates on your profile. Please ensure that you regularly update your availability with us.
  <br>
  <ul>
      <li>
          In case of Phone-call appointment, our server will call you to connect with the user. The minute you pick up the call, you will be connected to your user.
      </li>
      <li>
          In case of Chat appointment, either the User or the Adviser can initiate the chat from the Chat panel.
      </li>
      <li>
         In case of Video-call appointment, you need to be logged in and available before your system to take the call. Either you or the user can initiate the call by clicking on Video-call button.
      </li>
      <li>
         In case of Personal meeting appointment, user will be present on your given location for the meeting.
      </li>
  </ul>
</p>
<h3>Can I edit my profile after registration?
</h3>
<br>
<p>
   Yes, you can edit your profile according to your ease.
</p>
<h3>Are my details and profile privacy secured?
</h3>
<br>
<p>
   Your details are completely safe and secure with us. We do not reveal your contact details with the user. Although, we do share your address and number that you provide for the personal meeting but it is shared only to the concerned user.
</p>
<h3>Where can I get details of upcoming events and past appointment?
</h3>
<br>
<p>
  You can check the same on your dashboard. User might upload documents in regards to the Service, which will help you prepare for your advice.
</p>


<h3>What if I am unable to take the scheduled call?
</h3>
<br>
<p>
  We will give another call after a 5 minutes interval. If this call goes unanswered as well then the appointment will be automatically canceled.
</p>
<h3>What if, I am unable to attend scheduled Video-call or Personal Meeting?
</h3>
<br>
<p>
  We would insist that you attend the appointment as per schedule. In case of any unavoidable circumstances, you can notify us and the User 4 hours in advance from your panel.
</p>
<h3>What if, the call gets disconnected in between?
</h3>
<br>
<p>
  We will ensure about the connectivity. However, if it happens, we will regenerate the call within 5 minutes and the Consultation will proceed till the time slot ends.
</p>
<h3>What if, the Chat or Video-call gets disconnected in between?
</h3>
<br>
<p>
  We request you to check your Internet connection first, if that seems fine, you can re-initiate the chat or video-call from your panel and the remaining number of questions will be asked or the remaining minutes of the time slot will be completed.
</p>
<h3>Can I cancel/reschedule the appointment confirmed earlier?
</h3>
<br>
<p>
 We won’t recommend you to do that, but if it is necessary please reschedule it 4 hours prior to the scheduled time from your panel.
</p>
<h3>Are there any cancellation charges?
</h3>
<br>
<p>
  Phone Call: If not canceled 30 Minutes in advance then penalty is INR 50 or 5% of the fees, whichever is higher.<br>
Video Call: If not canceled 1 hour in advance then penalty is INR 50.or 5% of the fees, whichever is higher.<br>
Change in Location: If not canceled 1 hour in advance then penalty is INR 100.or 5% of the fees, whichever is higher.<br>
Chat: If Advoser does not reply on the chat till 12 hours then it will be auto canceled and Adviser will be penalized by 10% of the entire amount.

</p>
<h3>What if the User is not available for Chat at the scheduled time?
</h3>
<br>
<p>
 The chat option will be available on the panel of both User and Adviser after that the appointment will be canceled. The defaulter will be penalized.
</p>
<h3>Would I be able to send reports/documents to the user after the service?
</h3>
<br>
<p>
  You can do the same by selecting “completed appointments” section in your panel and there you can upload the documents. User will receive it in their panel or via mail. Documents can be sent within 5 days maximum from the day of appointment.
</p>
<h3>Can I, as an expert, seek advice from other experts in different domain?
</h3>
<br>
<p>
  Yes, you can book appointment with any expert available on the panel to get advice.
</p>
<h3>How can I get more appointments through Adviceli?
</h3>
<br>
<p>
  <b>This depends on the factors given below:</b><br>
Whether your profile on Adviceli is complete as complete profile attracts users.
You are not canceling/rescheduling any appointments as it might affect your profile review.
Your impression on the user is a positive one so that the user would give good rates on your profile.
Improve your ratings and reviews by adding informative blogs/ videos and by answering the questions on Ask Us forum.
</p>

<h3>Will I be held legally responsible for advice I give?
</h3>
<br>
<p>
 No we ensure our experts are protected and not liable for advice they suggest.
<br>
If any of your queries are still unanswered, we would appreciate your message on advisersconnect@adviceli.com
</p>

<h1>Blog/ Ask Us</h1><br>
<h2>Users</h2><br>
<h3>Who can upload Blogs/Videos or participate in the Ask Us forums?
</h3>
<br>
<p>
 Anyone can upload blogs and videos in the website as well as participate in the Ask Us forum. Both Users and Advisers are requested to add relevant Blogs and Videos to the site.
</p>
<h3>What are the benefits of answering questions on the Ask Us forum?
</h3>
<br>
<p>
Participation through answers on the Ask Us forum earns an individual money on per answer basis.
</p>
<h3>Will I be paid for the Blogs/Videos I upload?
</h3>
<br>
<p>
 Yes, payment for each upload and answer will be provided on the basis of likes, views and comments.
</p>
<h3>When and where can I get my earned amount for the blogs/ videos/ answers?
</h3>
<br>
<p>
 Payment for individual participation will be made once INR 1000 is added. The payment will be done online on your registered bank account.
</p>
<h3>How do I register my bank account with my Adviceli account?
</h3>
<br>
<p>
 You can provide us your bank account details from your adviser panel. This account will be registered with us, where you will receive all your payments. No other account other than this will be funded by Adviceli.
</p>
<h3>Would there be any tax deduction for my consultations?
</h3>
<br>
<p>
 We do not deduct any taxes while paying you. You need to pay your tax individually.
<br>
If any of your queries are still unanswered, we would appreciate your message on connect@adviceli.com
</p>

<h2>Advisers</h2><br>
<h3>Who can upload Blogs/Videos or participate in the Ask Us forums?
</h3>
<br>
Anyone can upload blogs and videos in the website as well as participate in the Ask Us forum. Both Users and Advisers are requested to add relevant Blogs and Videos to the site.
</p>
<h3>What are the benefits of answering questions on the Ask Us forum?
</h3>
<br>
<p>
 Participation through answers on the Ask Us forum earns an individual money on per answer basis.
</p>
<h3>Will I be paid for the Blogs/Videos I upload?
</h3>
<br>
<p>
Yes, payment for each upload and answer will be provided on the basis of likes, views and comments.
</p>
<h3>When and where can I get my earned amount for the blogs/ videos/ answers?
</h3>
<br>
<p>
 Payment for individual participation will be made once INR 1000 is added. The payment will be done online on your registered bank account.
You can keep a track of the earned money from the payment section in your profile.
</p>
<h3>How do I register my bank account with my Adviceli account?
</h3>
<br>
<p>
 You can provide us your bank account details from your adviser panel. This account will be registered with us, where you will receive all your payments. No other account other than this will be funded by Adviceli.
</p>
<h3>Would there be any tax deduction for my consultations?
</h3>
<br>
<p>
 We do not deduct any taxes while paying you. You need to pay your tax individually.
<br>
If any of your queries are still unanswered, we would appreciate your message on <a href="#" >advisersconnect@adviceli.com</a>

</p>
         </div>
    </div>
</div>
@endsection
