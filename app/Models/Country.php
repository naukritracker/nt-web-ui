<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'country';

    /**
     * Defining One to Many relationship with StateS Model.
     *
     */
    public function states()
    {
        return $this->hasMany('App\Models\State');
    }

    /**
     * Defining Has Many Through relationship with Companies Model.
     *
     */
    public function companies()
    {
        return $this->hasMany('App\Models\Company');
    }

    public function jobs()
    {
        return $this->hasMany('App\Models\JobPosting');
    }

    public function visas()
    {
        return $this->hasMany('App\Models\Visa');
    }
}
