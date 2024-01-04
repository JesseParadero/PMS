<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userlist = [
            ['Dan', 'Cisneros', 'c-choronostep@gmail.com', 'qwerty', '2'],
            ['Jesse', 'Paradero', 'p-jesse@choronostep.com', 'qwerty', '1'],
            ['Juma', 'Mumar', 'j-choronostep@gmail.com', 'qwerty', '1'],
            ['qwe', 'tr', 'y-choronostep@gmail.com', 'qwerty', '1'],
            ['Kazunari', 'Mino', 'mino-choronostep@gmail.com', 'qwerty', '3'],
        ];

        $users = [];

        foreach ($userlist as $user) {
            $users[] = [
                'firstname' => $user[0],
                'lastname' => $user[1],
                'email' => $user[2],
                'password' => bcrypt($user[3]),
                'role' => $user[4],
            ];
        }

        User::inserting($users);
    }
}
