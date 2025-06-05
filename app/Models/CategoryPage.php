<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CategoryPage extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
           $model->slug = request('slug') ?? Str::slug($model->title);

           $latestSlug =
               static::whereRaw("slug = '$model->slug' or slug LIKE '$model->slug-%'")
                   ->latest('id')
                   ->value('slug');
           if ($latestSlug) {
               $pieces = explode('-', $latestSlug);

               $number = intval(end($pieces));

               $model->slug .= '-' . ($number + 1);
           }
       });
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function sections() {
        return $this->hasMany(CategoryPageSection::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'category_page_brand')->orderBy('index', 'ASC');
    }
}
