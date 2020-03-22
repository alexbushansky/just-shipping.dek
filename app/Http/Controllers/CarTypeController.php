<?php

namespace App\Http\Controllers;

use App\Models\CarType;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $carTypes = CarType::paginate(10);
        return view('admin.car-types.index',[
            'carTypes'=>$carTypes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param CarType $carType
     * @return \Illuminate\Http\Response
     */
    public function show(CarType $carType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarType $carType
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(CarType $carType)
    {
        $this->authorize('update', $carType);


        return view('admin.car-types.edit',['carType'=>$carType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param CarType $carType
     * @return Response
     * @throws AuthorizationException
     */
    public function update(Request $request, CarType $carType)
    {
        return $this->authorize('update', $carType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CarType $carType
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(CarType $carType)
    {



        $this->authorize('delete', $carType);

        $carType->delete();

        return redirect()->route('car-types.index')->with([
            'status'=>'Тип транспорта удален успешно',
            'alert'  => 'success',
            ]);
    }

    /**
     * @return JsonResponse
     */
    public function getAllCarType(): JsonResponse
    {
        $carTypes = CarType::all();
        return response()->json([
            'carTypes' => $carTypes,
        ]);
    }

}
