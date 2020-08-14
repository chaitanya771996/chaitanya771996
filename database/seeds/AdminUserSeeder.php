<?php

use Illuminate\Database\Seeder;
use App\Models\AdminUser;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminUser::truncate();

        AdminUser::create([
        			'email' => 'admin@admin.com',
                    'password'=> Hash::make('password'),
                    'created_at' => now(),
                	'updated_at' => now()
        ]);
    }
}
