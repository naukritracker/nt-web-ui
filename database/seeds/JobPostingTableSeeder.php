<?php

use Illuminate\Database\Seeder;
use App\models\JobPosting;

class JobPostingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $now = date('Y-m-d h:i:s');
    	DB::table('jobposting')->truncate();

    	JobPosting::insert([
    		//Single
    		// ['user_id'=>1, 'title'=>'Sample Data', 'description'=>'Sample Description', 'role' => 'Sample Role',
    		// 'offered' => 0, 'currency' => NULL, 'state_id' => 0, 'country_id' => 0, 'company_id' => 0,
    		// 'visa' => 'Sample Visa', 'priority' => 0, 'tags' => 'sample tags', 'industry' => 'Sample IT',
    		// 'active_flag' => 0, 'created_at' => '0000-00-00 00:00:00', 'updated_at' => '0000-00-00 00:00:00'],



    		//FIll
    		['user_id'=>1, 'title'=>'Financial Advisor required', 'short_description'=>'Need Finiancial advisor', 'description'=>'Financial advisor needed for MNC. Contact Mr. Shamsudeen @ +97165613522', 'requirements' => 'Some Basic requirements', 'role' => 'Advisor / Consultant','open_positions' => 3,'minimum_education' => 'sse', 'minimum_experience' => 2, 'job_locations' => 191, 'salary_range_start' => 10000, 'salary_range_end' => 100000, 'preferred_nationality' => 82, 'job_type' => 'full', 'employment_type' => 'contract', 'gender_type' => 'male', 'country_id' => 191, 'state_id' => 10, 'visa' => 'Residence', 'industry' => 'Accounting', 'company_id' => 1, 'walkin' => 1, 'apply'=>'http://google.com', 'active_flag' => 1, 'created_at' => $now, 'updated_at' => $now ,'modified_user_id'=>1],
    		['user_id'=>1, 'title'=>'Technical Director for MNC', 'short_description'=>'Director required', 'description'=>'Technical director required for MNC.', 'requirements' => 'Some Basic requirements', 'role' => 'Director','open_positions' => 3,'minimum_education' => 'hsse', 'minimum_experience' => 4, 'job_locations' => 191, 'salary_range_start' => 30000, 'salary_range_end' => 200000, 'preferred_nationality' => 82, 'job_type' => 'part', 'employment_type' => 'contract', 'gender_type' => 'female', 'country_id' => 191, 'state_id' => 10, 'visa' => 'Residence', 'industry' => 'IT', 'company_id' => 2, 'walkin'=>0, 'apply' => 'http://google.com','active_flag' => 1, 'created_at' => $now, 'updated_at' => $now,'modified_user_id'=>1],
    		['user_id'=>1, 'title'=>'Senior Animator required for long term project', 'short_description'=>'Director required', 'description'=>'Technical director required for MNC.', 'requirements' => 'Some Basic requirements', 'role' => 'Director','open_positions' => 3,'minimum_education' => 'hsse', 'minimum_experience' => 4, 'job_locations' => 191, 'salary_range_start' => 30000, 'salary_range_end' => 200000, 'preferred_nationality' => 82, 'job_type' => '0', 'employment_type' => '0', 'gender_type' => '0','country_id' => 191, 'state_id' => 10, 'visa' => 'Residence', 'industry' => 'IT', 'company_id' => 3, 'walkin' => 1, 'apply'=>'http://google.com','active_flag' => 1, 'created_at' => $now, 'updated_at' => $now,'modified_user_id'=>1],
    		['user_id'=>1, 'title'=>'Looking for an experienced Mechanic', 'short_description'=>'Director required', 'description'=>'Technical director required for MNC.', 'requirements' => 'Some Basic requirements', 'role' => 'Director','open_positions' => 5,'minimum_education' => 'ug', 'minimum_experience' => 6, 'job_locations' => 191, 'salary_range_start' => 30000, 'salary_range_end' => 150000, 'preferred_nationality' => 82, 'job_type' => 'part', 'employment_type' => 'contract', 'gender_type' => 'female', 'country_id' => 191, 'state_id' => 10, 'visa' => 'Residence', 'industry' => 'IT', 'company_id' => 4, 'walkin'=>0, 'apply' => 'http://google.com','active_flag' => 1, 'created_at' => $now, 'updated_at' => $now,'modified_user_id'=>1],
    		
    	]);
      
        
    }
}
