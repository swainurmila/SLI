<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomArray extends Model
{


    use HasFactory,HasTranslations;
    public $translatable  = ['title', 'name'];
    protected $fillable = ['title','name','slug','type','target','menu_id','created_at','updated_at'];

    protected $dataArray;

    public function __construct(object $data)
    {
        $this->dataArray = $data;
    }

    public function find($id)
    {

        $data =  $this->dataArray;
        return $item = collect($data)->where('id', $id)->first();
    }

    public function allData()
    {
        // return $this->dataArray;
        //return 456;
        return $this->dataArray;
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function setPostNameAttribute($value)
    {
        $this->attributes['name'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    // public function setLocale($locale)
    // {
    //     $this->setTranslation('locale', $locale);
    // }

}
