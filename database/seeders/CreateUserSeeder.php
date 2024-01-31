<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nama' => 'Iqbal Maulana',
                'nipp' => 'iqbal',
                'password' => bcrypt('iqbal'),
                'divisi_id' => 1,
                'status' => true,
                'nomor_hp' => '087884550875',
                'avatar' => 'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=80&d=retro'
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
