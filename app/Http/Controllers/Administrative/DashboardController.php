<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ProductLog;
use App\Models\University;
use App\Models\User;
use App\OrderTransection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        $totalStudent = User::role('student')->count();
        $totalApplication = Application::count();
        $totalUniversity = University::count();
        $response = [
            'totalStudent' => $totalStudent,
            'totalApplication' => $totalApplication,
            'totalUniversity' => $totalUniversity,
        ];
        return view('administrative.dashboard',$response);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('/');
    }

}
