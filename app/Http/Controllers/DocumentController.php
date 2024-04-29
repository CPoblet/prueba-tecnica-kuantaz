<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;

class DocumentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/fichas",
     *     summary="Obtener una lista de fichas",
     *     tags={"Fichas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de fichas",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", description="ID de la ficha"),
     *                 @OA\Property(property="nombre", type="string", description="Nombre de la ficha"),
     *                 @OA\Property(property="id_programa", type="integer", description="ID del programa relacionado"),
     *                 @OA\Property(property="url", type="string", description="URL del documento"),
     *                 @OA\Property(property="categoria", type="string", description="Categoría de la ficha"),
     *                 @OA\Property(property="descripcion", type="string", description="Descripción de la ficha"),
     *             ),
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        $documents = Document::all()->map(function ($document) {
            return [
                'id' => $document->id,
                'nombre' => $document->name,
                'id_programa' => $document->benefit_id,
                'url' => $document->url,
                'categoria' => $document->category,
                'descripcion' => $document->description,
            ];
        });

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => $documents,
        ]);
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
    public function store(StoreDocumentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        //
    }
}
