<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);
        $avatar_list = Storage::files('avatar');

        $users = factory(User::class)
                    ->times(10)
                    ->make()
                    ->each(function ($user, $index)
                        use ($faker, $avatar_list)
                    {

                        $rand = array_rand($avatar_list, 1);
                        $user->avatar = Storage::url($avatar_list[$rand]);
                    });

        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        User::insert($user_array);

        $user = User::find(1);
        $user->name = 'skyloong';
        $user->email = 'skyloong@gmail.com';
        $user->avatar = Storage::url($avatar_list[0]);
        $user->save();

        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');
    }
}
