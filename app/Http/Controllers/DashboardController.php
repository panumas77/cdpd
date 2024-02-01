<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index(Patient $patient)
    {

        $patient_count = Patient::all()->count();
        $disability_type_1_num = $patient->where('disability_type_1', 1)->count();
        $disability_type_2_num = $patient->where('disability_type_2', 1)->count();
        $disability_type_3_num = $patient->where('disability_type_3', 1)->count();
        $disability_type_4_num = $patient->where('disability_type_4', 1)->count();
        $disability_type_5_num = $patient->where('disability_type_5', 1)->count();
        $disability_type_6_num = $patient->where('disability_type_6', 1)->count();
        $disability_type_7_num = $patient->where('disability_type_7', 1)->count();
        $disability_type_8_num = $patient->where('disability_type_8', 1)->count();
        $multi_disability_type_num = $patient->getMutiDisabilityTypeNum();

        $likely_num = $patient->where('likely', 1)->count();


        $patients = $patient->get();




        //---Data Patient Type and Age ranges------------------------------------------------------------------------

        // Age Ranges
        $ageRanges = [
            ['0-5ปี', 0, 5],
            ['6-15ปี', 6, 15],
            ['16-25ปี', 16, 25],
            ['26-59ปี', 26, 59],
            ['มากกว่า 60ปี', 60, 999],
        ];

        // Disability Types
        $disabilityTypes = [
            ['type0', 'likely'],
            ['type1', 'disability_type_1'],
            ['type2', 'disability_type_2'],
            ['type3', 'disability_type_3'],
            ['type4', 'disability_type_4'],
            ['type5', 'disability_type_5'],
            ['type6', 'disability_type_6'],
            ['type7', 'disability_type_7'],
            ['type8', 'disability_type_8'],
            // Add more disability types here
        ];

        // Gender
        $genders = ['ชาย', 'หญิง'];

        // Query and retrieve data
        $data = [];

        foreach ($disabilityTypes as $disabilityType) {
            $typeData = [];

            foreach ($genders as $gender) {
                $genderData = [];

                foreach ($ageRanges as $ageRange) {
                    [$rangeName, $rangeStart, $rangeEnd] = $ageRange;

                    // Use model method to retrieve data
                    $result = $patient->countAndData($disabilityType[1], $gender, $rangeStart, $rangeEnd);
                    $genderData[$rangeName] = [
                        'count' => $result['count'],
                        'data' => $result['data'],
                    ];
                }

                $typeData[$gender] = $genderData;
            }

            $data[$disabilityType[0]] = $typeData;
        }

 
        //-----View -------------------------------------------------------------------------
        return view(
            'dashboard',
            [
                'patient_count' => $patient_count,
                'likely_num' => $likely_num,
                'disability_type_1_num' => $disability_type_1_num,
                'disability_type_2_num' => $disability_type_2_num,
                'disability_type_3_num' => $disability_type_3_num,
                'disability_type_4_num' => $disability_type_4_num,
                'disability_type_5_num' => $disability_type_5_num,
                'disability_type_6_num' => $disability_type_6_num,
                'disability_type_7_num' => $disability_type_7_num,
                'disability_type_8_num' => $disability_type_8_num,
                'multi_disability_type_num' => $multi_disability_type_num,
                'patients' => $patients,
                'ageRanges' => $ageRanges,
                'disabilityTypes' => $disabilityTypes,
                'data' => $data,

            ]
        );
    }
}
