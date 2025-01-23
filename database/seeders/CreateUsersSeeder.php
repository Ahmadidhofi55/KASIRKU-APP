<?php



namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

use App\Models\User;



class CreateUsersSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run(): void

    {

        $users = [

            [

               'username'=>'KASIR',

               'email'=>'kasir@kasirku.com',
               'img'=>'kasir.png',
               'level'=>1,

               'password'=> bcrypt('kasir1534'),

            ],

            [

               'username'=>'owner',

               'email'=>'owner@kasirku.com',
               'img'=>'owner.png',
               'level'=> 0,

               'password'=> bcrypt('owner1534'),

            ],
        ];



        foreach ($users as $key => $user) {

            User::create($user);

        }

    }

}
