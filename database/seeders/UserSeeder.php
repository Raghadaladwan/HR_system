<?php

namespace Database\Seeders;

use App\Models\EmployeeDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate(
            [
                'email' => 'hr@hr.com'
            ],
            [
                'name' => 'HR',
                'email' => 'hr@hr.com',
                'password' => Hash::make('hr12345'),
                'user_type' => 1
            ]
        );

        $info = EmployeeDetail::create([
            'user_id' => $user->id,
            'status' => 1,
            'contact' => '+00962797789333',
            'job_title' => 'HR Manager',
        ]);

        $employee = User::firstOrCreate(
            [
                'email' => 'employee@gmail.com'
            ],
            [
                'name' => 'employee',
                'email' => 'employee@gmail.com',
                'password' => Hash::make('employee12345'),
                'user_type' => 2
            ]
        );

        $info = EmployeeDetail::create([
            'user_id' => $employee->id,
            'status' => 1,
            'contact' => '+00962797789332',
            'job_title' => 'IT Manager',
        ]);
    }
}
