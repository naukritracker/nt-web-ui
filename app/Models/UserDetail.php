<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_details';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Defining One to One relationship with User Model.
     *
     */
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Defining One to One relationship with State Model.
     *
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    /**
     * Defining One to One relationship with Media Model.
     *
     */
    public function media()
    {
        return $this->hasOne('App\Models\Media', 'id', 'resume_media_id');
    }
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

    public function getReadableQualification($value)
    {
        $returnValue = '';
        switch ($value) {
            case 'sse':
                $returnValue .= '10th grade or Equivalent';
                break;
            case 'hsse':
                $returnValue .= '12th grade or Equivalent';
                break;
            case 'ug':
                $returnValue .= 'Under Graduate';
                break;
            case 'pg':
                $returnValue .= 'Post Graduate';
                break;
            case '0':
                $returnValue .= 'No minimum qualification';
                break;

            default:
                $returnValue .= 'Unable to recognise specified qualification';
                break;
        }

        return $returnValue;
    }

    public function getReadableJobType($value)
    {
        $returnValue = '';
        switch ($value) {
            case 'full':
                $returnValue .= 'Full Time';
                break;
            case 'part':
                $returnValue .= 'Part time';
                break;
            case '0':
                $returnValue .= 'Full/Part Time';
                break;

            default:
                $returnValue .= 'Unable to recognise specified job type';
                break;
        }

        return $returnValue;
    }

    public function getReadableEmploymentType($value)
    {
        $returnValue = '';
        switch ($value) {
            case 'permanent':
                $returnValue .= 'Permanent Employee';
                break;
            case 'contract':
                $returnValue .= 'Contract Based Employee';
                break;
            case '0':
                $returnValue .= 'Permanent/Contract Employee';
                break;

            default:
                $returnValue .= 'Unable to recognise specified employment type';
                break;
        }

        return $returnValue;
    }

    public function getReadableGenderType($value)
    {
        $returnValue = '';
        switch ($value) {
            case 'male':
                $returnValue .= 'Male';
                break;
            case 'female':
                $returnValue .= 'Female';
                break;
            case '0':
                $returnValue .= 'Male/Female';
                break;

            default:
                $returnValue .= 'Unable to recognise specified gender type';
                break;
        }

        return $returnValue;
    }

    public function getVisaName($value)
    {
        $returnValue = '';

        if ($value != 0) {
            $visa = Visa::find($value);
            if (isset($visa->visa)) {
                $returnValue = $visa->visa;
            }
        }

        return $returnValue;
    }

    public function getCountryName($value)
    {
        $returnValue = '';
        $avoid[] = 'any_arabic_national';
        $avoid[] = 'any_gcc_national';
        $avoid[] = 'any_european_national';
        $avoid[] = 'any_anglophone_national';
        $avoid[] = 'any_cis_national';


        if (!in_array($value, $avoid)) {
            if ($value != 0) {
                $country = Country::find($value);
                if (isset($country->country)) {
                    $returnValue = $country->country;
                }
            }
        } else {
            switch ($value) {
                case 'any_arabic_national':
                    $returnValue = 'Any Arabic National';
                    break;

                case 'any_gcc_national':
                    $returnValue = 'Any GCC National';
                    break;

                case 'any_european_national':
                    $returnValue = 'Any European National';
                    break;

                case 'any_anglophone_national':
                    $returnValue = 'Any Anglophone National';
                    break;

                case 'any_cis_national':
                    $returnValue = 'Any CIS National';
                    break;
                default:
                    break;
            }
        }


        return $returnValue;
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
