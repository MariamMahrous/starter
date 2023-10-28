<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CrudController extends Controller
{
    //
    public  function getoffers(){
        return Offer::get();
    }
    // public  function store(){
    //     Offer::create([
    //         'name'=>'offer2',
    //         'price'=>'23',
    //         'details'=>'offer details'
    //     ]);
    // }

public function create(){
    return view('offers.create');
}
public function store(Request $request){
    $rules=$this->getrules();
    $messages=$this->getmessages();
    $validator=Validator::make($request->all(),$rules,$messages);
    if($validator->fails()){
    return redirect()->back()->withErrors($validator)->withInputes($request->all);
    }

   Offer::create([
    'name'=>$request->name,
    'price'=>$request->price,
    'details'=> $request->details
   ]);
   return redirect()->back()->with(['success'=>"تمت الاضافة بنجاح"]);
}
private function getrules(){
    return $rules=[
        'name'=>'required|max:100|unique:offers,name',
        'price'=>'required|numeric',
        'details'=>'required'
    ];
}
private function getmessages(){
    return $messages=[
        'name.required'=>"حقل الاسم مطلوب",
        'name.unique'=>"لايجب ان يكون الاسم مكرر",
        'price.required'=>"حقل السعر مطلوب",
        'price.numeric'=>"يجب ان يكون السعر ارقام",
        'details.required'=>"حقل التفاصيل مطلوب"
    ];
}

}
