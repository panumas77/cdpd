<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {

        //---Data Patient Type and Age ranges------------------------------------------------------------------------

        // Age Ranges
        $ageRanges = [
            ['0-18ปี', 0, 18],
            ['18ปี ขึ้นไป', 19, 99],
        ];

        // Disability Types
        $disabilityTypes = [
            ['type0', 'likely','มีแนวโน้ม'],
            ['type1', 'disability_type_1','การมอง'],
            ['type2', 'disability_type_2','ได้ยิน'],
            ['type3', 'disability_type_3','เคลื่อนไหว'],
            ['type4', 'disability_type_4','จิตใจ'],
            ['type5', 'disability_type_5','สติปัญญา'],
            ['type6', 'disability_type_6','เรียนรู้'],
            ['type7', 'disability_type_7','ออทิสติก'],
            ['type8', 'disability_type_8','ซ้ำซ้อน'],
            // Add more disability types here
        ];

        // Gender
        $genders = ['ชาย', 'หญิง'];

        // Query and retrieve data
        $data = [];

        return view('reports.index', [
            'ageRanges' => $ageRanges,
            'disabilityTypes' => $disabilityTypes,
            'data' => $data,
        ]);
    }
}
