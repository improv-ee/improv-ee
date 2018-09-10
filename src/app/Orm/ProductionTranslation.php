<?php

namespace App\Orm;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductionTranslation extends Model {

public $timestamps = false;
    protected $fillable = ['title','description','excerpt'];

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = trim($value) ?: null;
    }
    public function setExcerptAttribute($value)
    {
        $this->attributes['excerpt'] = Str::limit(trim($value), 200)?:null;
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = trim($value);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::limit(str_slug($value),50);
    }

}