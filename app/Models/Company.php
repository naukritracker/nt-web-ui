<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'company';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['country_id','state_id'];

    /**
     * Defining One to One relationship with State Model.
     *
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    /**
     * Defining Many to One relationship with Country Model.
     *
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * Defining One to Many relationship with JobPosting Model.
     *
     */
    public function jobs()
    {
        return $this->hasMany('App\Models\JobPosting');
    }

    /**
     * Defining One to Many relationship with Experience Model.
     *
     */
    public function experience()
    {
        return $this->hasMany('App\Models\Experience', 'company_id', 'id');
    }
}
