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
        $images = $request->images;
        $cafe->images()->attach($images);
        $tags = $request->tags ?? false;
        if ($tags) {
            $cafe->tags()->attach($tags);
        }
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
        $cafe = Cafe::where('id', $cafe->id)->with(['methods', 'images', 'tags'])->first();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cafe  $cafe
     * @return \Illuminate\Http\Response
     */
    public function update(CafeRequest $request, Cafe $cafe)
    {
        $cafe = Cafe::where('id', $cafe->id)->first();
        $cafe->images()->sync($request->images);
        $cafe->methods()->sync($request->methods);
        $cafe->tags()->sync($request->tags);
        $up = [];
        $up['description'] = $request->description ?? false;
        $up['name'] = $request->name ?? false;
        $up['address'] = $request->address ?? false;
        $up['city'] = $request->city ?? false;
        $up['state'] = $request->state ?? false;
        foreach ($up as $k => $v) {
            if ($k) {
                $cafe->$k = $v;
            }
        }
        $cafe->update();
        return new CafeResource($cafe);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cafe  $cafe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cafe $cafe)
    {
    }
}
