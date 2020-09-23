<?php

namespace App\Http\Controllers\Api;

use App\Models\Cafe;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CafeRequest;
use App\Http\Resources\CafeResource;
use App\Handlers\GaodeMapsHandler;

class CafeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cafes = Cafe::all();
        return new CafeResource($cafes);
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
    public function store(CafeRequest $request)
    {
        //
        $cafe = new Cafe();
        $cafe->name = $request->name;
        $cafe->address = $request->address;
        $cafe->city = $request->city;
        $cafe->state = $request->state;
        $cafe->tel = $request->tel;
        $cafe->description = $request->description ? $request->description : '';
        $cafe->companies_id = $request->companies_id;
        $coordinates = GaodeMapsHandler::geocodeAddress($cafe->address, $cafe->city, $cafe->state);
        $cafe->latitude = $coordinates['lat'];
        $cafe->longitude = $coordinates['lng'];
        $methods = $request->methods;
        $cafe->save();
        $cafe->methods()->attach($methods);
        return new CafeResource($cafe);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cafe  $cafe
     * @return \Illuminate\Http\Response
     */
    public function show(Cafe $cafe)
    {
        $cafe = Cafe::where('id', $cafe->id)->with('methods')->first();
        $MethodsName = [];
        foreach ($cafe->methods as $method) {
            $temp['id'] = $method['id'];
            $temp['method'] = $method['method'];
            array_push($MethodsName, $temp);
            $temp = null;
        }
        $cafe->MethodsNmae = $MethodsName;
        return new CafeResource($cafe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cafe  $cafe
     * @return \Illuminate\Http\Response
     */
    public function edit(Cafe $cafe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cafe  $cafe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cafe $cafe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cafe  $cafe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cafe $cafe)
    {
        //
    }
}
