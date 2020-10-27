<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ModelsCountryModel;
use Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response() -> json(ModelsCountryModel::get(),200);
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
        $rules =[
            'name' => 'required|min:3',
            'iso'=> 'required|min:2|max:5|unique:_z_country'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response() -> json($validator->errors(),400);
        }

        $country = ModelsCountryModel::create($request->all());
        return response() -> json($country,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = ModelsCountryModel::find($id);
        if(is_null($country)){
            return response() -> json(['message'=>'Record not found!'],404);
        }
        return response() -> json(ModelsCountryModel::find($id),200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $country = ModelsCountryModel::find($id);
        if(is_null($country)){
            return response() -> json(['message'=>'Record not found!'],404);
        }

        $rules =[
            'name' => 'required|min:3',
            'iso'=> 'required|min:2|max:5|unique:_z_country'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response() -> json($validator->errors(),400);
        }
        $country -> update($request->all());
        return response() -> json($country,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = ModelsCountryModel::find($id);
        if(is_null($country)){
            return response() -> json(['message'=>'Record not found!'],404);
        }
        $country -> delete();
        return response() -> json('Record deleted!', 204);
    }
}