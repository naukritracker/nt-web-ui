<?php

namespace App;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Carbon\Carbon;

//use Illuminate\Foundation\Auth\Access\Authorizable;
//use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


/*
* Removing AuthorizableContract from User as
*'can' method of Authorizable conflicts with 'can' method of Entrust
*
* PREVIOUS : class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
*
*/
class User extends Model implements
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
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Defining Many to One relationship with UserDetail Model.
     *
     */
    public function userdetail()
    {
        return $this->hasOne('App\Models\UserDetail', 'user_id', 'id');
    }

    public function experience()
    {
        return $this->hasMany('App\Models\Experience', 'user_id', 'id');
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

    public function getAuthPassword()
    {
        return $this->password;
    }
}
