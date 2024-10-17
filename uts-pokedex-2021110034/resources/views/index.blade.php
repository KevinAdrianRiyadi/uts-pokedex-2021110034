<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pokemon</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Index View</h2>




        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <a href="create-pokemon">
                        <button class="btn btn-primary mb-3">Add Item</button>
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-primary mb-2">Logout</button>
                        </form>
                    </div>
                </div>


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Species</th>
                            <th>Primary Type</th>
                            <th>Weight</th>
                            <th>Height</th>
                            <th>HP</th>
                            <th>Attack</th>
                            <th>Defense</th>
                            <th>Power</th>
                            <th>Is Legendary</th>
                            <th>Photo</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody id="itemTable">
                        @foreach ($data as $item)
                            <tr>
                                <td>#{{ \Illuminate\Support\Str::padLeft($item->id, 4, 0) }}</td>

                                <td>{{ $item->name }}</td>
                                <td>{{ $item->species }}</td>
                                <td>{{ $item->primary_type }}</td>
                                <td>{{ $item->weight }}</td>
                                <td>{{ $item->height }}</td>
                                <td>{{ $item->hp }}</td>
                                <td>{{ $item->attack }}</td>
                                <td>{{ $item->defense }}</td>
                                <td>{{ $item->power }}</td>
                                <td>{{ $item->is_legendary }}</td>
                                <td><img src="{{ asset('storage/' . $item->photo) }}"
                                        alt="{{ asset('storage/' . $item->photo) }}" class="w-25"></td>

                                <td>
                                    <div class="d-flex gap-4">
                                        <a href="pokemon/{{ $item->id }}">
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="">Edit</button>
                                        </a>
                        <form action="{{ 'destroypokemon/'. $item->id }}" method="POST" enctype="multipart/form-data" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>

            <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="itemModalLabel">Add Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="itemForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="itemName" class="form-label">Item Name</label>
                                    <input type="text" class="form-control" id="itemName" name="name" required>
                                </div>
                                <input type="hidden" id="itemId">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                const itemForm = document.getElementById('itemForm');

                itemForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formData = new FormData(itemForm);
                    const itemId = document.getElementById('itemId').value;

                    if (itemId) {
                        fetch(`/items/${itemId}`, {
                            method: 'PUT',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        fetch('/items', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    }
                });

                function editItem(id) {
                    fetch(`/items/${id}/edit`)
                        .then(response => response.json())
                        .then(item => {
                            document.getElementById('itemName').value = item.name;
                            document.getElementById('itemId').value = item.id;
                            const modal = new bootstrap.Modal(document.getElementById('itemModal'));
                            modal.show();
                        });
                }
            </script>
</body>

</html>
