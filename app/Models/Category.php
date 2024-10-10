<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    use Sortable;

    protected $table = "categories";

    protected $fillable = [
        "title",
        "description",
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public $sortable = [
        "title",
        "description",
    ];

    public function books() {
        return $this->hasMany(Book::class);
    }
}
