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
    <h2 class="mb-4">Create New Item</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('create-pokemon') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Item Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Species</label>
            <input type="text" class="form-control" id="species" name="species" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Primary Type</label>
            <select class="primary_type" aria-label="Default select example" name="primary_type">
                <option selected>Open this select menu</option>
                <option value="Grass">Grass</option>
                <option value="Fire">Fire</option>
                <option value="Water">Water</option>
                <option value="Bug">Bug</option>
                <option value="Normal">Normal</option>
                <option value="Poison">Poison</option>
                <option value="Electric">Electric</option>
                <option value="Ground">Ground</option>
                <option value="Fairy">Fairy</option>
                <option value="Fighting">Fighting</option>
                <option value="Psychic">Psychic</option>
                <option value="Rock">Rock</option>
                <option value="Ghost">Ghost</option>
                <option value="Ice">Ice</option>
                <option value="Dragon">Dragon</option>
                <option value="Dark">Dark</option>
                <option value="Steel">Steel</option>
                <option value="Flying">Flying</option>
              </select>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Weight</label>
            <input type="text" class="form-control" id="weight" name="weight" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Height</label>
            <input type="text" class="form-control" id="height" name="height" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">HP</label>
            <input type="text" class="form-control" id="hp" name="hp" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Attack</label>
            <input type="text" class="form-control" id="attack" name="attack" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Defense</label>
            <input type="text" class="form-control" id="defense" name="defense" required>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="True" name="is_legendary" id="is_legendary">
            <label class="form-check-label" for="is_legendary">
              Is Legendary?
            </label>
          </div>
          <div class="mb-3">
            <label for="inputfile" class="form-label">Photo</label>
            <input class="form-control" type="file" id="inputfile">
          </div>
        <button type="submit" class="btn btn-primary">Create Item</button>
        {{-- <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a> --}}
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
