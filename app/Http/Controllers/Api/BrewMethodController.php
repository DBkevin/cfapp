<?php

namespace App\Http\Controllers\Api;

use App\Models\BrewMethod;
use Illuminate\Http\Request;
use App\Http\Requests\Api\BrewMethodsRequest;
use App\Http\Resources\BrewMethodsResource;

class BrewMethodController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrewMethodsRequest $request)
    {
        $method = new BrewMethod();
        $method->method = $request->method;
        $method->save();

        return new BrewMethodsResource($method);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Api\BrewMethod  $brewMethod
     * @return \Illuminate\Http\Response
     */
    public function update(BrewMethodsRequest $request, BrewMethod $method)
    {
        //
        $method = BrewMethod::where('id', $method->id)->first();
        $method->method = $request->method;
        $method->update();

        return new BrewMethodsResource($method);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Api\BrewMethod  $brewMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrewMethod $brewMethod)
    {
        //
    }
}
