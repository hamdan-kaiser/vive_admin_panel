<?php

namespace App\Imports;

use App\Models\Location;
use App\Models\Subject;
use App\Models\University;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class UniversityImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $location = Location::where('title',$row['location'])->first();

        if($location){
           $result = University::create([
                'title'     => $row['title'],
                'location_id'     => $location->id,
                'tution_fee'     => $row['fee'],
                'session'     => $row['session'],
                'scholarship'     => $row['scholarship'],
                'ielts'     => $row['ielts'],
            ]);

            if($result){
                $subjectArray =  explode(',', $row['subject']);
                foreach ($subjectArray as $subjectArrayItem){
                    $subject = Subject::where('title',$subjectArrayItem)->first();
                    if($subject){
                        $result->subjects()->attach($subject->id);
                    }else{
                        $subjectNew = Subject::create([
                            'title'     => $subjectArrayItem
                        ]);
                        $result->subjects()->attach($subjectNew->id);
                    }
                }
            }
            return $result;
        }
    }
}
