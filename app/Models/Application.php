<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'course_type',
        'subject_id',
        'university_id',
        'surname',
        'given_name',
        'email',
        'date_of_birth',
        'address',
        'passport_no',
        'expiry_date',
        'ielts_score',
        'passport_file',
    ];

    protected $dates = [
        'deleted_at',
        'expiry_date',
    ];

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
