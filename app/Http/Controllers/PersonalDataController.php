<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PersonalDataController extends Controller
{
    public function index()
    {
        $data = PersonalData::where('user_id', Auth::id())->get();
        return view('personal_data.index', compact('data'));
    }
}
