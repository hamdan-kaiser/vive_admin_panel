<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function location (){
        return $this->belongsTo(Location::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
