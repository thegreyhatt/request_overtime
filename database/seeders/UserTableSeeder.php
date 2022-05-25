<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Maick Castillo';
        $user->email = 'maick.castillo@leadsolutionsinc.net';
        $user->password = Hash::make('MMC102416');
        $user->role = 'User';
        $user->save();

        $user = new User;
        $user->name = 'Fritzel Ann Tumbagahan';
        $user->email = 'fritzel.ann.tumbagahan@leadsolutionsinc.net';
        $user->password = Hash::make('FART112516');
        $user->role = 'User';
        $user->save();
    }
}
