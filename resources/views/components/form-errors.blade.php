@if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm" role="alert" aria-live="assertive">
        <h2 class="h6 mb-2">Periksa kembali input berikut:</h2>
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
