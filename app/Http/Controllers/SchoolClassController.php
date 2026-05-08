<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $programId = $request->get('program', null);
        
        $query = SchoolClass::query();
        
        // Filter by program if specified
        if ($programId) {
            $query->where('program_id', $programId);
        }
        
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $classes = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('classes.index', compact('classes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:classes',
            'level' => 'nullable|integer|min:1|max:12',
            'jurusan' => 'nullable|string|max:50',
            'wali_kelas' => 'nullable|string|max:255',
        ]);

        SchoolClass::create($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolClass $class)
    {
        $class->load(['students', 'grades.subject', 'grades.semester']);
        return view('classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolClass $class)
    {
        return view('classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolClass $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:classes,name,' . $class->id,
            'level' => 'nullable|integer|min:1|max:12',
            'jurusan' => 'nullable|string|max:50',
            'wali_kelas' => 'nullable|string|max:255',
        ]);

        $class->update($validated);

        return redirect()->route('classes.show', $class)
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolClass $class)
    {
        $class->delete();

        return redirect()->route('classes.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}