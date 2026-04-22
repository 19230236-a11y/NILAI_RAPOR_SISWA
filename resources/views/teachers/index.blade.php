@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Teachers</h1>
    <a href="{{ route('teachers.create') }}" class="btn btn-primary">Add Teacher</a>
    <table class="table">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $teacher)
            <tr>
                <td>{{ $teacher->nip }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->subject->name }}</td>
                <td>
                    <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-info">View</a>
                    <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $teachers->links() }}
</div>
@endsection