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
        $this->call(OptionSeeder::class);
        $this->call(TemplatesTableSeeder::class);
        $this->call(RubriksTableSeeder::class);
        
        $this->call(UjiansTableSeeder::class);
        $this->call(SesisTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(SoalsTableSeeder::class);
        $this->call(RotationsTableSeeder::class);
        $this->call(StationsTableSeeder::class);
        $this->call(PesertasTableSeeder::class);
        $this->call(PendaftaransTableSeeder::class);
        $this->call(OtemplatesTableSeeder::class);
        $this->call(OrubriksTableSeeder::class);
    }
}
