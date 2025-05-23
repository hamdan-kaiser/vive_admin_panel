<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

     protected $fillable = [
        'type',
        'description',
    ];

    protected $casts = [
        'type' => 'string',
    ];

    protected $dates = [
        'deleted_at',
    ];
}
