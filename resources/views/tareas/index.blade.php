<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mis tareas</title>
  <style>
    body { font-family: system-ui, sans-serif; max-width: 40rem;
           margin: 3rem auto; padding: 0 1rem; }
    li { display: flex; gap: .6rem; align-items: center; margin: .4rem 0; }
    .hecha { text-decoration: line-through; opacity: .55; }
    ul { list-style: none; padding: 0; }
    form { display: inline; }
  </style>
</head>
<body>
  <h1>Mis tareas</h1>

  <form method="POST" action="{{ route('tareas.store') }}">
    @csrf
    <input name="titulo" placeholder="Nueva tarea" required autofocus>
    <button>Agregar</button>
  </form>

  @error('titulo') <p>{{ $message }}</p> @enderror

  <ul>
    @forelse ($tareas as $tarea)
      <li>
        <form method="POST" action="{{ route('tareas.update', $tarea) }}">
          @csrf @method('PUT')
          <button title="Marcar">{{ $tarea->completada ? '☑' : '☐' }}</button>
        </form>

        <span class="{{ $tarea->completada ? 'hecha' : '' }}">{{ $tarea->titulo }}</span>

        <form method="POST" action="{{ route('tareas.destroy', $tarea) }}">
          @csrf @method('DELETE')
          <button title="Borrar">✕</button>
        </form>
      </li>
    @empty
      <li>Todavía no hay tareas.</li>
    @endforelse
  </ul>
</body>
</html>