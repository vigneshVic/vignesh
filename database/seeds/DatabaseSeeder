<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if ($this->command->confirm('Confirm?')) {
    		// $this->command->call('migrate:refresh');
    		$this->command->warn("Data cleared, starting from blank database.");
			$input = $this->command->ask('Enter roles in comma separate format.', 'Admin,User');
    		$this->command->info($input);
        	// $this->call(UsersTableSeeder::class);
        }
    }
}
