<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'state';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['country_id'];

    /**
     * Defining Has Many Through relationship with User Model.
     *
     */
    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Models\UserDetail');
    }

    /**
     * Defining Has one to many relationship with Companies Model.
     *
     */
    public function companies()
    {
        return $this->hasMany('App\Models\Company');
    }

    /**
     * Defining One to One relationship with UserDetail Model.
     *
     */
    public function userdetails()
    {
        return $this->hasMany('App\Models\UserDetail');
    }

    /**
     * Defining One to One relationship with UserDetail Model.
     *
     */
    public function currentlocations()
    {
        return $this->hasMany('App\Models\UserDetail', 'id', 'current_location');
    }

    /**
     * Defining One to One relationship with UserDetail Model.
     *
     */
    public function preferredlocations()
    {
        return $this->hasMany('App\Models\UserDetail', 'id', 'preferred_location');
    }

    public function jobs()
    {
        return $this->hasMany('App\Models\JobPosting');
    }

    public function experiences()
    {
        return $this->hasMany('App\Models\Experience');
    }

    /**
     * Defining Many to One relationship with Country Model.
     *
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
}
