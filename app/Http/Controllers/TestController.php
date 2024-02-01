<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\DateConverter;

use function PHPUnit\Framework\isEmpty;

class TestController extends Controller
{
    public function index(Patient $patient)
    {

        // Calculate birthdate limits
        $currentYear = now()->year;
        // $startYearCE = ($currentYear - 0) + 543; // Convert to BE
        // $endYearCE = ($currentYear - 5) + 543; // Convert to BE
        $startYearCE = $currentYear - 15; // Convert to BE
        $endYearCE = $currentYear - 6; // Convert to BE

        $startDateCE = "$startYearCE-01-01";
        $endDateCE = "$endYearCE-31-12";

        // $startDateCE = Carbon::createFromDate($startYearCE, 1, 1)->format('d-m-Y');
        // $endDateCE = Carbon::createFromDate($endYearCE, 12, 31)->format('d-m-Y');

        // $startDateCE = date('d-m-Y', strtotime("01-01-$startYearCE"));
        // $endDateCE = date('d-m-Y', strtotime("31-12-$endYearCE"));

        echo '<p>startDateCE:' . $startDateCE . '</p>';
        echo '<p>endDateCE:' . $endDateCE . '</p>';
        $count = Patient::where('disability_type_1', 1)
            ->where('gender', 'หญิง')
            ->whereYear('birthdate', '>=', $startDateCE)
            ->whereYear('birthdate', '<=', $endDateCE)
            ->count();
        $lists = Patient::where('disability_type_1', 1)
            ->where('gender', 'หญิง')
            ->whereYear('birthdate', '>=', $startDateCE)
            ->whereYear('birthdate', '<=', $endDateCE)
            ->get();



        echo $count;

        foreach ($lists as $list) {
            echo '<p>' . $list->full_name . '|' . $list->birthdate . '|' . $list->age . '|' . $list->personal_id_number . '</p>';
            echo '<p>' . $count . '</p>';
        }
    }

    public function convertBirthday(Patient $patient)
    {

        $patients = $patient->all();
        foreach ($patients as $item) {
            if ($item->birthdate_th) {
                $englishDate = DateConverter::thToEngDate($item->birthdate_th);

                $patient->where('id', $item->id)->update(['birthdate' => $englishDate]);



                echo '<p>เดิม ' . $item->birthdate_th . ' | ใหม่ ' . $item->birthdate . ' - Convert to - ' . $englishDate . '</p>';
            } else {
                echo '<p>' . $item->birthdate_th . ' - This NULL</p>';
            }
        }
    }
}
