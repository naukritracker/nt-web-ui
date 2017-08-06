<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployerUserDetails extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employer_user_has_details';
    /**
     * Defining has Many through relationship with State Model.
     *
     */
    public function currentlocation()
    {
        return $this->hasOne('App\Models\State', 'id', 'current_location');
    }

    /**
     * Defining has Many through relationship with State Model.
     *
     */
    public function preferredlocation()
    {
        return $this->hasOne('App\Models\State', 'id', 'preferred_location');
    }

    /**
     * Defining has one through relationship with industry Model.
     *
     */
    public function industries()
    {
        return $this->hasOne('App\Models\Industry', 'id', 'industry');
    }

    /**
     * Defining has one through relationship with industry Model.
     *
     */
    public function functionalareas()
    {
        return $this->hasOne('App\Models\FunctionalArea', 'id', 'functional_area');
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
