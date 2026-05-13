<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Role constants
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_KEPALA_SEKOLAH = 'kepala_sekolah';
    const ROLE_STAFF_TU = 'staff_tu';
    const ROLE_USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'position',
        'department',
        'face_embedding',
        'image_url',
        'fcm_token',
        'nisn',
        'kelas',
        'tahun_lulus',
        'nip',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
        ];
    }

    /**
     * Check if user is Admin
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Check if user is Kepala Sekolah
     */
    public function isKepalaSekolah(): bool
    {
        return $this->role === self::ROLE_KEPALA_SEKOLAH;
    }

    /**
     * Check if user is Staff TU
     */
    public function isStaffTU(): bool
    {
        return $this->role === self::ROLE_STAFF_TU;
    }

    /**
     * Check if user can manage users (create and reset password)
     */
    public function canManageUsers(): bool
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_KEPALA_SEKOLAH]);
    }

    /**
     * Get role label in Indonesian
     */
    public function getRoleLabelAttribute(): string
    {
        return match($this->role) {
            self::ROLE_ADMIN => 'Administrator',
            self::ROLE_KEPALA_SEKOLAH => 'Kepala Sekolah',
            self::ROLE_STAFF_TU => 'Staff TU',
            default => 'Pengguna',
        };
    }
}
