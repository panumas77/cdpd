@extends('layout.app')

@section('title', 'Dashboard | CDPD Thailand Data')

@section('content')
    <h1 class="display-5 pt-3">จำนวนผู้พิการทั้งหมด <small>จำนวน {{ $patient_count }} คน</small></h1>
    <hr>
    {{-- <div class="container pt-3">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xxl-4">
            <div class="col">
                <div class="card text-bg-primary mb-3">
                    <div class="row g-0">
                        <div class="col-5 mt-2 text-center">
                            <span class="display-6">{{ $disability_type_1_num }} <i class='bx bx-low-vision'></i></span>
                        </div>
                        <div class="col-7">
                            <div class="card-body">
                                <h5 class="card-title">ทางการมองเห็น </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-secondary mb-3">
                    <div class="row g-0">
                        <div class="col-5 mt-2 text-center">
                            <span class="display-6">{{ $disability_type_2_num }} <i class='bx bx-bell-off'></i></span>
                        </div>
                        <div class="col-7">
                            <div class="card-body">
                                <h5 class="card-title text-start">ทางการได้ยิน</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-success mb-3">
                    <div class="row g-0">
                        <div class="col-5 mt-2 text-center">
                            <span class="display-6">{{ $disability_type_3_num }} <i class='bx bx-handicap'></i></span>
                        </div>
                        <div class="col-7">
                            <div class="card-body">
                                <h5 class="card-title">การเคลื่อนไหว</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-info mb-3">
                    <div class="row g-0">
                        <div class="col-5 mt-2 text-center">
                            <span class="display-6">{{ $disability_type_4_num }} <i class='bx bxs-heart'></i></span>
                        </div>
                        <div class="col-7 text-start">
                            <div class="card-body">
                                <h5 class="card-title">ทางจิตใจ</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xxl-4">
            <div class="col">
                <div class="card text-bg-danger mb-3">
                    <div class="row g-0">
                        <div class="col-5 mt-2 text-center">
                            <span class="display-6">{{ $disability_type_5_num }} <i class='bx bxs-cube-alt'></i></span>
                        </div>
                        <div class="col-7">
                            <div class="card-body">
                                <h5 class="card-title">ทางสติปัญญา</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-warning mb-3">
                    <div class="row g-0">
                        <div class="col-5 mt-2 text-center">
                            <span class="display-6">{{ $disability_type_6_num }} <i class='bx bxs-book'></i></span>
                        </div>
                        <div class="col-7">
                            <div class="card-body">
                                <h5 class="card-title">ทางการเรียนรู้</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-dark mb-3">
                    <div class="row g-0">
                        <div class="col-5 mt-2 text-center">
                            <span class="display-6">{{ $disability_type_7_num }} <i class='bx bx-message-minus'></i></span>
                        </div>
                        <div class="col-7">
                            <div class="card-body">
                                <h5 class="card-title">ออทิสติก</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-light mb-3">
                    <div class="row g-0">
                        <div class="col-5 mt-2 text-center">
                            <span class="display-6">{{ $likely_num }} <i class='bx bx-universal-access'></i></span>
                        </div>
                        <div class="col-7">
                            <div class="card-body">
                                <h5 class="card-title">ผู้มีแนวโน้ม</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row ">
            <div class="col col-12 col-md-5">
                <div class="card border-primary mb-3">
                    <div class="row g-0">
                        <div class="col-5 mt-2 text-center text-primary">
                            <span class="display-6">{{ $multi_disability_type_num }} <i class='bx bxs-band-aid'></i></span>
                        </div>
                        <div class="col-7">
                            <div class="card-body text-primary">
                                <h5 class="card-title">พิการซ้ำซ้อน</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-md-7">
                <div class="card border-danger  mb-3">
                    <div class="row g-0">
                        <div class="col-5 mt-2 text-center text-danger ">
                            <span
                                class="display-6">{{ $disability_type_1_num + $disability_type_2_num + $disability_type_3_num + $disability_type_4_num + $disability_type_5_num + $disability_type_6_num + $disability_type_7_num + $likely_num + $multi_disability_type_num }}
                                <i class='bx bxs-band-aid'></i></span>
                        </div>
                        <div class="col-7">
                            <div class="card-body text-danger ">
                                <h5 class="card-title">รวมทั้งหมด</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th scope="col">ความพิการ</th>
                    <th scope="col" colspan="2">มีแนวโน้ม</th>
                    <th scope="col" colspan="2">การมอง</th>
                    <th scope="col" colspan="2">ได้ยิน</th>
                    <th scope="col" colspan="2">เคลื่อนไหว</th>
                    <th scope="col" colspan="2">จิตใจ</th>
                    <th scope="col" colspan="2">สติปัญญา</th>
                    <th scope="col" colspan="2">เรียนรู้</th>
                    <th scope="col" colspan="2">ออทิสติก</th>
                    <th scope="col" colspan="2">ซ้ำซ้อน</th>
                    <th scope="col" colspan="3">รวม</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>ช่วงอายุ</th>
                    <?php foreach ($disabilityTypes as $disabilityType) : ?>
                    <th>ช</th>
                    <th>ญ</th>
                    <?php endforeach; ?>                   
                    <th>ช</th>
                    <th>ญ</th>
                    <th>ชญ</th>
                </tr>
                <?php
                $countMaleSum = 0;
                $countFemaleSum = 0;
                $sumMaleAndFemaleEachAgeRanges = 0;
                ?>
                <?php foreach ($ageRanges as $ageRange) : ?>
                <tr>
                    <th><?= $ageRange[0] ?></th>
                    <?php foreach ($disabilityTypes as $disabilityType) : ?>
                    <?php $countMale = $data[$disabilityType[0]]['ชาย'][$ageRange[0]]['count']; ?>
                    <?php $countFemale = $data[$disabilityType[0]]['หญิง'][$ageRange[0]]['count']; ?>
                    <td><?= $countMale ?></td>
                    <td><?= $countFemale ?></td>
                    <?php endforeach; ?>
                    <?php // Calculate and display the sum of people in the "รวม" column
                    ?>
                    <?php $sumMale = 0; ?>
                    <?php $sumFemale = 0; ?>
                    <?php foreach ($disabilityTypes as $disabilityType) : ?>
                    <?php $sumMale += $data[$disabilityType[0]]['ชาย'][$ageRange[0]]['count']; ?>
                    <?php $sumFemale += $data[$disabilityType[0]]['หญิง'][$ageRange[0]]['count']; ?>
                    <?php endforeach; ?>

                    <?php $sumMaleAndFemaleEachAgeRanges = $sumMale + $sumFemale; ?>


                    <td>{{ $sumMale }}</td>
                    <td>{{ $sumFemale }}</td>
                    <td>{{ $sumMaleAndFemaleEachAgeRanges }}</td>
                </tr>
                <?php endforeach; ?>

                <tr>
                    <th>รวมแยก ช./ญ.</th>
                    <?php // Calculate and display the sum of people in the "รวม" column
                    ?>
                    <?php
                    $sumMaleTotal = 0;
                    $sumFemaleTotal = 0;
                    ?>
                    <?php foreach ($ageRanges as $ageRange) : ?>
                    <?php $sumMale = 0; ?>
                    <?php $sumFemale = 0; ?>
                    <?php foreach ($disabilityTypes as $disabilityType) : ?>
                    <?php $sumMale += $data[$disabilityType[0]]['ชาย'][$ageRange[0]]['count']; ?>
                    <?php $sumFemale += $data[$disabilityType[0]]['หญิง'][$ageRange[0]]['count']; ?>
                    <?php endforeach; ?>

                    <?php
                    $sumMaleTotal += $sumMale;
                    $sumFemaleTotal += $sumFemale;
                    ?>

                    <?php endforeach; ?>

                    @foreach ($disabilityTypes as $disabilityType)
                    <?php
                    $sumMale = 0;
                    $sumFemale = 0;
                    ?>
                        @foreach ($ageRanges as $ageRange)
                            <?php $sumMale += $data[$disabilityType[0]]['ชาย'][$ageRange[0]]['count']; ?>
                            <?php $sumFemale += $data[$disabilityType[0]]['หญิง'][$ageRange[0]]['count']; ?>
                        @endforeach
                        <td>{{ $sumMale }}</td>
                    <td>{{ $sumFemale }}</td>
                    @endforeach
                 

                    <td>{{ $sumMaleTotal }}</td>
                    <td>{{ $sumFemaleTotal }}</td>
                    <td>{{ $sumMaleTotal + $sumFemaleTotal }}</td>
                </tr>

                <tr>
                    <th>รวม ช./ญ.</th>
                    @foreach ($disabilityTypes as $disabilityType)
                    <?php
                    $sumMale = 0;
                    $sumFemale = 0;
                    ?>
                        @foreach ($ageRanges as $ageRange)
                            <?php $sumMale += $data[$disabilityType[0]]['ชาย'][$ageRange[0]]['count']; ?>
                            <?php $sumFemale += $data[$disabilityType[0]]['หญิง'][$ageRange[0]]['count']; ?>
                        @endforeach
                        <td colspan="2">{{ $sumMale +  $sumFemale}}</td>
                    @endforeach

                    <td colspan="3">{{ $sumMaleTotal + $sumFemaleTotal }}</td>

                </tr>


            </tbody>
        </table>
    </div>
    {{-- {{dd($data)}} --}}
@endsection
