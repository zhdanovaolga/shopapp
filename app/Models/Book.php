<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Book extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = "books";

    protected $fillable = [
        "title",
        "description",
        "image",
        "price",
        "rented",
        "purchased",
        "category_id",
        'rented_date',
        "current_user_id",
        "publish_year",
    ];

    
    public $sortable = [
        "title",
        "description",
        "image",
        "price",
        "rented",
        "purchased",
        "category_id",
        'rented_date',
        "current_user_id",
        "publish_year",
    ];
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function current_user() {
        return $this->belongsTo(User::class, 'current_user_id');
    }
    
    public function scopeAvailable($builder) {
        return $builder
            ->where('rented', '=', false)
            ->where('purchased', '=', false);
    }

    public function scopeExpiredRent($builder) {
        return $builder
            ->where('rented', '=', true)
            ->where('rented_date', '<=', now());
    }
}