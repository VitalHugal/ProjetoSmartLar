<?php

namespace App\Http\Controllers;

use App\Models\LightBuld;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;


class LightBuldController extends Controller
{

    protected $light_buld;

    public function __construct(LightBuld $light_buld)
    {
        $this->light_buld = $light_buld;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $light_buld = $this->light_buld->get();

        return response()->json($light_buld);
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
        $light_buld = $request->validate($this->light_buld->rules(), $this->light_buld->feedback());

        $light_buld = $this->light_buld->create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json($light_buld);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $light_buld = LightBuld::find($id);

        if ($light_buld === null) {
            return response()->json(['message' => 'Nenhum resultado encontrado.']);
        }

        return response()->json($light_buld);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LightBuld $lightBuld)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $light_buld = LightBuld::find($id);

        if ($light_buld === null) {
            return response()->json(['message' => 'Nenhum resultado encontrado.']);
        }

        if ($request->method === "PATCH") {
        }

        $request->validate($this->light_buld->rules(), $this->light_buld->feedback());        // dd($light_buld);
        $light_buld->fill($request->all());
        $light_buld->save();

        return response()->json($light_buld);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $light_buld = LightBuld::find($id);

        if($light_buld === null){
            return response()->json(['message' => 'Nenhum resultado encontrado.']);
        }

        $light_buld->delete();

        return response()->json(['success' => 'Excluido com sucesso.']);
    }
}