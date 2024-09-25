<?php

namespace App\Http\Controllers;

use App\Models\Enviroment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnviromentController extends Controller
{
    protected $enviroment;

    public function __construct(Enviroment $enviroment)
    {
        $this->enviroment = $enviroment;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enviroment = $this->enviroment->get();

        if ($enviroment === null) {
            return response()->json(['message' => 'Nenhum resultado encontrado.']);
        }

        return response()->json($enviroment);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $enviroment = $request->validate($this->enviroment->rules(), $this->enviroment->feedback());

        $enviroment = $this->enviroment->create([
            'name' => $request->name,
        ]);

        return response()->json($enviroment);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $enviroment = Enviroment::find($id);

        if ($enviroment === null) {
            return response()->json(['message' => 'Nenhum resultado encontrado.']);
        }

        return response()->json($enviroment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enviroment $enviroment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateName(Request $request, $id)
    {
        $enviroment = Enviroment::find($id);

        if ($enviroment === null) {
            return response()->json(['message' => 'Nenhum resultado encontrado.']);
        }

        if ($request->isMethod('patch')) {
        }
        
        $enviroment->fill($request->all('name'));

        if (strlen($request->name) > 255) {
            return response()->json(['error' => 'Campo nome deve ter até 255 caracteres.']);
        }
        elseif ($request->name === null) {
            return response()->json(['error' => 'Campo nome é obrigatório.']);
        }
        
        $enviroment->save();

        return response()->json($enviroment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $enviroment = Enviroment::find($id);

        if ($enviroment === null) {
            return response()->json(['message' => 'Nenhum resultado encontrado.']);
        }

        $enviroment->delete();

        return response()->json(['success' => 'Ambiente excluído.']);
    }

    public function updateStatus(Request $request, $id)
    {
        $enviroment = Enviroment::find($id);

        if ($enviroment === null) {
            return response()->json(['message' => 'Nenhum resultado encontrado.']);
        }

        if ($request->isMethod('patch')) {
        }

        $enviroment->fill($request->all('status'));

        if ($request->status != '1' && $request->status != '0') {
            return response()->json(['error' => 'Valido apenas 0 ou 1 para esse campo.']);
        }
        
        $enviroment->save();

        return response()->json($enviroment);
    }
}