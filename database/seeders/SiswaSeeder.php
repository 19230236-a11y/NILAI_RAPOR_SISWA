<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $namaDepan = [
            'Ahmad', 'Budi', 'Citra', 'Dian', 'Eka', 'Fajar', 'Gilang', 'Hendra', 'Indah', 'Joko',
            'Kurnia', 'Lestari', 'Mira', 'Nanda', 'Okta', 'Putra', 'Qori', 'Rina', 'Sari', 'Taufik',
            'Umar', 'Vina', 'Wahyu', 'Xena', 'Yudi', 'Zahra', 'Agus', 'Bagas', 'Cindy', 'Dicky',
            'Elsa', 'Ferdi', 'Gina', 'Hadi', 'Irma', 'Jefri', 'Kiki', 'Lina', 'Mando', 'Nita',
            'Oscar', 'Putri', 'Rendi', 'Sinta', 'Teguh', 'Ulfa', 'Vicky', 'Wulan', 'Yanti', 'Zaki',
            'Aditya', 'Bella', 'Chandra', 'Deni', 'Erika', 'Fauzan', 'Galih', 'Husna', 'Ivan', 'Juliana',
            'Kevin', 'Lisa', 'Mario', 'Neni', 'Opi', 'Pandu', 'Rafi', 'Sela', 'Tari', 'Umi',
            'Vega', 'Wendi', 'Yoga', 'Zulfa', 'Angga', 'Bunga', 'Candra', 'Desy', 'Evan', 'Fita',
            'Guntur', 'Hesti', 'Ilham', 'Jesica', 'Krisna', 'Laila', 'Megi', 'Noval', 'Ori', 'Prima',
            'Rangga', 'Siska', 'Toni', 'Ulfah', 'Vera', 'Wisnu', 'Yola', 'Zidan', 'Alif', 'Bayu',
        ];

        $namaBelakang = [
            'Pratama', 'Saputra', 'Kusuma', 'Wijaya', 'Santoso', 'Rahayu', 'Lestari', 'Permata', 'Nugroho', 'Hidayat',
            'Setiawan', 'Purnama', 'Dewi', 'Wulandari', 'Firmansyah', 'Hakim', 'Aziz', 'Ramadhan', 'Putranto', 'Suharto',
            'Surya', 'Perdana', 'Rizki', 'Ardian', 'Gunawan', 'Wahyudi', 'Hermawan', 'Prasetyo', 'Suryadi', 'Basuki',
        ];

        $jurusanList = [
            [
                'department' => 'Teknik Otomotif',
                'kelas_prefix' => 'TO',
            ],
            [
                'department' => 'Teknik Komputer Jaringan',
                'kelas_prefix' => 'TKJ',
            ],
            [
                'department' => 'Keperawatan',
                'kelas_prefix' => 'KPR',
            ],
            [
                'department' => 'Farmasi',
                'kelas_prefix' => 'FAR',
            ],
            [
                'department' => 'Teknik Kendaraan Ringan',
                'kelas_prefix' => 'TKR',
            ],
        ];

        $tingkat = ['X', 'XI', 'XII'];
        $tahunLulusList = ['2024', '2025', '2026'];
        $emailCounter = 1;

        foreach ($jurusanList as $jurusan) {
            $prefix = $jurusan['kelas_prefix'];
            $dept   = $jurusan['department'];

            for ($i = 0; $i < 100; $i++) {
                $depan   = $namaDepan[$i % count($namaDepan)];
                $belakang = $namaBelakang[$i % count($namaBelakang)];
                $nama    = $depan . ' ' . $belakang;

                $tingkatIdx  = $i % 3;
                $kelasAngka  = ($i % 3) + 1;
                $kelas       = $tingkat[$tingkatIdx] . ' ' . $prefix . ' ' . $kelasAngka;

                $tahunLulus = $tahunLulusList[$tingkatIdx];

                $nisn = '00' . str_pad(($emailCounter * 7 + $i * 13) % 100000000, 8, '0', STR_PAD_LEFT);

                $emailSlug = strtolower(str_replace(' ', '.', $depan)) . $emailCounter;
                $email     = $emailSlug . '@siswa.sch.id';

                User::create([
                    'name'        => $nama,
                    'email'       => $email,
                    'password'    => Hash::make('password'),
                    'role'        => 'siswa',
                    'department'  => $dept,
                    'nisn'        => $nisn,
                    'kelas'       => $kelas,
                    'tahun_lulus' => $tahunLulus,
                ]);

                $emailCounter++;
            }
        }
    }
}
