<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class JurusanController extends Controller
{
    /**
     * Teknik Otomotif
     */
    public function teknikOtomotif(Request $request)
    {
        $siswa = User::where('department', 'Teknik Otomotif')
            ->where('name', 'like', '%' . $request->name . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('pages.jurusan.teknik-otomotif', compact('siswa'));
    }

    /**
     * Teknik Komputer Jaringan
     */
    public function teknikKomputerJaringan(Request $request)
    {
        $siswa = User::where('department', 'Teknik Komputer Jaringan')
            ->where('name', 'like', '%' . $request->name . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('pages.jurusan.teknik-komputer-jaringan', compact('siswa'));
    }

    /**
     * Keperawatan
     */
    public function keperawatan(Request $request)
    {
        $siswa = User::where('department', 'Keperawatan')
            ->where('name', 'like', '%' . $request->name . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('pages.jurusan.keperawatan', compact('siswa'));
    }

    /**
     * Farmasi
     */
    public function farmasi(Request $request)
    {
        $siswa = User::where('department', 'Farmasi')
            ->where('name', 'like', '%' . $request->name . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('pages.jurusan.farmasi', compact('siswa'));
    }

    /**
     * Teknik Kendaraan Ringan
     */
    public function teknikKendaraanRingan(Request $request)
    {
        $siswa = User::where('department', 'Teknik Kendaraan Ringan')
            ->where('name', 'like', '%' . $request->name . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('pages.jurusan.teknik-kendaraan-ringan', compact('siswa'));
    }
}
