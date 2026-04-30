<?php
// ================================================================
// database/seeders/AchievementSeeder.php
// ================================================================
namespace Database\Seeders;
 
use App\Models\Achievement;
use Illuminate\Database\Seeder;
 
class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            ['student_name' => 'Ahmad Fauzi',       'education_level' => 'SMA', 'competition_name' => 'Olimpiade Matematika Nasional',        'competition_level' => 'Nasional',      'award' => 'Juara 1',         'year' => 2024, 'is_featured' => true],
            ['student_name' => 'Siti Rahayu',        'education_level' => 'SMP', 'competition_name' => 'Lomba Karya Ilmiah Remaja',             'competition_level' => 'Provinsi',      'award' => 'Juara 2',         'year' => 2024, 'is_featured' => true],
            ['student_name' => 'Budi Santoso',       'education_level' => 'SD',  'competition_name' => 'Olimpiade Sains Kuark',                 'competition_level' => 'Nasional',      'award' => 'Medali Perak',    'year' => 2024, 'is_featured' => true],
            ['student_name' => 'Dewi Lestari',       'education_level' => 'SMA', 'competition_name' => 'Lomba Debat Bahasa Inggris',            'competition_level' => 'Provinsi',      'award' => 'Juara 1',         'year' => 2024, 'is_featured' => true],
            ['student_name' => 'Muhammad Rizki',     'education_level' => 'SMP', 'competition_name' => 'Olimpiade Fisika Kabupaten',            'competition_level' => 'Kabupaten/Kota','award' => 'Juara 1',         'year' => 2024, 'is_featured' => true],
            ['student_name' => 'Putri Wulandari',    'education_level' => 'SD',  'competition_name' => 'Lomba Mewarnai Tingkat Nasional',       'competition_level' => 'Nasional',      'award' => 'Juara 3',         'year' => 2024, 'is_featured' => true],
            ['student_name' => 'Eko Prasetyo',       'education_level' => 'SMA', 'competition_name' => 'Kompetisi Robotika Nasional',           'competition_level' => 'Nasional',      'award' => 'Juara 2',         'year' => 2023, 'is_featured' => false],
            ['student_name' => 'Nurul Hidayah',      'education_level' => 'SMP', 'competition_name' => 'Lomba Baca Puisi Tingkat Provinsi',     'competition_level' => 'Provinsi',      'award' => 'Juara 1',         'year' => 2023, 'is_featured' => false],
            ['student_name' => 'Reza Firmansyah',    'education_level' => 'SMA', 'competition_name' => 'OSN Kimia',                            'competition_level' => 'Nasional',      'award' => 'Medali Perunggu', 'year' => 2023, 'is_featured' => false],
            ['student_name' => 'Anisa Maharani',     'education_level' => 'SD',  'competition_name' => 'Lomba Cerdas Cermat Kecamatan',         'competition_level' => 'Kecamatan',     'award' => 'Juara 1',         'year' => 2023, 'is_featured' => false],
            ['student_name' => 'Fajar Nugroho',      'education_level' => 'SMP', 'competition_name' => 'Olimpiade Biologi Provinsi',            'competition_level' => 'Provinsi',      'award' => 'Juara 3',         'year' => 2023, 'is_featured' => false],
            ['student_name' => 'Intan Permata Sari', 'education_level' => 'SMA', 'competition_name' => 'Lomba Karya Tulis Ilmiah Internasional','competition_level' => 'Internasional', 'award' => 'Best Paper',      'year' => 2023, 'is_featured' => false],
        ];
 
        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
 
        $this->command->info('✅ Achievements seeded: ' . count($achievements) . ' records');
    }
}