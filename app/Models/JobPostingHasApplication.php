<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class JobPostingHasApplication extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobposting';

    protected $dates = ['created_at','updated_at'];

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

    public function jobposting()
    {
        return $this->belongsTo('App\Models\JobPosting', 'id', 'jobposting_id');
    }

    public function user()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }
}