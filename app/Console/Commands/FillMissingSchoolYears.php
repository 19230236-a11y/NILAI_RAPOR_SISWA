<?php

namespace App\Console\Commands;

use App\Models\Grade;
use App\Models\SchoolYear;
use Illuminate\Console\Command;

class FillMissingSchoolYears extends Command
{
    protected $signature = 'grades:fill-missing-years';
    protected $description = 'Fill missing school_year_id in grades table';

    public function handle()
    {
        // Get the latest school year
        $latestYear = SchoolYear::latest('year')->first();

        if (!$latestYear) {
            $this->error('Tidak ada tahun ajaran dalam database');
            return Command::FAILURE;
        }

        // Count grades with null school_year_id
        $count = Grade::whereNull('school_year_id')->count();

        if ($count === 0) {
            $this->info('Semua grades sudah memiliki school_year_id');
            return Command::SUCCESS;
        }

        // Update all null school_year_id with latest school year
        Grade::whereNull('school_year_id')->update(['school_year_id' => $latestYear->id]);

        $this->info("✓ Berhasil mengupdate $count grade dengan tahun ajaran: {$latestYear->name}");
        return Command::SUCCESS;
    }
}
