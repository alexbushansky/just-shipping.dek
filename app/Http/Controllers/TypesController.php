<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class TypesController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function getTypes(): JsonResponse
    {
        $types = DB::table('types')->get();

        return response()->json([
            'types' => $types,
        ]);
    }



}
