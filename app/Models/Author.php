<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Author extends Model
{
    use HasFactory;
    use Sortable;
    
    protected $table = "authors";

    protected $fillable = [
        "name",
        "surname",
        "patronymic",
        "date_of_birth",
    ];

    public $sortable = [
        "name",
        "surname",
        "patronymic",
        "date_of_birth",
    ];

}
