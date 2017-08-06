<?php

use Illuminate\Database\Seeder;
use App\models\Visa;

class VisaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('visa')->truncate();

        Visa::insert([
        		
        		//Oman - ID 137
        		['visa' => 'Employment','country_id' => '137'],
        		['visa' => 'Employment Contracting','country_id' => '137'],
        		['visa' => 'Family Joining / Residence','country_id' => '137'],
        		['visa' => 'Family Joining / Residence','country_id' => '137'],
        		['visa' => 'Student Resident','country_id' => '137'],
        		['visa' => 'Investor Resident','country_id' => '137'],
        		['visa' => 'Express','country_id' => '137'],
        		['visa' => 'Multiple Entry','country_id' => '137'],
        		['visa' => 'Relative / Friend Visit','country_id' => '137'],
        		['visa' => 'Official Visit','country_id' => '137'],
        		['visa' => 'Troupe (Artist)','country_id' => '137'],
        		['visa' => 'Truck Drivers','country_id' => '137'],
        		['visa' => 'Transit','country_id' => '137'],
        		['visa' => 'Road Transit','country_id' => '137'],
        		['visa' => 'Seamen\'s Transit','country_id' => '137'],
        		['visa' => 'Scientific Research','country_id' => '137'],
        		['visa' => 'Tourist','country_id' => '137'],
        		['visa' => 'Visa Facility with Dubai','country_id' => '137'],
        		['visa' => 'Common Visa with Qatar','country_id' => '137'],
        		['visa' => 'Ship Passengers & Crew','country_id' => '137'],
        		['visa' => 'Residents of AGCC States','country_id' => '137'],
        		['visa' => 'Companions of GCC Nationals','country_id' => '137'],
        		['visa' => 'Country List 1','country_id' => '137'],

        		//Saudi Arabia - ID 157
        		['visa' => 'Business','country_id' => '157'],
        		['visa' => 'Commercial','country_id' => '157'],
        		['visa' => 'Diplomatic and Official','country_id' => '157'],
        		['visa' => 'Employment','country_id' => '157'],
        		['visa' => 'Escort','country_id' => '157'],
        		['visa' => 'Extension of exit / Re-Entry','country_id' => '157'],
        		['visa' => 'Family Visit','country_id' => '157'],
        		['visa' => 'Government Visit','country_id' => '157'],
        		['visa' => 'Personal Visit','country_id' => '157'],
        		['visa' => 'Residence Visit','country_id' => '157'],
        		['visa' => 'Student Visit','country_id' => '157'],
        		['visa' => 'Work Visit','country_id' => '157'],
        		['visa' => 'Hajj','country_id' => '157'],
        		['visa' => 'Umrah','country_id' => '157'],


        		//United Arab Emirates - ID 191
        		['visa' => 'AGCC Citizens','country_id' => '191'],
        		['visa' => 'Western Europe and Pacific Rim Citizens','country_id' => '191'],
        		['visa' => 'Entry Service Permit','country_id' => '191'],
        		['visa' => 'Visit','country_id' => '191'],
        		['visa' => 'Tourist','country_id' => '191'],
        		['visa' => 'Multiple Entry','country_id' => '191'],
        		['visa' => 'Residence','country_id' => '191'],
        	]);
    }
}
