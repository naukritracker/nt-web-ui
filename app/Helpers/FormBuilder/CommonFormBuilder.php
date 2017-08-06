<?php

namespace App\Helpers\FormBuilder;

class CommonFormBuilder
{
    /**
     * Based on month number provide month name.
     *
     * @param  Integer $i
     * @return String $month
     */
    protected function getMonth($i)
    {
        if (!is_int($i)) {
            return $month=null;
        }
        switch ($i) {
            case 1:
                $month = 'Jan';
                break;
            case 2:
                $month = 'Feb';
                break;
            case 3:
                $month = 'Mar';
                break;
            case 4:
                $month = 'Apr';
                break;
            case 5:
                $month = 'May';
                break;
            case 6:
                $month = 'Jun';
                break;
            case 7:
                $month = 'Jul';
                break;
            case 8:
                $month = 'Aug';
                break;
            case 9:
                $month = 'Sept';
                break;
            case 10:
                $month = 'Oct';
                break;
            case 11:
                $month = 'Nov';
                break;
            case 12:
                $month = 'Dec';
                break;
            default:
                $month = null;
        }
        return $month;
    }
    /**
     * Escape user detail
     *
     * @param array $userdetail - array of user details
     *
     * @return object
     */
    protected function escapeUserDetail($userdetail)
    {
        $returnArray = [];

        if (isset($userdetail->first_name)) {
            $returnArray['first_name'] = $userdetail->first_name;
        } else {
            $returnArray['first_name'] = null;
        }

        if (isset($userdetail->last_name)) {
            $returnArray['last_name'] = $userdetail->last_name;
        } else {
            $returnArray['last_name'] = null;
        }

        if (isset($userdetail->profile_headline)) {
            $returnArray['profile_headline'] = $userdetail->profile_headline;
        } else {
            $returnArray['profile_headline'] = null;
        }

        if (isset($userdetail->country_code)) {
            $returnArray['country_code'] = $userdetail->country_code;
        } else {
            $returnArray['country_code'] = null;
        }

        if (isset($userdetail->contact_no)) {
            $returnArray['contact_no'] = $userdetail->contact_no;
        } else {
            $returnArray['contact_no'] = null;
        }

        if (isset($userdetail->current_location)) {
            $returnArray['current_location'] = $userdetail->current_location;
        } else {
            $returnArray['current_location'] = null;
        }

        if (isset($userdetail->preferred_location)) {
            $returnArray['preferred_location'] = $userdetail->preferred_location;
        } else {
            $returnArray['preferred_location'] = null;
        }

        if (isset($userdetail->industry)) {
            $returnArray['industry'] = $userdetail->industry;
        } else {
            $returnArray['industry'] = null;
        }

        if (isset($userdetail->functional_area)) {
            $returnArray['functional_area'] = $userdetail->functional_area;
        } else {
            $returnArray['functional_area'] = null;
        }

        if (isset($userdetail->role)) {
            $returnArray['role'] = $userdetail->role;
        } else {
            $returnArray['role'] = null;
        }

        if (isset($userdetail->dob_day)) {
            $returnArray['dob_day'] = $userdetail->dob_day;
        } else {
            $returnArray['dob_day'] = null;
        }

        if (isset($userdetail->dob_month)) {
            $returnArray['dob_month'] = $userdetail->dob_month;
        } else {
            $returnArray['dob_month'] = null;
        }
        if (isset($userdetail->dob_year)) {
            $returnArray['dob_year'] = $userdetail->dob_year;
        } else {
            $returnArray['dob_year'] = null;
        }

        if (isset($userdetail->gender)) {
            $returnArray['gender'] = $userdetail->gender;
        } else {
            $returnArray['gender'] = null;
        }

        if (isset($userdetail->marital_status)) {
            $returnArray['marital_status'] = $userdetail->marital_status;
        } else {
            $returnArray['marital_status'] = null;
        }

        if (isset($userdetail->city)) {
            $returnArray['city']= $userdetail->city;
        } else {
            $returnArray['city'] = null;
        }

        if (isset($userdetail->profile_image)) {
            $returnArray['profile_image']= $userdetail->profile_image;
        } else {
            $returnArray['profile_image'] = null;
        }

        if (isset($userdetail->sse_institution)) {
            $returnArray['sse_institution']= $userdetail->sse_institution;
        } else {
            $returnArray['sse_institution'] = null;
        }

        if (isset($userdetail->sse_start_date)) {
            $returnArray['sse_start_date']= $userdetail->sse_start_date;
        } else {
            $returnArray['sse_start_date'] = null;
        }

        if (isset($userdetail->sse_end_date)) {
            $returnArray['sse_end_date']= $userdetail->sse_start_date;
        } else {
            $returnArray['sse_end_date'] = null;
        }

        if (isset($userdetail->sse_type)) {
            $returnArray['sse_type']= $userdetail->sse_type;
        } else {
            $returnArray['sse_type'] = null;
        }

        if (isset($userdetail->hsse_institution)) {
            $returnArray['hsse_institution']= $userdetail->hsse_institution;
        } else {
            $returnArray['hsse_institution'] = null;
        }

        if (isset($userdetail->hsse_start_date)) {
            $returnArray['hsse_start_date']= $userdetail->hsse_start_date;
        } else {
            $returnArray['hsse_start_date'] = null;
        }

        if (isset($userdetail->hsse_end_date)) {
            $returnArray['hsse_end_date']= $userdetail->hsse_start_date;
        } else {
            $returnArray['hsse_end_date'] = null;
        }

        if (isset($userdetail->hsse_type)) {
            $returnArray['hsse_type']= $userdetail->hsse_type;
        } else {
            $returnArray['hsse_type'] = null;
        }

        if (isset($userdetail->ug_institution)) {
            $returnArray['ug_institution']= $userdetail->ug_institution;
        } else {
            $returnArray['ug_institution'] = null;
        }

        if (isset($userdetail->ug_start_date)) {
            $returnArray['ug_start_date']= $userdetail->ug_start_date;
        } else {
            $returnArray['ug_start_date'] = null;
        }

        if (isset($userdetail->ug_end_date)) {
            $returnArray['ug_end_date']= $userdetail->ug_start_date;
        } else {
            $returnArray['ug_end_date'] = null;
        }

        if (isset($userdetail->ug_type)) {
            $returnArray['ug_type']= $userdetail->ug_type;
        } else {
            $returnArray['ug_type'] = null;
        }

        if (isset($userdetail->pg_institution)) {
            $returnArray['pg_institution']= $userdetail->pg_institution;
        } else {
            $returnArray['pg_institution'] = null;
        }

        if (isset($userdetail->pg_start_date)) {
            $returnArray['pg_start_date']= $userdetail->pg_start_date;
        } else {
            $returnArray['pg_start_date'] = null;
        }

        if (isset($userdetail->pg_end_date)) {
            $returnArray['pg_end_date']= $userdetail->pg_start_date;
        } else {
            $returnArray['pg_end_date'] = null;
        }

        if (isset($userdetail->pg_type)) {
            $returnArray['pg_type']= $userdetail->pg_type;
        } else {
            $returnArray['pg_type'] = null;
        }

        if (isset($userdetail->other_institution)) {
            $returnArray['other_institution']= $userdetail->other_institution;
        } else {
            $returnArray['other_institution'] = null;
        }

        if (isset($userdetail->other_start_date)) {
            $returnArray['other_start_date']= $userdetail->other_start_date;
        } else {
            $returnArray['other_start_date'] = null;
        }

        if (isset($userdetail->other_end_date)) {
            $returnArray['other_end_date']= $userdetail->other_start_date;
        } else {
            $returnArray['other_end_date'] = null;
        }

        if (isset($userdetail->other_type)) {
            $returnArray['other_type']= $userdetail->other_type;
        } else {
            $returnArray['other_type'] = null;
        }

        return (object) $returnArray;
    }
}
