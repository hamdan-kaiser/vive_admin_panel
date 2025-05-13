<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'location_id',
        'tution_fee',
        'session',
        'scholarship',
    ];

    /**
     * The attributes that should be mutated to dates for soft deletes.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function location (){
        return $this->belongsTo(Location::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
