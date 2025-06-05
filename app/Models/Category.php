<?php

namespace App\Models;

use App\Http\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes, ModelHelper;

    protected $with = ['child'];

    protected $guarded = [];
    public $searchable = ['name'];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
           $model->slug = request('slug') ?? Str::slug($model->name);

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

    public function page() {
        return $this->belongsTo(CategoryPage::class);
    }

    public function parent() {
        return $this->belongsTo($this, 'parent_id');
    }

    public function child() {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
