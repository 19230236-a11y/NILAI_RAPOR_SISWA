<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['name', 'code', 'description'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function classes()
    {
        return $this->hasMany(SchoolClass::class);
    }

    public function getLogoPath()
    {
        $logoMap = [
            'FK' => 'Logo-Farmasi.png',
            'AK' => 'Logo-Keperawatan.png',
            'TKJ' => 'Logo-TKJ.png',
            'TSM' => 'Logo-TBSM.png',
            'TKR' => 'Logo-TKRO.png',
        ];
        return $logoMap[$this->code] ?? 'logo.png';
    }
}
