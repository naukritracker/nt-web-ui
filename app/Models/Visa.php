<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visa';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['country_id'];

     /**
     * Defining relationship with Country Model.
     *
     */
    public function country()
    {
        return $this->hasOne('App\Models\Country');
    }

    /**
     * Defining relationship with JobPosting Model.
     *
     */
    // public function jobs(){
    // 	 return $this->hasMany('App\Models\JobPosting');
    // }
}
