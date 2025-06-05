<?php

namespace App\Models;

use App\Http\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes, ModelHelper;

    protected $guarded = [];
    public $searchable = ['name', 'website'];

    public function categoryPages()
    {
        return $this->belongsToMany(CategoryPage::class, 'category_page_brand');
    }
}
