<?php

namespace App\Models\Website;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;


class Slider extends Model
{

    use HasFactory,HasTranslations;
    public $translatable  = ['heading', 'sub_heading', 'btn_txt','btn_txt1'];

    protected $fillable = [
        'post_id',
        'heading',
        'sub_heading',
        'btn_txt',
        'btn_txt1',
        'btn_link',
        'btn_link1',
        'slider_image',
    ];

    public function Slider()
    {

            return $this->belongsTo(Post::class, 'post_id', 'id');


    }


    public function setSliderHeadingAttribute($value)
    {
        $this->attributes['heading'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function setSliderSubheadAttribute($value)
    {
        $this->attributes['sub_heading'] = json_encode($value, JSON_UNESCAPED_UNICODE);

    }
    public function setSliderBtn1Attribute($value)
    {
        $this->attributes['btn_txt'] = json_encode($value, JSON_UNESCAPED_UNICODE);

    }
    public function setSliderBtn2Attribute($value)
    {
        $this->attributes['btn_txt1'] = json_encode($value, JSON_UNESCAPED_UNICODE);

    }

    public function post()
    {
        return $this->hasMany(Slider::class,'post_id','id');
    }

}

