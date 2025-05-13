<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professional extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'company_name',
        'from',
        'to',
        'location',
        'experience_letter',
    ];

    protected $dates = ['from', 'to', 'deleted_at'];

    public function getExperienceLetterAttribute($value)
    {
        if ($value) {
            return asset('storage/'.$value) ;
        }else{
            return $value;
        }
    }
}
