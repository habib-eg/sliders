<?php

namespace Habib\Slider\Models;

use Habib\Dashboard\Traits\HasActivity;
use Habib\Dashboard\Traits\HasUser;
use Habib\Dashboard\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model{
    use UuidTrait,HasUser,HasActivity;
    /**
     * @var array
     */
    protected $casts=[
        "sortable"=>"integer",
        "title"=>"string",
        "content"=>"string",
        "active"=>"boolean"
    ];
    /**
     * @var array
     */
    protected $fillable=[
        "title",
        "content",
        "image",
        "linkable_id",
        "linkable_type",
        "sortable",
        "active"
    ];
    protected $appends=['image_path'];

    public function getImagePathAttribute(){
        return url($this->image??'');
    }

    public function linkable()
    {
        return $this->morphTo();
    }

}
