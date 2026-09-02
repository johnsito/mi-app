<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = auth()->user()->tareas()->latest()->get();

        return view('tareas.index', compact('tareas'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'titulo' => 'required|string|max:120',
        ]);

        $request->user()->tareas()->create($datos);

        return redirect()->route('tareas.index');
    }

    public function update(Tarea $tarea)
    {
        abort_unless($tarea->user_id === auth()->id(), 403);

        $tarea->update(['completada' => ! $tarea->completada]);

        return redirect()->route('tareas.index');
    }

    public function destroy(Tarea $tarea)
    {
        abort_unless($tarea->user_id === auth()->id(), 403);

        $tarea->delete();

        return redirect()->route('tareas.index');
    }
}
