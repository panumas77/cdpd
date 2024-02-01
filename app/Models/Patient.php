<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Patient extends Model
{
    use HasFactory;


    protected $fillable = [
        'full_name',
        'gender',
        'birthdate_th',
        'birthdate',
        'profile_picture',
        'phone_number',
        'personal_id_number',
        'religion',
        'marriage_status',
        'number_of_children',
        'likely',
        'disability_type_1',
        'disability_type_2',
        'disability_type_3',
        'disability_type_4',
        'disability_type_5',
        'disability_type_6',
        'disability_type_7',
        'disability_type_8',
        'address',
        'district',
        'amphoe',
        'province',
        'zipcode',
        'first_service_date',
        'deaded',
        'caregiver_name',
        'caregiver_id',
        'relationship',
    ];


    public function service(){
        return $this->hasMany(Service::class,'patient_id');
    }

    public function getMutiDisabilityTypeNum()
    {
        $patients = $this->get();

        $disabilityTypes = [
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


        $multi_dis_count = 0;
        $dis_count = 0;
        $dis_count_sum = 0;
        foreach ($patients as $patient) {
            $type = 0;
            foreach ($disabilityTypes as $disabilityType) {
                if ($patient[$disabilityType[1]] == 1) {
                    // echo $disabilityType[1] . '<br>';
                    $dis_count++;
                    $type++;
                }
            }

            if ($type > 1) {
                $dis_count = 0;
                $multi_dis_count = $multi_dis_count + 1;

                $multi_dis_patients[] = $patient;
                // echo '<p>'.$patient->full_name. '</p>';
            }
            $dis_count_sum = $dis_count_sum + $dis_count;
        }


        return $multi_dis_count;
    }
    public function countAndData($disabilityType, $gender, $ageRangeStart, $ageRangeEnd)
    {
        // Calculate birthdate limits
        $currentYear = now()->year;
        $startYearCE = $currentYear - $ageRangeEnd; // Convert to BE
        $endYearCE = $currentYear - $ageRangeStart; // Convert to BE

        // $startYearCE = $currentYear - $ageRangeEnd + 543; // Convert to BE
        // $endYearCE = $currentYear - $ageRangeStart + 543; // Convert to BE

        // Convert Thai date formats to 'Y-m-d' for MySQL
        // $startDateCE = "$startYearCE-01-01";
        // $endDateCE = "$endYearCE-12-31";

        $startDateCE = "$startYearCE-01-01";
        $endDateCE = "$endYearCE-12-31";

        // Count records
        $count = Patient::where($disabilityType, 1)
            ->where('gender', $gender)
            ->whereDate('birthdate', '>=', $startDateCE)
            ->whereDate('birthdate', '<=', $endDateCE)
            ->count();

        // Fetch data
        $data = Patient::where($disabilityType, 1)
            ->where('gender', $gender)
            ->whereDate('birthdate', '>=', $startDateCE)
            ->whereDate('birthdate', '<=', $endDateCE)
            ->get()
            ->toArray();

        return [
            'count' => $count,
            'data' => $data
        ];
    }

    public function getAge()
    {
        $birthdate = $this->birthdate;

        return Carbon::now()->diffInYears($birthdate);
    }

    public function getImageURL(){
        if($this->profile_picture){
            return url('storage/'.$this->profile_picture);
        }
        return url('storage/images/no-image.svg');
    }

    public function getThDate()
    {
        $date = explode('-', $this->birthdate);

        $thYear = intval($date[0]) + 543;

        $thDate = $date[2] . '-' . $date[1] . '-' . $thYear;

        return $thDate;
    }
}
