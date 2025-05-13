<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'image',
        'is_active',
    ];

    protected $dates = ['deleted_at'];

    public function getImageAttribute($value)
    {
        if($value){
            return asset($value);
        }
        return $value;
    }
}
