<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('DEPARTMENT')->insert(
            [
                [
                    'deptName' => 'HR Department',
                    
                ],
                [
                    'deptName' => 'IT Department',
                    
                ],
                [
                    'deptName' => 'Audit Department',
                    
                ],
            ]); 
    }
    // php artisan db:seed --class=UserSeeder
}
