<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $userinfo = new User();
        $userinfo->state_id = 1;
        $userinfo->identity_id = 1;
        $userinfo->gender_id = 3;
        $userinfo->dni = '95933899';
        $userinfo->phone = '2995529100';
        $userinfo->name = 'Juan Pablo';
        $userinfo->lastname = 'Moreno Gonzalez';
        $userinfo->email = 'admin@admin.com';
        $userinfo->password = '123456789';
        $userinfo->role_id = 1;
        $userinfo->email_verified_at = now();
        $userinfo->saveQuietly();
    }
}
