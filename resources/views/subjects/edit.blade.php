@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Subject</h1>
    <form action="{{ route('subjects.update', $subject) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Subject Name</label>
            <input type="text" name="name" class="form-control" value="{{ $subject->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection