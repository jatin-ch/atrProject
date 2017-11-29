<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait;
    protected $guard = 'web';

    /**
      * Relationship over different models.
      **/
    protected $table = 'users';

    public function posts()
    {
     	return $this->hasMany('App\Models\Admin\Post');
    }

    public function likes()
    {
      return $this->hasMany('App\Models\Page\PostLike');
    }

    public function comments()
    {
    	return $this->hasMany('App\Models\Page\PostComment');
    }

    public function replies()
    {
    	return $this->hasMany('App\Models\Page\CommentReply');
    }

    public function clikes()
    {
      return $this->hasMany('App\Models\Page\CommentLike');
    }

    public function rlikes()
    {
      return $this->hasMany('App\Models\Page\ReplyLike');
    }

    public function ratings()
    {
      return $this->hasOne('App\Models\Page\UserRating');
    }

    public function basicDetail()
    {
      return $this->hasOne('App\Models\Admin\BasicDetail');
    }

    public function locations()
    {
     	return $this->hasMany('App\Models\Admin\Location');
    }

      public function payment()
     {
       return $this->hasOne('App\Models\Admin\Payment');
     }

      public function expertDetail()
     {
       return $this->hasOne('App\Models\Admin\ExpertDetail');
     }

     public function verification()
    {
      return $this->hasOne('App\Models\Admin\Verification');
    }

     public function galleries()
    {
      return $this->hasMany('App\Models\Admin\Gallery');
    }

    public function services()
   {
     return $this->hasMany('App\Models\Admin\Service');
   }

     public function offers()
    {
      return $this->hasMany('App\Models\Admin\Offer');
    }

     public function availabilities()
    {
      return $this->hasMany('App\Models\Admin\Availability');
    }

      public function firstShifts()
     {
       return $this->hasMany('App\Models\Admin\FirstShift');
     }

    public function unavailabilities()
    {
     	return $this->hasMany('App\Models\Admin\UnAvailability');
    }

    public function specializations()
    {
     	return $this->hasMany('App\Models\Admin\Specialization');
    }

    public function educations()
    {
      return $this->hasMany('App\Models\Admin\Education');
    }

    public function WorkExperiences()
    {
      return $this->hasMany('App\Models\Admin\WorkExperience');
    }

    public function memberships()
    {
      return $this->hasMany('App\Models\Admin\Membership');
    }

    public function awards()
    {
      return $this->hasMany('App\Models\Admin\Award');
    }

    public function Bookings()
    {
     	return $this->hasMany('App\Models\Page\Booking');
    }

    public function Documents()
    {
     	return $this->hasMany('App\Models\Page\Document');
    }

    public function ConsultationInvoices()
    {
     	return $this->hasMany('App\Models\Admin\ConsultationInvoice');
    }

    public function ServiceInvoices()
    {
     	return $this->hasMany('App\Models\Admin\ServiceInvoice');
    }

    public function asks()
    {
      return $this->hasMany('App\Models\Page\Asks\Ask');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Page\Asks\Answer');
    }

    public function acomments()
    {
    	return $this->hasMany('App\Models\Page\Asks\AnswerComment');
    }

    public function alikes()
    {
      return $this->hasMany('App\Models\Page\Asks\AnswerLike');
    }

    // public function messages()
    // {
    //   return $this->hasMany('App\Models\Page\Message');
    // }
    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function receivers() {
        return $this->hasMany('App\Receiver');
    }

    public function org()
    {
      return $this->hasOne('App\Models\Admin\Organization');
    }

    public function organizations()
    {
    	return $this->belongsToMany('App\Models\Admin\Organization');
    }

    public function commission()
    {
      return $this->hasOne('App\Models\Admin\Commission');
    }

    public function authorLikes()
    {
      return $this->hasMany('App\Models\Page\AuthorLike');
    }

    public function authorFollows()
    {
      return $this->hasMany('App\Models\Page\AuthorFollow');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
