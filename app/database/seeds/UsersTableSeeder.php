<?php

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $u = new User;
        $u->email = 'test@nep.email';
        $u->username = 'test';
        $u->apikey = 'testkey';
        $u->password = Hash::make('test');
        $u->save();
    }

}