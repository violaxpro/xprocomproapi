<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ['section', 'maps'];
    protected $guarded = [];

    public function image() {
        return $this->hasMany(\App\Models\PageImage::class, 'id', 'model_id');
    }

    public function section() {
        return $this->hasMany(PageSection::class, 'id', 'model_id');
    }

    public function maps() {
        return $this->hasMany(PageMap::class, 'id', 'model_id');
    }
}
