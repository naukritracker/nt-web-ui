<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'experience';

    protected $dates = ['start_date','end_date','created_at','updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['user_id','country_id'];

    /**
     * Defining Has Many Through relationship with User Model.
     *
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Defining Many to One relationship with Country Model.
     *
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    /**
     * Defining Many to One relationship with Company Model.
     *
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     * Defining Many to One relationship with Company Model.
     *
     */
    public function industries()
    {
        return $this->hasOne('App\Models\Industry', 'id', 'industry');
    }
    /**
     * Defining Many to One relationship with Company Model.
     *
     */
    public function functionalarea()
    {
        return $this->hasOne('App\Models\FunctionalArea', 'id', 'functional_area');
    }
}
