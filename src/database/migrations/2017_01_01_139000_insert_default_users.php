<?php

use Illuminate\Database\Migrations\Migration;
use LaravelEnso\Core\app\Models\Owner;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\RoleManager\app\Models\Role;

class InsertDefaultUsers extends Migration
{
    public function up()
    {
        \DB::transaction(function () {
            $owner = Owner::whereName('Admin')->first();
            $role = Role::whereName('admin')->first();

            $users = [
                ['password' => '$2y$10$viKqL0/qom/BCoiqS08N1utwO63oJd3VJo/aTpGBAX9H4R7zUfdVa', 'first_name' => 'Adi', 'last_name' => 'Ocneanu', 'email' => 'aocneanu@gmail.com', 'phone' => null, 'is_active' => 1],
                ['password' => '$2y$10$/SM/4KgBJF/CErwhftKRVelzRJwGK0puek6/OnBmX/AWN347kXXOe', 'first_name' => 'Mihai', 'last_name' => 'Ocneanu', 'email' => 'mihai.ocneanu@gmail.com', 'phone' => null, 'is_active' => 1],
            ];

            foreach ($users as $user) {
                $password = $user['password'];
                $email = $user['email'];
                $user = new User($user);
                $user->password = $password;
                $user->email = $email;
                $user->owner_id = $owner->id;
                $user->role_id = $role->id;

                $user->save();
            }
        });
    }

    public function down()
    {
        $users = User::all();
        $users->each(function ($user) {
            $user->action_logs->each->delete();
            $user->logins->each->delete();
            $user->delete();
        });
    }
}
