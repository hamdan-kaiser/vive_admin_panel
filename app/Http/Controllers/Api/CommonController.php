<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\NewsDataCollection;
use App\Models\Application;
use App\Models\Article;
use App\Models\News;
use App\Models\PassportProfile;
use App\Models\Subject;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class CommonController extends Controller
{

    public function subjectList(){
        $data = Subject::all();
        $payload = [
            'code'         => 200,
            'data' => $data,
            'app_message'  => 'Successfully',
            'user_message' => 'Successfully'
        ];
        return response()->json($payload, 200);
    }
    public function getApplications(){
        $data = Application::with('university.location','subject')
            ->where('user_id',Auth::user()->id)->get();
        $payload = [
            'code'         => 200,
            'data' => $data,
            'app_message'  => 'Successfully',
            'user_message' => 'Successfully'
        ];
        return response()->json($payload, 200);
    }
    public function getProfile(){
        $data = User::with('passportProfile','educationProfile','professionalProfile','otherProfile','passportProfile','basicProfile')
            ->where('id',Auth::user()->id)->get();
        $payload = [
            'code'         => 200,
            'data' => $data,
            'app_message'  => 'Successfully',
            'user_message' => 'Successfully'
        ];
        return response()->json($payload, 200);
    }
    public function universityList(){
        $data = University::with('location')->get();
        $payload = [
            'code'         => 200,
            'data' => $data,
            'app_message'  => 'Successfully',
            'user_message' => 'Successfully'
        ];
        return response()->json($payload, 200);
    }
    public function getUniversity($subject_id){ 
        $data = University::with('location')->whereHas('subjects', function($query) use ($subject_id) {
            $query->where('subject_id', $subject_id);
        })->get();
     
        // $data = University::where('id',$id)->with('location')->first();
        $payload = [
            'code'         => 200,
            'data' => $data,
            'app_message'  => 'Successfully',
            'user_message' => 'Successfully'
        ];
        return response()->json($payload, 200);
    }
    public function getArticle($type){
        $data = Article::where('type',$type)->first();
        $payload = [
            'code'         => 200,
            'data' => $data,
            'app_message'  => 'Successfully',
            'user_message' => 'Successfully'
        ];
        return response()->json($payload, 200);
    }
    public function getNewses(){
        $data = News::where('is_active',1)->orderBy('id','DESC')->get();
        $payload = [
            'code'         => 200,
            'data' => NewsDataCollection::collection($data),
            'app_message'  => 'Successfully',
            'user_message' => 'Successfully'
        ];
        return response()->json($payload, 200);
    }
    public function profileUpdate(Request $request,$type){
        if($type == 'basic'){
            $validator = Validator::make($request->all(), [
                'date_of_birth' => 'required',
                'ielts_score' => 'required',
                'address' => 'required'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'given_name' => 'required',
                'surname' => 'required',
                'passport_no' => 'required',
                'date_of_birth' => 'required',
                'ielts_score' => 'required',
                'address' => 'required',
                'passport_expire' => 'required',
                'passport_image' => 'required',
            ]);
        }

        if($validator->fails()){
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
                'status' => false
            ], 422);
        }
        $contentFile = '';
        if($type == 'passport'){
                $makeUniqueName = 'passport_' . time() . '-' . uniqid();
                if ($request->hasFile('passport_image')) {
                    $file_name = $makeUniqueName . '.' . $request->file('passport_image')->getClientOriginalExtension();
                    //Store local storage
                    $request->passport_image->storeAs('public/passport', $file_name);
                    $contentFile = 'passport/' . $file_name;
                }
            $insert = DB::table('passport_profiles')
                ->updateOrInsert(
                    ['user_id' => $request->user()->id],
                    [
                        'given_name' => $request->given_name,
                        'surname' => $request->surname,
                        'passport_no' => $request->passport_no,
                        'date_of_birth' => $request->date_of_birth,
                        'ielts_score' => $request->ielts_score,
                        'address' => $request->address,
                        'passport_expire' => $request->passport_expire,
                        'passport_image' => $contentFile
                    ]
                );
            if($insert){
                if($request->has('email')){
                    $user = Auth::user();
                    $user->email = $request->email;
                    $user->save();
                
                }
                $payload = [
                    'code'         => 200,
                    'app_message'  => 'Successfully',
                    'user_message' => 'Successfully'
                ];
                return response()->json($payload, 200);
            }else{
                $payload = [
                    'code'         => 200,
                    'app_message'  => 'Successfully',
                    'user_message' => 'Successfully'
                ];
                return response()->json($payload, 200);
            }
        }else{

            $insert = DB::table('basic_profiles')
                ->updateOrInsert(
                    ['user_id' => $request->user()->id],
                    [
                        'date_of_birth' => $request->date_of_birth,
                        'ielts_score' => $request->ielts_score,
                        'address' => $request->address
                    ]
                );
            $payload = [
                'code'         => 200,
                'app_message'  => 'Successfully',
                'user_message' => 'Successfully'
            ];
            return response()->json($payload, 200);
        }

    }
    public function applicationSubmit(Request $request){

        $validator = Validator::make($request->all(), [
            'course_type' => 'required',
            'subject_id' => 'required',
            'university_id' => 'required'
        ]);

        if($validator->fails()){
            return response(
                [
                    'message' => 'Validation errors',
                    'errors' =>  $validator->errors(),
                    'status' => false
                ], 422);
        }
        $makeUniqueName = 'passport_' . time() . '-' . uniqid();
        if ($request->hasFile('passport_image')) {
            $file_name = $makeUniqueName . '.' . $request->file('passport_image')->getClientOriginalExtension();
            //Store local storage
            $request->passport_image->storeAs('public/passport', $file_name);
            $contentFile = 'passport/' . $file_name;
        }
        $findUserPassportProfile = PassportProfile::where('user_id',$request->user()->id)->first();
        if($findUserPassportProfile){
            $insert = DB::table('applications')
                ->insert(
                    [
                        'user_id' => $request->user()->id,
                        'given_name' => $findUserPassportProfile->given_name,
                        'email' => $request->user()->email,
                        'surname' => $findUserPassportProfile->surname,
                        'passport_no' => $findUserPassportProfile->passport_no,
                        'date_of_birth' => $findUserPassportProfile->date_of_birth,
                        'ielts_score' => $findUserPassportProfile->ielts_score,
                        'address' => $findUserPassportProfile->address,
                        'passport_expire' => $findUserPassportProfile->passport_expire,
                        'passport_image' => $findUserPassportProfile->passport_image,
                        'subject_id' => $request->subject_id,
                        'course_type' => $request->course_type,
                        'university_id' => $request->university_id,
                    ]
                );

            if($insert){
                $payload = [
                    'code'         => 200,
                    'app_message'  => 'Successfully',
                    'user_message' => 'Successfully'
                ];
                return response()->json($payload, 200);
            }else{
                $payload = [
                    'code'         => 500,
                    'app_message'  => 'Unsuccessful',
                    'user_message' => 'Unsuccessful'
                ];
                return response()->json($payload, 200);
            }
        }else{
            $payload = [
                'code'         => 500,
                'app_message'  => 'Unsuccessful',
                'user_message' => 'Unsuccessful'
            ];
            return response()->json($payload, 200);
        }

    }
    public function profileImageUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'profile_image' => 'required'
        ]);
        if($validator->fails()){
            return response(
                [
                    'message' => 'Validation errors',
                    'errors' =>  $validator->errors(),
                    'status' => false
                ], 422);
        }

        $makeUniqueName = 'profile_' . time() . '-' . uniqid();
        if ($request->hasFile('profile_image')) {
            $file_name = $makeUniqueName . '.' . $request->file('profile_image')->getClientOriginalExtension();
         
            //Store local storage
            $request->profile_image->storeAs('public/profile', $file_name);
         
            $contentFile = 'profile/' . $file_name;
        }
        $find = User::where('id', $request->user()->id)->first();
       

        if($find){
            $find->image = $contentFile;
            $find->save();
            // dump($find);
        
            $payload = [
                'code'         => 200,
                'app_message'  => 'Successfully',
                'user_message' => 'Successfully'
            ];
            return response()->json($payload, 200);
        }else{
            $payload = [
                'code'         => 500,
                'app_message'  => 'Unsuccessful',
                'user_message' => 'Unsuccessful'
            ];
            return response()->json($payload, 200);
        }


    }
    public function educationSubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'institution_name' => 'required',
            'passing_year' => 'required',
            'grade' => 'required',
            'certificate' => 'required',
        ]);
        if($validator->fails()){
            return response(
                [
                    'message' => 'Validation errors',
                    'errors' =>  $validator->errors(),
                    'status' => false
                ], 422);
        }

        $makeUniqueName = 'certificate_' . time() . '-' . uniqid();
        if ($request->hasFile('certificate')) {
            $file_name = $makeUniqueName . '.' . $request->file('certificate')->getClientOriginalExtension();
            //Store local storage
            $request->certificate->storeAs('public/certificate', $file_name);
            $contentFile = 'certificate/' . $file_name;
        }
        $insert = DB::table('education')
            ->insert(
                [
                    'user_id' => $request->user()->id,
                    'title' => $request->title,
                    'institution_name' => $request->institution_name,
                    'passing_year' => $request->passing_year,
                    'grade' => $request->grade,
                    'certificate' => $contentFile
                ]
            );
        if($insert){
            $payload = [
                'code'         => 200,
                'app_message'  => 'Successfully',
                'user_message' => 'Successfully'
            ];
            return response()->json($payload, 200);
        }else{
            $payload = [
                'code'         => 500,
                'app_message'  => 'Unsuccessful',
                'user_message' => 'Unsuccessful'
            ];
            return response()->json($payload, 200);
        }
    }
    public function professionalSubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'company_name' => 'required',
            'from' => 'required',
            'location' => 'required',
            'experience_letter' => 'required',
        ]);
        if($validator->fails()){
            return response(
                [
                    'message' => 'Validation errors',
                    'errors' =>  $validator->errors(),
                    'status' => false
                ], 422);
        }

        $makeUniqueName = 'experience_letter_' . time() . '-' . uniqid();
        if ($request->hasFile('experience_letter')) {
            $file_name = $makeUniqueName . '.' . $request->file('experience_letter')->getClientOriginalExtension();
            //Store local storage
            $request->experience_letter->storeAs('public/experience_letter', $file_name);
            $contentFile = 'experience_letter/' . $file_name;
        }
        $insert = DB::table('professionals')
            ->insert(
                [
                    'user_id' => $request->user()->id,
                    'title' => $request->title,
                    'company_name' => $request->company_name,
                    'from' => $request->from,
                    'to' => $request->to,
                    'location' => $request->location,
                    'experience_letter' => $contentFile
                ]
            );
        if($insert){
            $payload = [
                'code'         => 200,
                'app_message'  => 'Successfully',
                'user_message' => 'Successfully'
            ];
            return response()->json($payload, 200);
        }else{
            $payload = [
                'code'         => 500,
                'app_message'  => 'Unsuccessful',
                'user_message' => 'Unsuccessful'
            ];
            return response()->json($payload, 200);
        }
    }
    public function otherSubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'letter' => 'required',

        ]);
        if($validator->fails()){
            return response(
                [
                    'message' => 'Validation errors',
                    'errors' =>  $validator->errors(),
                    'status' => false
                ], 422);
        }

        $makeUniqueName = 'letter_' . time() . '-' . uniqid();
        if ($request->hasFile('letter')) {
            $file_name = $makeUniqueName . '.' . $request->file('letter')->getClientOriginalExtension();
            //Store local storage
            $request->letter->storeAs('public/letter', $file_name);
            $contentFile = 'letter/' . $file_name;
        }
        $insert = DB::table('other_dcouments')
            ->insert(
                [
                    'user_id' => $request->user()->id,
                    'type' => $request->type,
                    'letter' => $contentFile
                ]
            );
        if($insert){
            $payload = [
                'code'         => 200,
                'app_message'  => 'Successfully',
                'user_message' => 'Successfully'
            ];
            return response()->json($payload, 200);
        }else{
            $payload = [
                'code'         => 500,
                'app_message'  => 'Unsuccessful',
                'user_message' => 'Unsuccessful'
            ];
            return response()->json($payload, 200);
        }
    }
}
