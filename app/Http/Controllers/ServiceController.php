<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Helpers\DateConverter;
use App\Models\Patient;
use App\Models\ServiceCategory;
use App\Models\User;

class ServiceController extends Controller
{
    public function index()
    {
        //Eager loading in Controller but have to bliding relationship in Model before.
        // $ideas = Idea::with('user','comments.user')->orderBy('created_at', 'DESC');
        $services = Service::orderBy('service_date', 'DESC');
        $service_count = Service::all()->count();

        //where content like %test%
        if (request()->has('search')) {
            $searchTerm = request()->get('search', '');
    
            $services->whereHas('patient', function ($query) use ($searchTerm) {
                $query->where('full_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('phone_number', 'like', '%' . $searchTerm . '%')
                    ->orWhere('personal_id_number', 'like', '%' . $searchTerm . '%');
            });
        }

        return view('services.index', [
            'services' => $services->paginate(15),
            'service_count' => $service_count,
        ]);
    }
    public function form($id,Patient $patient)
    {
        if($id != 0) {
            $patient = Patient::find($id);
        }
        
        $serviceCats = ServiceCategory::all();
        $users = User::where('role', 'User')->get();

        return view('services.add',[
            'serviceCats' => $serviceCats,
            'patient' => $patient,
            'users' => $users,
        ]);
    }

    public function store(Request $request, Service $service,Patient $patient)
    {
        $patient_id = $request->input('patient_id');
        $data = [
            'patient_id' => $patient_id,
            'category_id' => $request->input('category_id'),
            'user_id' => $request->input('user_id'),
            'service_number' => $request->input('service_number'),
            'service_detail' => $request->input('service_detail'),
            'service_date' => DateConverter::thToEngDate($request->input('service_date')),
        ];

        $service = Service::create($data);

        return redirect()->route('patients.show',$patient_id)->with('success', 'เพิ่มคำขอบริการของ ผู้พิการ เรียบร้อยแล้ว!');
    }

    public function edit(Service $service)
    {
        // if (auth()->id() !== $patient->user_id) {
        //     abort(404);
        // }

      
        $serviceCats = ServiceCategory::all();
        $users = User::where('role', 'User')->get();

        return view('services.edit', [
            'service' => $service,
            'serviceCats' => $serviceCats,
            'users' => $users,
        ]);
    }

    public function update(Request $request, Service $service)
    {
        // if (auth()->id() !== $patient->user_id) {
        //     abort(404);
        // }

        $data = [
            'category_id' => $request->input('category_id'),
            'user_id' => $request->input('user_id'),
            'service_number' => $request->input('service_number'),
            'service_detail' => $request->input('service_detail'),
            'service_date' => DateConverter::thToEngDate($request->input('service_date')),
        ];

        

        // $patient->content = request()->get('content','');
        // $patient->save();

        $service->update($data);

        return redirect()->route('services.edit', $service->id)->with('success', 'อัพเดทข้อมูลบริการ เรียบร้อยแล้ว!');
    }
}
