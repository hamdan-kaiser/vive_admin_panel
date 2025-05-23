<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobStatus extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

     protected $fillable = [
        'title',
    ];

    protected $dates = ['deleted_at'];
}
