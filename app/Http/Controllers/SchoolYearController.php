<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $years = SchoolYear::orderBy('year', 'desc')->paginate(15);

        return view('school-years.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('school-years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|string|max:9|unique:school_years',
            'is_active' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        // If setting as active, deactivate others
        if (isset($validated['is_active']) && $validated['is_active']) {
            SchoolYear::where('is_active', true)->update(['is_active' => false]);
        }

        SchoolYear::create($validated);

        return redirect()->route('school-years.index')
            ->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolYear $schoolYear)
    {
        $schoolYear->load(['semesters', 'grades']);
        return view('school-years.show', compact('schoolYear'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolYear $schoolYear)
    {
        return view('school-years.edit', compact('schoolYear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolYear $schoolYear)
    {
        $validated = $request->validate([
            'year' => 'required|string|max:9|unique:school_years,year,' . $schoolYear->id,
            'is_active' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        // If setting as active, deactivate others
        if (isset($validated['is_active']) && $validated['is_active']) {
            SchoolYear::where('is_active', true)
                ->where('id', '!=', $schoolYear->id)
                ->update(['is_active' => false]);
        }

        $schoolYear->update($validated);

        return redirect()->route('school-years.show', $schoolYear)
            ->with('success', 'Tahun ajaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolYear $schoolYear)
    {
        $schoolYear->delete();

        return redirect()->route('school-years.index')
            ->with('success', 'Tahun ajaran berhasil dihapus.');
    }

    /**
     * Set active school year
     */
    public function setActive(SchoolYear $schoolYear)
    {
        SchoolYear::where('is_active', true)->update(['is_active' => false]);
        $schoolYear->update(['is_active' => true]);

        return redirect()->route('school-years.index')
            ->with('success', 'Tahun ajaran aktif berhasil diubah.');
    }
}