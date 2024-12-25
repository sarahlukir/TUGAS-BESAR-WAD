<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JobVacancyController extends Controller
{
    public function dashboard()
    {
        $jobs = JobVacancy::with('company')->get();

        return view('dashboard', compact('jobs'));
    }
}
