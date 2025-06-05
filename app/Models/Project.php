<?php

namespace App\Models;

use App\Http\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory, SoftDeletes, ModelHelper;

    protected $guarded = [];
    public $searchable = ['name', 'company', 'short_description'];
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

    public function detail() {
        return $this->hasOne(ProjectDetail::class);
    }

    public function images() {
        return $this->hasMany(ProjectImage::class);
    }
}
