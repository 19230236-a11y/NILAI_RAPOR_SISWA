<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\SchoolYear;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display dashboard based on user role.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        // Get common data
        $stats = $this->getStats();
        
        // Role-specific dashboard
        return match($user->role) {
            'admin', 'kepala_sekolah' => $this->adminDashboard($stats),
            'staff_tu' => $this->staffTuDashboard($stats),
            default => $this->defaultDashboard($stats),
        };
    }

    /**
     * Get common statistics
     */
    private function getStats(): array
    {
        return [
            'total_siswa' => Student::count(),
            'total_guru' => Teacher::count(),
            'total_mapel' => Subject::count(),
            'total_kelas' => SchoolClass::count(),
            'total_tahun_ajaran' => SchoolYear::count(),
            'total_nilai' => Grade::count(),
            'total_jurusan' => Program::count(),
        ];
    }

    /**
     * Admin Dashboard
     */
    private function adminDashboard(array $stats): \Illuminate\View\View
    {
        $recentGrades = Grade::with(['student', 'subject'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.admin', compact('stats', 'recentGrades'));
    }

    /**
     * Staff TU Dashboard
     */
    private function staffTuDashboard(array $stats): \Illuminate\View\View
    {
        $recentStudents = Student::with('program')->latest()->take(10)->get();
        $recentGrades = Grade::with(['student', 'subject'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.staff_tu', compact('stats', 'recentStudents', 'recentGrades'));
    }

    /**
     * Default Dashboard
     */
    private function defaultDashboard(array $stats): \Illuminate\View\View
    {
        return view('dashboard.default', compact('stats'));
    }
}