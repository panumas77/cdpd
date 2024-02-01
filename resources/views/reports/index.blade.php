@extends('layout.app')

@section('title', 'ฐานข้อมูลผู้พิการ | CDPD Thailand Data')

@section('content')
<p class="pt-1"><a href="{{route('home')}}" class="btn btn-light"><i
    class="fa-solid fa-arrow-left-long fa-2xl"></i></a></p>
    <h1 class="display-5">รายงาน <small> </small></h1>
    <hr>
    <div class="order-0 order-xxl-1">
        <div class="pb-3">
            <h3>สร้างรายงานตาม..</h3>
        </div>
        <div class="row pb-5">
            <form action="" method="GET" class="d-flex" role="search">
                <div class="col-lg-3  px-2">
                    <label for="report_range" class="form-label"><strong>ช่วงเวลา</strong></label>
                    <select name="report_range" id="report_range" class="form-select">
                        <option value="">-- เลือก --</option>
                        <option value="มกราคม" {{ old('report_range') == 'มกราคม' ? 'selected' : '' }}>มกราคม</option>
                        <option value="กุมภาพันธุ์" {{ old('report_range') == 'กุมภาพันธุ์' ? 'selected' : '' }}>กุมภาพันธุ์</option>
                        <option value="มีนาคม" {{ old('report_range') == 'มีนาคม' ? 'selected' : '' }}>มีนาคม</option>
                        <option value="เมษายน" {{ old('report_range') == 'เมษายน' ? 'selected' : '' }}>เมษายน</option>
                        <option value="พฤษภาคม" {{ old('report_range') == 'พฤษภาคม' ? 'selected' : '' }}>พฤษภาคม</option>
                        <option value="มิถุนายน" {{ old('report_range') == 'มิถุนายน' ? 'selected' : '' }}>มิถุนายน</option>
                        <option value="กรกฎาคม" {{ old('report_range') == 'กรกฎาคม' ? 'selected' : '' }}>กรกฎาคม</option>
                        <option value="สิงหาคม" {{ old('report_range') == 'สิงหาคม' ? 'selected' : '' }}>สิงหาคม</option>
                        <option value="กันยายน" {{ old('report_range') == 'กันยายน' ? 'selected' : '' }}>กันยายน</option>
                        <option value="ตุลาคม" {{ old('report_range') == 'ตุลาคม' ? 'selected' : '' }}>ตุลาคม</option>
                        <option value="พฤศจิกายน" {{ old('report_range') == 'พฤศจิกายน' ? 'selected' : '' }}>พฤศจิกายน</option>
                        <option value="ธันวาคม" {{ old('report_range') == 'ธันวาคม' ? 'selected' : '' }}>ธันวาคม</option>
                        <option value="ไตรมาสที่1" {{ old('report_range') == 'ไตรมาสที่1' ? 'selected' : '' }}>ไตรมาสที่1</option>
                        <option value="ไตรมาสที่2" {{ old('report_range') == 'ไตรมาสที่2' ? 'selected' : '' }}>ไตรมาสที่2</option>
                        <option value="ไตรมาสที่3" {{ old('report_range') == 'ไตรมาสที่3' ? 'selected' : '' }}>ไตรมาสที่3</option>
                        <option value="ไตรมาสที่4" {{ old('report_range') == 'ไตรมาสที่4' ? 'selected' : '' }}>ไตรมาสที่4</option>
                        <option value="6เดือนแรก" {{ old('report_range') == '6เดือนแรก' ? 'selected' : '' }}>6เดือนแรก</option>
                        <option value="6เดือนท้าย" {{ old('report_range') == '6เดือนท้าย' ? 'selected' : '' }}>6เดือนท้าย</option>
                        </option>
                    </select>
                    <div class="invalid-feedback">
                        กรุณากรอก ศาสนา.
                    </div>
                </div>
                <div class="col-lg-2  px-2">
                    <label for="year" class="form-label">ปี<strong></strong></label>
                    <select name="year" id="year" class="form-select">
                        <option value="">-- เลือก --</option>
                        <option value="2567" {{ old('year') == '2567' ? 'selected' : '' }}>2567</option>
                        </option>
                    </select>
                    <div class="invalid-feedback">
                        กรุณากรอก ศาสนา.
                    </div>
                </div>
                <div class="col-lg-1  px-2">
                    <label for="religion" class="form-label"> <strong></strong></label>
                    <button class="btn btn-outline-success form-control mt-2" type="submit">ค้นหา</button>
                </div>
            </form>
        </div>
    </div>

    <h4>1) สถิติจำนวนคนพิการที่มารับบริการ (รวมทั้งหมด)</h4>
    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th scope="col"><u>ช่วงอายุ</u></th>
                <?php foreach ($ageRanges as $ageRange) : ?>
                <th scope="col" colspan="2">{{ $ageRange[0] }}</th>
                <?php endforeach; ?>
                <th scope="col" colspan="3">รวม</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            <tr>
                <th><u>ความพิการ</u></th>
                <?php foreach ($ageRanges as $ageRange) : ?>
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
            <?php foreach ($disabilityTypes as $disabilityType) : ?>
            <tr>
                <th><?= $disabilityType[2] ?></th>
                <?php foreach ($ageRanges as $ageRange) : ?>
                <td>0</td>
                <td>0</td>
                <?php endforeach; ?>
                <?php // Calculate and display the sum of people in the "รวม" column
                ?>
                <?php $sumMale = 0; ?>
                <?php $sumFemale = 0; ?>
                <td>{{ $sumMale }}</td>
                <td>{{ $sumFemale }}</td>
                <td>{{ $sumMaleAndFemaleEachAgeRanges }}</td>
            </tr>
            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <tr>
                <th>รวม</th>
                <?php foreach ($ageRanges as $ageRange) : ?>
                <td>0</td>
                <td>0</td>
                <?php endforeach; ?>
                <th>0</th>
                <th>0</th>
                <th>0</th>
            </tr>

        </tfoot>
    </table>


    <h4>2) สถิติจำนวนคนพิการที่มารับบริการบำบัดฟื้นฟูและเตรียมความพร้อมก่อนเรียนร่วมที่ศูนย์ฯ</h4>
    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th scope="col"><u>ช่วงอายุ</u></th>
                <?php foreach ($ageRanges as $ageRange) : ?>
                <th scope="col" colspan="2">{{ $ageRange[0] }}</th>
                <?php endforeach; ?>
                <th scope="col" colspan="3">รวม</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            <tr>
                <th><u>ความพิการ</u></th>
                <?php foreach ($ageRanges as $ageRange) : ?>
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
            <?php foreach ($disabilityTypes as $disabilityType) : ?>
            <tr>
                <th><?= $disabilityType[2] ?></th>
                <?php foreach ($ageRanges as $ageRange) : ?>
                <td>0</td>
                <td>0</td>
                <?php endforeach; ?>
                <?php // Calculate and display the sum of people in the "รวม" column
                ?>
                <?php $sumMale = 0; ?>
                <?php $sumFemale = 0; ?>
                <td>{{ $sumMale }}</td>
                <td>{{ $sumFemale }}</td>
                <td>{{ $sumMaleAndFemaleEachAgeRanges }}</td>
            </tr>
            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <tr>
                <th>รวม</th>
                <?php foreach ($ageRanges as $ageRange) : ?>
                <td>0</td>
                <td>0</td>
                <?php endforeach; ?>
                <th>0</th>
                <th>0</th>
                <th>0</th>
            </tr>

        </tfoot>
    </table>


    <h4>3) สถิติจำนวนคนพิการมารับบริการฝึกอาชีพและจ้างงาน (รวมข้อมูลผู้ดูแลด้วย) </h4>
    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th scope="col"><u>ช่วงอายุ</u></th>
                <?php foreach ($ageRanges as $ageRange) : ?>
                <th scope="col" colspan="2">{{ $ageRange[0] }}</th>
                <?php endforeach; ?>
                <th scope="col" colspan="3">รวม</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            <tr>
                <th><u>ความพิการ</u></th>
                <?php foreach ($ageRanges as $ageRange) : ?>
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
            <?php foreach ($disabilityTypes as $disabilityType) : ?>
            <tr>
                <th><?= $disabilityType[2] ?></th>
                <?php foreach ($ageRanges as $ageRange) : ?>
                <td>0</td>
                <td>0</td>
                <?php endforeach; ?>
                <?php // Calculate and display the sum of people in the "รวม" column
                ?>
                <?php $sumMale = 0; ?>
                <?php $sumFemale = 0; ?>
                <td>{{ $sumMale }}</td>
                <td>{{ $sumFemale }}</td>
                <td>{{ $sumMaleAndFemaleEachAgeRanges }}</td>
            </tr>
            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <tr>
                <th>รวม</th>
                <?php foreach ($ageRanges as $ageRange) : ?>
                <td>0</td>
                <td>0</td>
                <?php endforeach; ?>
                <th>0</th>
                <th>0</th>
                <th>0</th>
            </tr>

        </tfoot>
    </table>


    <h4>4) สถิติจำนวนคนพิการที่ได้รับการเยี่ยมบ้าน </h4>
    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th scope="col"><u>ช่วงอายุ</u></th>
                <?php foreach ($ageRanges as $ageRange) : ?>
                <th scope="col" colspan="2">{{ $ageRange[0] }}</th>
                <?php endforeach; ?>
                <th scope="col" colspan="3">รวม</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            <tr>
                <th><u>ความพิการ</u></th>
                <?php foreach ($ageRanges as $ageRange) : ?>
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
            <?php foreach ($disabilityTypes as $disabilityType) : ?>
            <tr>
                <th><?= $disabilityType[2] ?></th>
                <?php foreach ($ageRanges as $ageRange) : ?>
                <td>0</td>
                <td>0</td>
                <?php endforeach; ?>
                <?php // Calculate and display the sum of people in the "รวม" column
                ?>
                <?php $sumMale = 0; ?>
                <?php $sumFemale = 0; ?>
                <td>{{ $sumMale }}</td>
                <td>{{ $sumFemale }}</td>
                <td>{{ $sumMaleAndFemaleEachAgeRanges }}</td>
            </tr>
            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <tr>
                <th>รวม</th>
                <?php foreach ($ageRanges as $ageRange) : ?>
                <td>0</td>
                <td>0</td>
                <?php endforeach; ?>
                <th>0</th>
                <th>0</th>
                <th>0</th>
            </tr>

        </tfoot>
    </table>

@endsection

@section('script')
@endsection
