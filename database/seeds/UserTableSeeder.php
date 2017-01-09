<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class UserTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('users')->delete();
    
    User::create(array(
    	'name'     => 'Krishna',
        'username' => 'Krishna',
        'email'    => 'krishna@nettrackers.net',
        'password' => Hash::make('mypass'),
    ));
  }
}