<?php

namespace App\Http\Controllers;

use App\Models\DriverCar;
use App\Services\Interfaces\DriverCarServiceInterface;
use Illuminate\Http\Request;

class DriverCarController extends Controller
{

    private $driverCarService;

    public function __construct(DriverCarServiceInterface $driverCarService)
    {
        $this->driverCarService = $driverCarService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('driver.driver-car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $this->driverCarService->create($request->modelOfCar,$request->max_weight,
                                    $request->internal_length,$request->internal_height,$request->internal_width,
                                    $request->max_capacity,$request->photo,$request->carType);


        return redirect()->route('users.show',['user'=>auth()->user()->id])->with([
            'status' => 'Транспорт добавлен!',
            'alert' => 'success',]);
    }

    /**
     *
     * Display the specified resource.
     *
     * @param  \App\Models\DriverCar  $driverCar
     * @return \Illuminate\Http\Response
     */
    public function show(DriverCar $driverCar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DriverCar  $driverCar
     * @return \Illuminate\Http\Response
     */
    public function edit(DriverCar $driverCar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DriverCar  $driverCar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DriverCar $driverCar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DriverCar  $driverCar
     * @return \Illuminate\Http\Response
     */
    public function destroy(DriverCar $driverCar)
    {
        //
    }
}
