<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];


     protected $fillable = [
        'title',
        'institution_name',
        'passing_year',
        'grade',
        'certificate',
    ];

    protected $dates = ['deleted_at'];

    public function getCertificateAttribute($value)
    {
        if ($value) {
            return asset('storage/'.$value) ;
        }else{
            return $value;
        }
    }
}
