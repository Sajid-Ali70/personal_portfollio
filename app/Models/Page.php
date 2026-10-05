<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "pages";

    protected $fillable = [
        "title",
        "slug",
        "content",
        "status",
        'meta_title',        // Make sure these are included
        'meta_description',  // Make sure these are included
        'meta_keywords',  
    ];

    protected $casts = [
        "status" => "boolean",
    ];
}
