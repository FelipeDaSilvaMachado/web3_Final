<?php

namespace App\Http\Controllers;

use App\Models\Automoveis;
use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\AcceptHeader;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class AutomoveisController extends Controller
{
    // Lista todos os registros
    public function index()
    {
        $automoveis = Automoveis::all();
        return response()->json($automoveis, 200);
    }

    // Exibe um registro pelo ID
    public function show($id)
    {
        $automoveis = Automoveis::find($id);
        if (!$automoveis) {
            return response()->json(['erro' => 'Item não encontrado'], 404);
        }
        return response()->json($automoveis, 200);
    }

    // Cria um novo registro
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'ano' => 'required|string',
            'cor' => 'required|string',
            'descricao' => 'nullable|string',
        ]);

        try {
            $automoveis = Automoveis::create($request->all());
            return response()->json($automoveis, 201);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Erro ao criar registro',
                'mensagem' => $e->getMessage()
            ], 500);
        }
        // Criando o registro usando mass assignment (previamente configurado no model)
        $automoveis = Automoveis::create($request->all());

        return response()->json($automoveis, 201);
    }

    // Atualiza um registro existente
    public function update(Request $request, $id)
    {
        try {
            $automoveis = Automoveis::findOrFail($id);

            $validated = $request->validate([
                'nome' => 'sometimes|string',
                'marca' => 'sometimes|string',
                'modelo' => 'sometimes|string',
                'ano' => 'sometimes|string',
                'cor' => 'sometimes|string',
                'descricao' => 'sometimes|string',
            ]);

            // Atualizando somente os campos enviados
            $automoveis->update($validated);

            return response()->json([
                'message' => 'Automóvel atualizado com sucesso',
                'data' => $automoveis,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Automóvel não encontrado'
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar automóvel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Remove um registro pelo ID
    public function destroy($id)
    {
        $automoveis = Automoveis::find($id);
        if (!$automoveis) {
            return response()->json(['erro' => 'Item não encontrado'], 404);
        }

        $automoveis->delete();
        return response()->json(['mensagem' => 'Item removido com sucesso'], 200);
    }
}
