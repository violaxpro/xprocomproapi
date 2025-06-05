<?php

namespace App\Models;

use App\Http\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory, SoftDeletes, ModelHelper;

    protected $guarded = [];
    public $searchable = ['title', 'description', 'short_description', 'author'];
    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
           $model->slug = Str::slug($model->title);

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
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }
}
