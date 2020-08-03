<?php

use App\Models\Profile;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
{
    const DEFAULT_PASSWORD = 'segura';
    const DEFAULT_DOMAIN = 'atm.ec';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $adminRole = Role::whereName('Admin')->first();
        $atmAdminRole = Role::whereName('ATM Admin')->first();
        $atmOperatorRole = Role::whereName('ATM Operator')->first();
        $atmStockkeeperRole = Role::whereName('ATM Stockkeeper')->first();
        $atmCollectorRole = Role::whereName('ATM Collector')->first();

        // Seed test admin
        $seededSuperAdminEmail = 'superadmin@' . self::DEFAULT_DOMAIN;
        $user = User::where('email', '=', $seededSuperAdminEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'Super Admin',
                'first_name'                     => 'Super',
                'last_name'                      => 'Admin',
                'email'                          => $seededSuperAdminEmail,
                'password'                       => Hash::make('Phr@gmiped1um'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'               => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($adminRole);
            $user->save();
        }

        // Seed ATM admin
        $seededAdminEmail = 'admin@' . self::DEFAULT_DOMAIN;
        $user = User::where('email', '=', $seededAdminEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'Admin ATM',
                'first_name'                     => 'ATM',
                'last_name'                      => 'Admin',
                'email'                          => $seededAdminEmail,
                'password'                       => Hash::make(self::DEFAULT_PASSWORD),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'               => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($atmAdminRole);
            $user->save();
        }

        // Seed ATM operator
        $seededOperatorEmail = 'operador@' . self::DEFAULT_DOMAIN;
        $user = User::where('email', '=', $seededOperatorEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'Operador ATM',
                'first_name'                     => 'ATM',
                'last_name'                      => 'Operador',
                'email'                          => $seededOperatorEmail,
                'password'                       => Hash::make(self::DEFAULT_PASSWORD),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'               => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($atmOperatorRole);
            $user->save();
        }

        // Seed ATM stockkeeper
        $seededBodegaEmail = 'bodega@' . self::DEFAULT_DOMAIN;
        $user = User::where('email', '=', $seededBodegaEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'Bodega ATM',
                'first_name'                     => 'ATM',
                'last_name'                      => 'Bodega',
                'email'                          => $seededBodegaEmail,
                'password'                       => Hash::make(self::DEFAULT_PASSWORD),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'               => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($atmStockkeeperRole);
            $user->save();
        }

        // Seed ATM collector
        $seededEscaleraEmail = 'escalera@' . self::DEFAULT_DOMAIN;
        $user = User::where('email', '=', $seededEscaleraEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'Escalera ATM',
                'first_name'                     => 'ATM',
                'last_name'                      => 'Escalera',
                'email'                          => $seededEscaleraEmail,
                'password'                       => Hash::make(self::DEFAULT_PASSWORD),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'               => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($atmCollectorRole);
            $user->save();
        }
    }
}
