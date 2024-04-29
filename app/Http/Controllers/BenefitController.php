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
     * Display a listing of the resource.
     */
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
            'status' => true,
            'data' => $benefits,
        ]);
    }

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
