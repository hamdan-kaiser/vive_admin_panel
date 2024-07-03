<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function university (){
        return $this->belongsTo(University::class);
    }

    public function location (){
        return $this->belongsTo(Location::class);
    }
    public function subject (){
        return $this->belongsTo(Subject::class);
    }
    public function user (){
        return $this->belongsTo(User::class);
    }
    public function jobStatus (){
        return $this->belongsTo(JobStatus::class);
    }
}
