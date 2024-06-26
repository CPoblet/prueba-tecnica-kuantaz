<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Http\Requests\StoreBenefitRequest;
use App\Http\Requests\UpdateBenefitRequest;
use App\Models\BenefitUser;
use App\Models\User;

class BenefitController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/filtros",
     *     summary="Obtener una lista de filtros",
     *     tags={"Beneficios"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de beneficios",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id_programa", type="integer", description="ID del programa"),
     *                 @OA\Property(property="tramite", type="string", description="Trámite del beneficio"),
     *                 @OA\Property(property="min", type="integer", description="Monto mínimo del beneficio"),
     *                 @OA\Property(property="max", type="integer", description="Monto máximo del beneficio"),
     *                 @OA\Property(property="ficha_id", type="integer", description="ID de la ficha del beneficio"),
     *             ),
     *         ),
     *     ),
     * )
     **/
    public function index()
    {
        $benefits = Benefit::all()->map(function ($benefit) {
            return [
                'id_programa' => $benefit->id,
                'tramite' => $benefit->proccess,
                'min' => $benefit->min_amount,
                'max' => $benefit->max_amount,
                'ficha_id' => $benefit->document->id,
            ];
        })->sortByDesc('id_programa');

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => $benefits,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/beneficios-validos",
     *     summary="Obtener beneficios válidos",
     *     tags={"Beneficios"},
     *     @OA\Response(
     *         response=200,
     *         description="Beneficios válidos",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="year", type="string", description="Año de los beneficios"),
     *                 @OA\Property(property="num", type="integer", description="Número de beneficios válidos"),
     *                 @OA\Property(property="beneficios", type="array", description="Lista de beneficios válidos", @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id_programa", type="integer", description="ID del programa"),
     *                     @OA\Property(property="monto", type="integer", description="Monto del beneficio"),
     *                     @OA\Property(property="fecha_recepcion", type="string", format="date", description="Fecha de recepción del beneficio"),
     *                     @OA\Property(property="fecha", type="string", format="date", description="Fecha del beneficio"),
     *                     @OA\Property(property="ano", type="string", description="Año del beneficio"),
     *                     @OA\Property(property="view", type="boolean", description="Vista del beneficio"),
     *                     @OA\Property(property="ficha", type="object", description="Ficha del beneficio", 
     *                         @OA\Property(property="id", type="integer", description="ID de la ficha"),
     *                         @OA\Property(property="nombre", type="string", description="Nombre de la ficha"),
     *                         @OA\Property(property="id_programa", type="integer", description="ID del programa de la ficha"),
     *                         @OA\Property(property="url", type="string", description="URL de la ficha"),
     *                         @OA\Property(property="categoria", type="string", description="Categoría de la ficha"),
     *                         @OA\Property(property="descripcion", type="string", description="Descripción de la ficha"),
     *                     ),
     *                 )),
     *             ),
     *         ),
     *     ),
     * )
     */
    public function validBenefits()
    {
        $benefitsAssigned = BenefitUser::all()->map(function ($benefit) {
            $min = $benefit->benefit->min_amount;
            $max = $benefit->benefit->max_amount;
            $amount = $benefit->amount;

            if ($amount >= $min && $amount <= $max) {
                return [
                    'id_programa' => $benefit->benefit->id,
                    'monto' => $benefit->amount,
                    'fecha_recepcion' => $benefit->created_at->format('d/m/Y'),
                    'fecha' => $benefit->created_at->format('Y-m-d'),
                    'ano' => $benefit->created_at->format('Y'),
                    'view' => true,
                    'ficha' => $benefit->benefit->document->select(
                        'id',
                        'name as nombre',
                        'benefit_id as id_programa',
                        'url',
                        'category as categoria',
                        'description as descripcion',
                    )->where('benefit_id', $benefit->benefit->id)->first(),
                ];
            }
        })->filter(function ($benefit) {
            return $benefit !== null;
        });

        $byYear = $benefitsAssigned->groupBy('ano')->map(function ($benefit) {
            return [
                'year' => $benefit->first()['ano'],
                'num' => $benefit->count(),
                'beneficios' => $benefit,
            ];
        })->sortByDesc('year')->values();

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => $byYear,
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
    public function store(StoreBenefitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Benefit $benefit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Benefit $benefit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBenefitRequest $request, Benefit $benefit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Benefit $benefit)
    {
        //
    }
}
