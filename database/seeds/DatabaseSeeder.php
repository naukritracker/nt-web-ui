<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        $this->call('CountryTableSeeder');
        $this->command->info('Country table seeded!');

        $this->call('StateTableSeeder');
        $this->command->info('state table seeded!');

        $this->call('FunctionalAreaTableSeeder');
        $this->command->info('Functional area table seeded!');

        $this->call('IndustryTableSeeder');
        $this->command->info('Industry table seeded!');

        $this->call('VisaTableSeeder');
        $this->command->info('Visa table seeded!');

        $this->call('CompanyTableSeeder');
        $this->command->info('Company table seeded!');

        $this->call('JobPostingTableSeeder');
        $this->command->info('Job Posting table seeded!');

        Model::reguard();
    }
}
