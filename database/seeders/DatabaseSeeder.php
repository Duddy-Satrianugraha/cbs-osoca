<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(OptionSeeder::class);
         $this->call(OtemplatesTableSeeder::class);
         $this->call(OrubriksTableSeeder::class);
         $this->call(OujiansTableSeeder::class);
         $this->call(OstationsTableSeeder::class);
         $this->call(OsesisTableSeeder::class);
         //$this->call(OpesertasTableSeeder::class);

        // $this->call(OnilaisTableSeeder::class);
        // $this->call(OfeedbacksTableSeeder::class);
        $this->call(OpengujisTableSeeder::class);
    }
}
