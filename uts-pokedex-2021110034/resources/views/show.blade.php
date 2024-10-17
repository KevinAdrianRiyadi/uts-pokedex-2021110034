<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Create Item</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Show Item</h2>
    <a href="/">
        <button type="submit" class="btn-primary">Back</button>
    </a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- <form action="{{ route('items.store') }}" method="POST"> --}}
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Item Name</label>
            <input type="text" class="form-control" id="name" name="name" disabled value="{{$data->name}}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Species</label>
            <input type="text" class="form-control" id="species" name="species" disabled value="{{$data->species}}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Primary Type</label>
            <select class="primary-type" aria-label="Default select example">
                <option selected>{{$data->primary_type}}</option>
              </select>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Weight</label>
            <input type="text"  value={{$data->weight}} class="form-control" id="weight" name="weight" disabled>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Height</label>
            <input type="text" value="{{$data->height}}" class="form-control" id="height" name="height" disabled>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">HP</label>
            <input type="text" value={{$data->hp}} class="form-control" id="hp" name="hp" disabled>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Attack</label>
            <input type="text" value={{$data->attack}} class="form-control" id="attack" name="attack" disabled>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Defense</label>
            <input type="text" value={{$data->defense}} class="form-control" id="defense" name="defense" disabled>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Is Legendary?</label>
            <input type="text" value={{$data->is_legendary}} class="form-control" id="is_legendary" name="is_legendary" disabled>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Current Photo</label>
            <img src="{{ asset('storage/' . $data->photo) }}" alt="" class="w-25">
            {{-- <input type="text" value={{$data->hp}} class="form-control" id="name" name="name" disabled> --}}
        </div>
        {{-- <button type="submit" class="btn btn-primary">Create Item</button> --}}
        {{-- <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a> --}}
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
