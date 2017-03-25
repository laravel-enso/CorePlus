<?php

use App\Owner;
use App\User;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::transaction(function () {
            $owner = Owner::whereName('Admin');
            $role = Role::whereName('admin');
            $defaults = ['owner_id' => $owner->id, 'role_id' => $role->id, 'nin' => null, 'is_active' => 1];

            $users = [
                ['password' => '$2y$10$viKqL0/qom/BCoiqS08N1utwO63oJd3VJo/aTpGBAX9H4R7zUfdVa', 'first_name' => 'Adi', 'last_name' => 'Ocneanu', 'email' => 'aocneanu@gmail.com', 'phone' => null],
                ['password' => '$2y$10$/SM/4KgBJF/CErwhftKRVelzRJwGK0puek6/OnBmX/AWN347kXXOe', 'first_name' => 'Mihai', 'last_name' => 'Ocneanu', 'email' => 'mihai.ocneanu@gmail.com', 'phone' => null],
            ];

            foreach ($users as $user) {
                $password = $user['password'];
                $email = $user['email'];
                $user = new User($user);
                $user->fill($defaults);
                $user->password = $password;
                $user->email = $email;
                $user->owner_id = $defaults['owner_id'];

                $user->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table('users')->delete();
    }
}
