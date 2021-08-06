<?php

use Illuminate\Database\Seeder;
use App\Models\Department;

class DeptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::truncate();
        $dept_array = [
            ['dept_name'=>'HR','created_at' => now(),'updated_at'=> now()],
            ['dept_name'=>'Production','created_at' => now(),'updated_at'=> now()],
            ['dept_name'=>'Marketing','created_at' => now(),'updated_at'=> now()],
            ['dept_name'=>'Development','created_at' => now(),'updated_at'=> now()],
        ];
        // dd($dept_array);
        Department::insert($dept_array);
    }
}
