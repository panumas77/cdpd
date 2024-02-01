<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        

        //where content like %test%
        if ((request()->has('search')) AND  request()->get('search') != '') {
            $patients = Patient::orderBy('full_name', 'ASC');

            $patients = $patients->where('full_name', 'like', '%' . request()->get('search') . '%');
            $patients = $patients->orWhere('phone_number', 'like', '%' . request()->get('search') . '%');
            $patients = $patients->orWhere('personal_id_number', 'like', '%' . request()->get('search') . '%');

            return view('home', ['patients' => $patients->paginate(5)]);
        }

        return view('home');
    }
}
