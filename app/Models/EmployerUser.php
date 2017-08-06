<?php

namespace App\Models;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

// use Illuminate\Foundation\Auth\Access\Authorizable;


class EmployerUser extends Model implements
    AuthenticatableContract,
    CanResetPasswordContract
{
    /*
    * Removing use Authorizable as
    *'can' method of Authorizable conflicts with 'can' method of Entrust
    *
    * PREVIOUS : use Authenticatable, Authorizable, CanResetPassword, EntrustUserTrait;
    *
    */
    use Authenticatable, CanResetPassword, EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employer_has_users';

    public function employer()
    {
        return $this->belongsTo('App\Models\Employer', 'employer_id', 'id');
    }
    public function details()
    {
        return $this->hasOne('App\Models\EmployerUserDetails', 'employer_user_id', 'id');
    }
    public function jobs()
    {
        return $this->hasMany('App\Models\JobPosting', 'user_id', 'id');
    }
    public function getHumanTimestampAttribute($column)
            {
                        if ($this->attributes[$column]) {
                                        return Carbon::parse($this->attributes[$column])->diffForHumans();
                                                }

                                return null;
                            }

        public function getHumanCreatedAtAttribute()
                {
                            return $this->getHumanTimestampAttribute("created_at");
                                }

        public function getHumanUpdatedAtAttribute()
                {
                            return $this->getHumanTimestampAttribute("updated_at");
                                }
}
