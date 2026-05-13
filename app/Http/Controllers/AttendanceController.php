<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //index
    public function index(Request $request)
    {
        $attendances = Attendance::with('user')
            ->when($request->input('name'), function ($query, $name) {
                $query->whereHas('user', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                });
            })->orderBy('id', 'desc')->paginate(10);
        return view('pages.absensi.index', compact('attendances'));
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'time_in' => 'nullable|date_format:H:i:s',
            'time_out' => 'nullable|date_format:H:i:s',
            'latlon_in' => 'nullable|string',
            'latlon_out' => 'nullable|string',
        ]);

        try {
            Attendance::create($request->all());
            return redirect()->route('attendances.index')->with('success', 'Attendance created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create attendance.']);
        }
    }
}
