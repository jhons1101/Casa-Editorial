<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
    <title>Lista de productos</title>
</head>
<body>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h2>Consulta de productos</h2>
            </div>
        </div>
        <form method="GET" action="{{ url('/productos/search') }}" name="search" id="search" >
        <div class="row">
            <div class="col">
                <label for="name" class="form-label">Nombre</label>
                <input name="name" type="text" class="form-control" id="name" value="{{ $name }}">
            </div>
            <div class="col">
                <label for="description" class="form-label">Descripción</label>
                <input name="description" type="text" class="form-control" id="description" value="{{ $description }}">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="status" class="form-label">Estado</label>
                <select name="status" id="status" class="form-select">
                    <option value="">-- Seleccionar --</option>
                    <option value="Activo" {{ $status == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ $status == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="col">
                <label for="category" class="form-label">Categoria</label>
                <select name="category" id="category" class="form-select">
                    <option value="">-- Seleccionar --</option>
                    <option value="Producto físico" {{ $category == 'Producto físico' ? 'selected' : '' }}>Producto físico</option>
                    <option value="Producto digital" {{ $category == 'Producto digital' ? 'selected' : '' }}>Producto digital</option>
                </select>
            </div>
        </div>
        <div class="row mt">
            <div class="col">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                    <span>Consultar</span>
                </button>
                <a href="{{ url('/productos/') }}" class="btn btn-outline-dark" title="Limpiar">
                    <i class="bi bi-x-circle"></i>
                    Limpiar
                </a>
                <div class="col float-end">
                    <a href="{{ url('/productos/create') }}" class="btn btn-dark">
                        <i class="bi bi-plus-lg"></i>
                        <span>Crear producto</span>
                    </a>
                </div>
            </div>
        </div>
        </form>
            
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <div class="row">
            <table class="table table-striped table-bordered">
                @if($quantity > 0)
                <tr>
                    <td colspan="8">
                        Total de productos encontrados: {{ $quantity }}
                    </td>
                </tr>
                @endif
                <tr>
                    <th>Id</th>
                    <th width="20%">Nombre</th>
                    <th width="30%">Descripción</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Stock</th>
                    <th>Categoria</th>
                    <th>&nbsp;</th>
                </tr>
                @forelse($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->name }}</td>
                    <td>{{ $producto->description }}</td>
                    <td class="text-sm-end">${{ number_format($producto->price, 2) }}</td>
                    <td>{{ ucfirst($producto->status) }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->category }}</td>
                    <td>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-outline-dark btn-sm" title="Editar">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-dark btn-sm" title="Inactivar"
                                    onclick="return confirm('¿Seguro que deseas inactivar este producto?')">
                                <i class="bi bi-eye-slash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">¡No se encontraron productos!</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</body>
</html>