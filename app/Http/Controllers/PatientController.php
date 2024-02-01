<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use App\Models\Patient;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\DateConverter;
use App\Models\User;

class PatientController extends Controller
{

    public function index()
    {
        //Eager loading in Controller but have to bliding relationship in Model before.
        // $ideas = Idea::with('user','comments.user')->orderBy('created_at', 'DESC');
        $patients = Patient::orderBy('full_name', 'ASC');
        $patient_count = Patient::all()->count();

        //where content like %test%
        if (request()->has('search')) {

            $patients = $patients->where('full_name', 'like', '%' . request()->get('search', '') . '%')
                ->orWhere('phone_number', 'like', '%' . request()->get('search') . '%')
                ->orWhere('personal_id_number', 'like', '%' . request()->get('search') . '%');
        }

        return view('patients.index', [
            'patients' => $patients->paginate(15),
            'patient_count' => $patient_count,
        ]);
    }
    public function show(Patient $patient,Service $service)
    {
        $services = Service::where('patient_id', $patient->id)->orderBy('service_date','DESC')->get();
        $serviceCats = ServiceCategory::all();
        $users = User::where('role', 'User')->get();
        // return view('ideas.show', compact('patient'));
        return view('patients.show', [
            'patient' => $patient,
            'services' => $services,
            'serviceCats' => $serviceCats,
            'users' => $users,
        ]);
    }

    public function form()
    {

        return view('patients.add');
    }

    public function store(Request $request, Patient $patient)
    {
        $data = [
            'full_name' => $request->input('full_name'),
            'gender' => $request->input('gender'),
            'birthdate' => DateConverter::thToEngDate($request->input('birthdate')),
            // 'date_of_birth' => date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getVar('date_of_birth')))),
            'personal_id_number' => $request->input('personal_id_number'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'religion' => $request->input('religion'),
            'marriage_status' => $request->input('marriage_status'),
            'number_of_children' => $request->input('number_of_children'),
            'likely' => $request->input('likely_to_disability'),
            'disability_type_1' => $request->input('disability_type_1'),
            'disability_type_2' => $request->input('disability_type_2'),
            'disability_type_3' => $request->input('disability_type_3'),
            'disability_type_4' => $request->input('disability_type_4'),
            'disability_type_5' => $request->input('disability_type_5'),
            'disability_type_6' => $request->input('disability_type_6'),
            'disability_type_7' => $request->input('disability_type_7'),
            'disability_type_8' => $request->input('disability_type_8'),
            'address' => $request->input('address'),
            'district' => $request->input('district'),
            'amphoe' => $request->input('amphoe'),
            'province' => $request->input('province'),
            'zipcode' => $request->input('zipcode'),
            'caregiver_name' => $request->input('caregiver_name'),
            'caregiver_id' => $request->input('caregiver_id'),
            'relationship' => $request->input('relationship'),
            'first_service_date' => DateConverter::thToEngDate($request->input('first_service_date')),
            // Assign other form fields to respective columns
        ];

        if (request()->has('profile_picture')) {
            $imagePath = request()->file('profile_picture')->store('patients', 'public');
            $data['profile_picture'] = $imagePath;

            Storage::disk('public')->delete($patient->profile_picture ?? '');
        }

        $patient = Patient::create($data);

        return redirect()->route('home')->with('success', 'ลงทะเบียนข้อมูล ผู้พิการ เรียบร้อยแล้ว!');
    }

    public function edit(Patient $patient)
    {
        // if (auth()->id() !== $patient->user_id) {
        //     abort(404);
        // }

        $dateConverter = new DateConverter();

        $editing = true;
        return view('patients.edit', compact('patient', 'editing', 'dateConverter'));
    }

    public function update(Request $request, Patient $patient)
    {
        // if (auth()->id() !== $patient->user_id) {
        //     abort(404);
        // }

        $data = [
            'full_name' => $request->input('full_name'),
            'gender' => $request->input('gender'),
            'birthdate' => DateConverter::thToEngDate($request->input('birthdate')),
            // 'date_of_birth' => date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getVar('date_of_birth')))),
            'personal_id_number' => $request->input('personal_id_number'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'religion' => $request->input('religion'),
            'marriage_status' => $request->input('marriage_status'),
            'number_of_children' => $request->input('number_of_children'),
            'likely' => $request->input('likely_to_disability'),
            'disability_type_1' => $request->input('disability_type_1'),
            'disability_type_2' => $request->input('disability_type_2'),
            'disability_type_3' => $request->input('disability_type_3'),
            'disability_type_4' => $request->input('disability_type_4'),
            'disability_type_5' => $request->input('disability_type_5'),
            'disability_type_6' => $request->input('disability_type_6'),
            'disability_type_7' => $request->input('disability_type_7'),
            'disability_type_8' => $request->input('disability_type_8'),
            'address' => $request->input('address'),
            'district' => $request->input('district'),
            'amphoe' => $request->input('amphoe'),
            'province' => $request->input('province'),
            'zipcode' => $request->input('zipcode'),
            'caregiver_name' => $request->input('caregiver_name'),
            'caregiver_id' => $request->input('caregiver_id'),
            'relationship' => $request->input('relationship'),
            'first_service_date' => DateConverter::thToEngDate($request->input('first_service_date')),
            // Assign other form fields to respective columns
        ];

        if (request()->has('profile_picture')) {
            $imagePath = request()->file('profile_picture')->store('patients', 'public');
            $data['profile_picture'] = $imagePath;

            Storage::disk('public')->delete($patient->profile_picture ?? '');
        }

        // $patient->content = request()->get('content','');
        // $patient->save();

        $patient->update($data);

        return redirect()->route('patients.edit', $patient->id)->with('success', 'อัพเดทข้อมูล ผู้พิการ เรียบร้อยแล้ว!');
    }


    public function destroy(Patient $patient)
    {
        //This is to way to check Auth owner or not?
        if (auth()->id() !== $patient->user_id) {
            abort(404);
        }

        //Original stament 
        // $patient = Patient::where('id',$id)->firstOrFail();
        $patient->delete();

        // Patient::where('id', $id)->firstOrFail->delete();

        return redirect()->route('dashboard')->with('success', 'ลบข้อมูล ผู้พิการ เรียบร้อยแล้ว!');
    }

    public function getCaregivers(Request $request, Caregiver $caregiver)
    {
        // Get the user input from the AJAX request
        $query = $request->input('query');

        // Query the database to retrieve caregiver names that match the input
        $caregivers = $caregiver->where('full_name', 'like', '%' . $query . '%')->get();


        // Create a list of matching caregiver names
        // $html = '<ul class="list-group">';

        //     $html .= '<button type="button" class="list-group-item list-group-item-action">'.$query.'</button>';
        //     $html .= '<button type="button" class="list-group-item list-group-item-action">6552</button>';

        // $html .= '</ul>';
        $html = '<ul class="list-group">';
        foreach ($caregivers as $caregiver) {
            $html .= '<button type="button" class="list-group-item list-group-item-action" data-id="' . $caregiver->id . '">' . $caregiver->full_name . '</button>';
        }
        $html .= '</ul>';

        return $html;
    }

    public function getPatients(Request $request, Patient $patient)
    {
        // Get the user input from the AJAX request
        $query = $request->input('query');

        // Query the database to retrieve caregiver names that match the input
        $patients = $patient->where('full_name', 'like', '%' . $query . '%')->get();


        // Create a list of matching caregiver names
        // $html = '<ul class="list-group">';

        //     $html .= '<button type="button" class="list-group-item list-group-item-action">'.$query.'</button>';
        //     $html .= '<button type="button" class="list-group-item list-group-item-action">6552</button>';

        // $html .= '</ul>';
        $html = '<ul class="list-group">';
        foreach ($patients as $patient) {
            $html .= '<button type="button" class="list-group-item list-group-item-action" data-id="' . $patient->id . '">' . $patient->full_name . '</button>';
        }
        $html .= '</ul>';

        return $html;
    }

    public function checkPersonalId(Request $request, Patient $patient)
    {
        $personalId = $request->input('personal_id_number');

        // Query the database to check if the personal ID exists
        $result = $patient->where('personal_id_number', $personalId)->get(); // Replace with your actual model and method

        if (count($result) > 0) {
            echo json_encode(['exists' => true]);
        } else {
            echo json_encode(['exists' => false]);
        }
    }
}
