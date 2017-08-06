<?php

namespace App\Models;

use Carbon\Carbon;
use App\Visa;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
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

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function employer()
    {
        return $this->belongsTo('App\Models\Employer', 'user_id', 'id');
    }

    public function modifieduser()
    {
        return $this->belongsTo('App\User', 'modified_user_id', 'id');
    }

    public function modifiedemployer()
    {
        return $this->belongsTo('App\Models\Employer', 'modified_user_id', 'id');
    }

    public function applications()
    {
        return $this->hasMany('App\Models\JobPostingHasApplication', 'id', 'jobposting_id');
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

    public function getStateName($value)
    {
        $returnValue = '';
        if ($value != 0) {
            $state = State::find($value);
            if (isset($state)) {
                $returnValue .= $state->state;
                if (isset($state->country)) {
                    $returnValue .= "(".$state->country->country.")";
                }
            }
        }
        
        return $returnValue;
    }
    public function getCountryList($value)
    {
        $list = '';
        switch ($value) {
        case '':
        
        default:
        break;
    }
        return $list;
    }
}
