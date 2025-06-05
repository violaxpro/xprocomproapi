<?php

namespace App\Models;

use App\Http\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes, ModelHelper;

    protected $guarded = [];
    public $searchable = ['name'];
    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
           $model->slug = Str::slug($model->name);

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

    public function scopeToSelectArray($query) {
        return $query->map(function ($value) {
            return [
                'value' => $value->id,
                'label' => $value->name,
            ];
        });
    }

    public function blog() {
        return $this->hasMany(Blog::class);
    }
}
