<?php
// ================================================================
// database/seeders/DatabaseSeeder.php
// ================================================================
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
 
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,  // Harus pertama karena NewsSeeder butuh User
            ProgramSeeder::class,
            AchievementSeeder::class,
            NewsSeeder::class,
        ]);
 
        $this->command->newLine();
        $this->command->info('🎉 Database seeded successfully!');
        $this->command->info('');
        $this->command->info('🔐 Login Admin:');
        $this->command->info('   URL      : /admin');
        $this->command->info('   Email    : admin@cahayabangsa.org');
        $this->command->info('   Password : password123');
    }
}
 