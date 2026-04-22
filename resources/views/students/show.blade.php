@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Student Details</h1>
    <p><strong>NIS:</strong> {{ $student->nis }}</p>
    <p><strong>Name:</strong> {{ $student->name }}</p>
    <p><strong>Gender:</strong> {{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
    <p><strong>Birth Date:</strong> {{ $student->birth_date }}</p>
    <p><strong>Address:</strong> {{ $student->address }}</p>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection