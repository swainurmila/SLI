<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{
    use HasFactory, HasTranslations;

    public $translatable  = ['title', 'name'];
    protected $fillable = ['title', 'name', 'slug', 'type', 'target', 'menu_id', 'created_at', 'updated_at'];




    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function setPostNameAttribute($value)
    {
        $this->attributes['name'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public static function updateSingleTranslation($value)
    {
        // Retrieve the model instance
        //$model = $this;

        // Update the specific attribute for a specific locale
        //$model->translate($locale)->$attributeName = json_encode($value, JSON_UNESCAPED_UNICODE);
        //$model->setTranslation($attributeName, $locale, json_encode($value, JSON_UNESCAPED_UNICODE));

        // Save the model instance
        //$model->save();
        $this->attributes['name'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public static function allData($menuitems)
    {
        //return $menuitems;
        //$menuitems = $menuitems;
        //return $mm = MenuItem::testFun();
        foreach ($menuitems as $key => $parent) {
            // return $MenuItem = MenuItem::find($parent->id);
            // return $MenuItem = $MenuItem->title;
            $menuitem = MenuItem::find($parent->id);
            // return $menuitem->getTranslations('title');
            $parent->title = $menuitem->getTranslations('title');
            // $parent->title->['or'] = $menuitem->getTranslation('title','or');
            $parent->name = $menuitem->getTranslations('name');
            $parent->slug = $menuitem->slug;
            $parent->type = $menuitem->type;
            $parent->target = $menuitem->target;
            //dd($parent->children[0]);
            //return $parent->children[0];
            if (!empty($parent->children[0])) {
                foreach ($parent->children[0] as $key2 => $child) {
                    $menuitem = MenuItem::find($child->id);
                    $child->title = $menuitem->getTranslations('title');
                    //$child->dds22 = 'qwerty';
                    $child->name = $menuitem->getTranslations('name');
                    $child->slug = MenuItem::where('id', $child->id)->value('slug');
                    $child->type = MenuItem::where('id', $child->id)->value('type');
                    $child->target = MenuItem::where('id', $child->id)->value('target');

                    if (!empty($child->children[0])) {
                        foreach ($child->children[0] as $key3 => $grandchild) {
                            $menuitem = MenuItem::find($grandchild->id);
                            $grandchild->title = $menuitem->getTranslations('title');
                            //$grandchild->dds = 'qwerty';
                            $grandchild->name = $menuitem->getTranslations('name');
                            $grandchild->slug = MenuItem::where('id', $grandchild->id)->value('slug');
                            $grandchild->type = MenuItem::where('id', $grandchild->id)->value('type');
                            $grandchild->target = MenuItem::where('id', $grandchild->id)->value('target');
                        }
                    }
                }
            }
        }

        return $menuitems;
    }
}
