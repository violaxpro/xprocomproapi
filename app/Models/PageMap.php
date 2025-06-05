<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageMap extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function order() {
        return $this->belongsTo(PageOrder::class);
    }
}
