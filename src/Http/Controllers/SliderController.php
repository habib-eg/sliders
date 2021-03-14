<?php

namespace Habib\Slider\Http\Controllers;

use Habib\Dashboard\Http\Controllers\CRUDController;
use Habib\Slider\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SliderController extends CRUDController{

    protected $parameters=[
        "edit"=>"slider",
        "index"=>"sliders",
    ];

    protected $view=[
      "index"=>"slider::index",
      "create"=>"slider::create",
      "edit"=>"slider::edit",
    ];

    public function __construct(){
        $this->setModel(Slider::class);
        $this->setParametersValue();

        $this->storeValidation=array_merge([
            "title"=>['required','min:3','max:255'],
            "sortable"=>['required','min:1','numeric'],
            "image"=>['required','image'],
            "content"=>['sometimes'],

        ],request('linkable_id')?[
            "linkable_id"=>['required'],
            "linkable_type"=>['required'],
        ]:[]);

        $this->updateValidation=array_merge([
            "title"=>['sometimes','min:3','max:255'],
            "sortable"=>['sometimes:min:1:numeric'],
            "image"=>['sometimes:image'],
            "content"=>['sometimes'],

        ],request('linkable_id')?[
            "linkable_id"=>['required'],
            "linkable_type"=>['required'],
        ]:[]);

    }

    /**
     * @param array $validated
     * @return array
     */
    public function validation(array $validated=[]){


        if (\request()->hasFile('image')){
            $validated['image']=uploader(\request()->file('image'));
        }

        return $validated;
    }

    public function toggleStatus(Slider $slider){
        $slider->update(['active' => !$slider->active]);
        return ["status"=>$slider->active];
    }

}
