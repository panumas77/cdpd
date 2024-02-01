<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\DateConverter;

class CaregiverController extends Controller
{

    public function index()
    {
        //Eager loading in Controller but have to bliding relationship in Model before.
        // $ideas = Idea::with('user','comments.user')->orderBy('created_at', 'DESC');
        $caregivers = Caregiver::orderBy('full_name', 'ASC');
        $caregiver_count = Caregiver::all()->count();

        //where content like %test%
        if (request()->has('search')) {

            $caregivers = $caregivers->where('full_name', 'like', '%' . request()->get('search','') . '%')
                                    ->orWhere('phone_number', 'like', '%' . request()->get('search') . '%')
                                    ->orWhere('personal_id_number', 'like', '%' . request()->get('search') . '%');
        }

        return view('caregivers.index', [
            'caregivers' => $caregivers->paginate(15),
            'caregiver_count' => $caregiver_count,
            ]);
    }
    public function show(Caregiver $caregiver)
    {

        $caregivers = $caregiver->orderBy('full_name','ASC');
        // return view('ideas.show', compact('caregiver'));
        return view('caregivers.index',[
            'caregivers' => $caregivers,
        ]);
    }

    public function form()
    {

        return view('caregivers.add');
    }

    public function store(Request $request,Caregiver $caregiver)
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
            'address' => $request->input('address'),
            'district' => $request->input('district'),
            'amphoe' => $request->input('amphoe'),
            'province' => $request->input('province'),
            'zipcode' => $request->input('zipcode'),
            // Assign other form fields to respective columns
        ];


        if($request->has('profile_picture')){
            $imagePath = $request->file('profile_picture')->store('caregivers','public');
            $data['profile_picture'] = $imagePath;

            Storage::disk('public')->delete($caregiver->profile_picture ?? '');
        }

        $caregiver = Caregiver::create($data);

        return redirect()->route('home')->with('success', 'ลงทะเบียนข้อมูล ผู้ดูแลผู้พิการ เรียบร้อยแล้ว!');
    }

    public function edit(Caregiver $caregiver)
    {
        // if (auth()->id() !== $caregiver->user_id) {
        //     abort(404);
        // }

        $dateConverter = new DateConverter(); 

        $editing = true;
        return view('caregivers.edit', compact('caregiver', 'editing','dateConverter'));
    }

    public function update(Request $request,Caregiver $caregiver)
    {
        // if (auth()->id() !== $caregiver->user_id) {
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
            'address' => $request->input('address'),
            'district' => $request->input('district'),
            'amphoe' => $request->input('amphoe'),
            'province' => $request->input('province'),
            'zipcode' => $request->input('zipcode'),
            // Assign other form fields to respective columns
        ];

        if(request()->has('profile_picture')){
            $imagePath = request()->file('profile_picture')->store('caregivers','public');
            $data['profile_picture'] = $imagePath;

            Storage::disk('public')->delete($caregiver->profile_picture ?? '');
        }

        // $caregiver->content = request()->get('content','');
        // $caregiver->save();

        $caregiver->update($data);

        return redirect()->route('caregivers.edit', $caregiver->id)->with('success', 'แก้ไขข้อมูล ผู้ดูแลผู้พิการ เรียบร้อยแล้ว!');
    }


    public function destroy(Caregiver $caregiver)
    {
        //This is to way to check Auth owner or not?
        if (auth()->id() !== $caregiver->user_id) {
            abort(404);
        }
        
        //Original stament 
        // $caregiver = caregiver::where('id',$id)->firstOrFail();
        $caregiver->delete();

        // Caregiver::where('id', $id)->firstOrFail->delete();

        return redirect()->route('dashboard')->with('success', 'Caregiver deleted successfully!');
    }
}
