@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Teacher</h1>
    <form action="{{ route('teachers.update', $teacher) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" value="{{ $teacher->nip }}" required>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $teacher->name }}" required>
        </div>
        <div class="form-group">
            <label>Subject</label>
            <select name="subject_id" class="form-control" required>
                @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" {{ $teacher->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection