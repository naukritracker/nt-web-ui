<?php

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('company')->truncate();

        Company::insert([
        	['name' => 'JBL Technologies','state_id'=>10,'country_id'=>191,'contactno'=>0],
        	['name' => 'HCL Technologies','state_id'=>11,'country_id'=>191,'contactno'=>0],
        	['name' => 'Bosch Pvt Ltd','state_id'=>13,'country_id'=>191,'contactno'=>0],
        	['name' => 'Marks & Spencer','state_id'=>12,'country_id'=>191,'contactno'=>0],
        	['name' => 'Twitter Inc','state_id'=>14,'country_id'=>191,'contactno'=>0],
        	['name' => 'Starbucks','state_id'=>9,'country_id'=>191,'contactno'=>0],
        	['name' => 'Taco Bell','state_id'=>10,'country_id'=>191,'contactno'=>0],
        	['name' => 'McDonald\'s','state_id'=>8,'country_id'=>191,'contactno'=>0],
        	['name' => 'Burger King','state_id'=>14,'country_id'=>191,'contactno'=>0],
        	['name' => 'Spalding','state_id'=>11,'country_id'=>191,'contactno'=>0],
        	['name' => 'Zimmer Pvt Ltd','state_id'=>12,'country_id'=>191,'contactno'=>0],
        	['name' => 'Giordiano','state_id'=>12,'country_id'=>191,'contactno'=>0],
        ]);

    }
}
