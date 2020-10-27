<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ModelsCountryModel;
use Validator;

class CountryCountryController extends Controller
{
    public function country(){
        return response() -> json(ModelsCountryModel::get(),200);
    }

    public function countryByID($id){
        $country = ModelsCountryModel::find($id);
        if(is_null($country)){
            return response() -> json(['message'=>'Record not found!'],404);
        }
        return response() -> json(ModelsCountryModel::find($id),200);
    }

    public function countrySave(Request $request){
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

    public function countryUpdate(Request $request, $id){
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

    public function countryDelete(Request $request, $id){
        $country = ModelsCountryModel::find($id);
        if(is_null($country)){
            return response() -> json(['message'=>'Record not found!'],404);
        }
        $country -> delete();
        return response() -> json('Record deleted!', 204);
    }

}
