<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>Perfil del producto</title>
</head>
<body>
    <div class="container mt">
        <h1>Crear Producto</h1>
        <form name="create" method="POST" action="{{ url('/productos') }}">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <label for="name" class="form-label">Nombre</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label for="description" class="form-label">Descripción</label>
                    <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" id="description">
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <label for="status" class="form-label">Estado</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="">-- Seleccionar --</option>
                        <option value="Activo" {{ old('status') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('status') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <label for="category" class="form-label">Categoria</label>
                    <select name="category" id="category" class="form-select @error('category') is-invalid @enderror">
                        <option value="">-- Seleccionar --</option>
                        <option value="Producto físico" {{ old('category') == 'Producto físico' ? 'selected' : '' }}>Producto físico</option>
                        <option value="Producto digital" {{ old('category') == 'Producto digital' ? 'selected' : '' }}>Producto digital</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" id="stock" name="stock">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <label for="price" class="form-label">Precio</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" id="price" name="price">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-save"></i>
                        <span>Registrar</span>
                    </button>
                    <a href="{{ url('/productos') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i>
                        <span>Volver</span>
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>