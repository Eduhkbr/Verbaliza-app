<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Exibe uma lista de projetos do utilizador autenticado.
     */
    public function index(Request $request)
    {
        $projects = $request->user()->projects()->latest()->get();
        return response()->json($projects);
    }

    /**
     * Guarda um novo projeto no banco de dados.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'genre' => 'nullable|string|max:100',
            'synopsis' => 'nullable|string',
            'word_count_goal' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $project = $request->user()->projects()->create($validator->validated());

        return response()->json($project, 201);
    }
}
