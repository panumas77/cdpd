@extends('layout.app')

@section('title', 'ลงทะเบียน | CDPD Thailand Data')

@section('content')

    <h1 class="display-5">ข้อมูลผู้พิการ</h1>
    <hr>
    <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="needs-validation pb-5" novalidate
        autocomplete="off" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row mb-3">
            <div class="col-6 col-md-4 col-xxl-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input fs-5" type="checkbox" name="likely_to_disability"
                        id="likely_to_disability" value="1" {{ $patient->likely == 1 ? 'checked' : '' }}>
                    <label class="form-check-label fs-5" for="likely_to_disability">ผู้มีแนวโน้มจะพิการ</label>
                </div>
            </div>
            <div class="col-6 col-md-8 col-xxl-9">
                <div class="form-check form-check-inline">
                    <input class="form-check-input fs-5" type="checkbox" name="disability_type_8" id="disability_type_8"
                        value="1" {{ $patient->disability_type_8 == 1 ? 'checked' : '' }}>
                    <label class="form-check-label fs-5" for="disability_type_8">ผู้มีความพิการซ้ำซ้อน</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-2">
                <label for="first_service_date" class="form-label"><strong>วันที่ลงทะเบียน <span
                            class="text-danger">*</span></strong></label>
                <div class="input-group">
                    <input type="text" name="first_service_date" id="first_service_date" class="form-control datepicker"
                        value="{{ date('d-m-Y', strtotime($patient->first_service_date)) }}" placeholder="วว-ดด-ปปปป">
                    <div class="invalid-feedback">
                        กรุณากรอก วันเกิด.
                    </div>
                    <span class="input-group-text"><i class="fa-regular fa-calendar"></i></span>
                </div>
            </div>

            <div class="col-lg-4">
                <label for="full_name" class="form-label"><strong>ชื่อ-สกุล <span
                            class="text-danger">*</span></strong></label>
                <input type="text" name="full_name" id="full_name" class="form-control" maxlength="100"
                    value="{{ $patient->full_name }}" required>
                <div class="invalid-feedback">
                    กรุณากรอก ชื่อ-สกุล.
                </div>
            </div>
            <div class="col-lg-2">
                <label for="gender" class="form-label"><strong>เพศ <span class="text-danger">*</span></strong></label>
                <select name="gender" id="gender" class="form-select" required>
                    <option value="">-- เลือก --</option>
                    <option value="ชาย" {{ $patient->gender == 'ชาย' ? 'selected' : '' }}>ชาย</option>
                    <option value="หญิง" {{ $patient->gender == 'หญิง' ? 'selected' : '' }}>หญิง</option>
                </select>
                <div class="invalid-feedback">
                    กรุณากรอก เพศ.
                </div>
            </div>

            <div class="col-lg-2">
                <label for="birthdate" class="form-label"><strong>วันเกิด <span
                            class="text-danger">*</span></strong></label>
                <div class="input-group">
                    <input type="text" name="birthdate" id="birthdate" class="form-control datepicker"
                        value="{{ date('d-m-Y', strtotime($patient->birthdate)) }}" placeholder="วว-ดด-ปปปป" required>
                    {{-- <input type="text" name="birthdate" id="birthdate" class="form-control datepicker" value="{{$dateConverter->engToThDate($patient->birthdate)}}" placeholder="วว-ดด-ปปปป" required> --}}
                    {{-- <input type="text" name="birthdate" id="birthdate" class="form-control datepicker" value="{{$patient->birthdate}}" placeholder="วว-ดด-ปปปป" required> --}}
                    <div class="invalid-feedback">
                        กรุณากรอก วันเกิด.
                    </div>
                    <span class="input-group-text"><i class="fa-regular fa-calendar"></i></span>
                </div>
            </div>
            <div class="col-lg-2">
                <label for="religion" class="form-label"><strong>ศาสนา</strong></label>
                <select name="religion" id="religion" class="form-select">
                    <option value="">-- เลือก --</option>
                    <option value="พุทธ" {{ $patient->religion == 'พุทธ' ? 'selected' : '' }}>พุทธ</option>
                    <option value="คริสต์" {{ $patient->religion == 'คริสต์' ? 'selected' : '' }}>คริสต์</option>
                    <option value="อิสลาม" {{ $patient->religion == 'อิสลาม' ? 'selected' : '' }}>อิสลาม</option>
                    <option value="ไม่มีศาสนา" {{ $patient->religion == 'ไม่มีศาสนา' ? 'selected' : '' }}>ไม่มีศาสนา
                    </option>
                </select>
                <div class="invalid-feedback">
                    กรุณากรอก ศาสนา.
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-3">
                <label for="personal_id_number" class="form-label"><strong>เลขบัตรประชาชน <span
                            class="text-danger">*</span></strong></label>
                <input type="text" name="personal_id_number" id="personal_id_number" placeholder="123456789xxxx" class="form-control" maxlength="13"
                    value="{{ $patient->personal_id_number }}" required>
                <div class="invalid-feedback">
                    กรุณากรอก เลขบัตรประชาชน.
                </div>
            </div>
            <div class="col-lg-3">
                <label for="phone_number" class="form-label"><strong>เบอร์ติดต่อ <span
                            class="text-danger">*</span></strong></label>
                <input type="text" name="phone_number" id="phone_number" placeholder="089xxxxxxx" class="form-control" maxlength="10"
                    value="{{ $patient->phone_number }}" required>
                <div class="invalid-feedback">
                    กรุณากรอก เบอร์ติดต่อ.
                </div>
            </div>
            <div class="col-lg-3">
                <label for="email" class="form-label"><strong>อีเมล์</strong></label>
                <input type="text" name="email" id="email" class="form-control" maxlength="70"
                    value="{{ $patient->email }}">
                <div class="invalid-feedback">
                    กรุณากรอก อีเมล์.
                </div>
            </div>
            <div class="col-lg-2">
                <label for="marriage_status" class="form-label"><strong>สถานะสมรส <span
                            class="text-danger">*</span></strong></label>
                <select name="marriage_status" id="marriage_status" class="form-select" required>
                    <option value="">-- เลือก --</option>
                    <option value="โสด" {{ $patient->marriage_status == 'โสด' ? 'selected' : '' }}>โสด</option>
                    <option value="สมรส" {{ $patient->marriage_status == 'สมรส' ? 'selected' : '' }}>สมรส</option>
                    <option value="หย่า" {{ $patient->marriage_status == 'หย่า' ? 'selected' : '' }}>หย่า</option>
                    <option value="ม่าย" {{ $patient->marriage_status == 'ม่าย' ? 'selected' : '' }}>ม่าย</option>
                </select>
                <div class="invalid-feedback">
                    กรุณากรอก สถานะสมรส.
                </div>
            </div>
            <div class="col-lg-1">
                <label for="number_of_children" class="form-label"><strong>จำนวนบุตร</strong></label>
                <input type="number" name="number_of_children" id="number_of_children" class="form-control" max=10
                    value="{{ $patient->number_of_children }}">
                <div class="invalid-feedback">
                    กรุณากรอก จำนวนบุตร.
                </div>
            </div>
        </div>


        <div class="row mb-3">
            <label for="disability_type" class="form-label"><strong>ความพิการ <span
                        class="text-danger">*</span></strong></label>
            <div class="col-lg-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="disability_type_1" id="disability_type_1"
                        value="1" {{ $patient->disability_type_1 == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="disability_type_1">ทางการมองเห็น</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="disability_type_2" id="disability_type_2"
                        value="1" {{ $patient->disability_type_2 == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="disability_type_2">ทางการได้ยินหรือ สื่อความหมาย</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="disability_type_3" id="disability_type_3"
                        value="1" {{ $patient->disability_type_3 == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="disability_type_3">ทางการเคลื่อนไหวหรือ ทางร่างกาย</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="disability_type_4" id="disability_type_4"
                        value="1" {{ $patient->disability_type_4 == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="disability_type_4">ทางจิตใจหรือ พฤติกรรม</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="disability_type_5" id="disability_type_5"
                        value="1" {{ $patient->disability_type_5 == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="disability_type_5">ทางสติปัญญา</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="disability_type_6" id="disability_type_6"
                        value="1" {{ $patient->disability_type_6 == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="disability_type_6">ทางการเรียนรู้</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="disability_type_7" id="disability_type_7"
                        value="1" {{ $patient->disability_type_7 == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="disability_type_7">ออทิสติก</label>
                </div>

                <div class="invalid-feedback">
                    Please select at least one disability type.
                </div>
            </div>
        </div>



        <div class="row mb-3">
            <div class="col-lg-6">
                <label for="caregiver_name" class="form-label"><strong>ผู้ดูแล (ชื่อ-สกุล) </strong></label>
                <input type="text" name="caregiver_name" id="caregiver_name" class="form-control" maxlength="100"
                    value="{{ $patient->caregiver_name }}">
                <div class="invalid-feedback">
                    กรุณากรอก ชื่อผู้ดูแล.
                </div>
                <div id="caregiverList"></div> <!-- Container for autocomplete results -->
            </div>

            <input type="hidden" id="caregiver_id" name="caregiver_id" value="{{ isset($patient->caregiver_id) ? $patient->caregiver_id : '' }}">

            <div class="col-lg-6">
                <label for="relationship" class="form-label"><strong>ความสัมพันธ์ </strong></label>
                <select name="relationship" id="relationship" class="form-select">
                    <option value="">-- เลือก --</option>
                    <option value="สามี" {{ $patient->relationship == 'สามี' ? 'selected' : '' }}>สามี</option>
                    <option value="ภรรยา" {{ $patient->relationship == 'ภรรยา' ? 'selected' : '' }}>ภรรยา</option>
                    <option value="พ่อ" {{ $patient->relationship == 'พ่อ' ? 'selected' : '' }}>พ่อ</option>
                    <option value="แม่" {{ $patient->relationship == 'แม่' ? 'selected' : '' }}>แม่</option>
                    <option value="ลูก" {{ $patient->relationship == 'ลูก' ? 'selected' : '' }}>ลูก</option>
                    <option value="หลาน" {{ $patient->relationship == 'หลาน' ? 'selected' : '' }}>หลาน</option>
                    <option value="ลุง" {{ $patient->relationship == 'ลุง' ? 'selected' : '' }}>ลุง</option>
                    <option value="ป้า" {{ $patient->relationship == 'ป้า' ? 'selected' : '' }}>ป้า</option>
                    <option value="น้า" {{ $patient->relationship == 'น้า' ? 'selected' : '' }}>น้า</option>
                    <option value="อา" {{ $patient->relationship == 'อา' ? 'selected' : '' }}>อา</option>
                    <option value="ญาติ" {{ $patient->relationship == 'ญาติ' ? 'selected' : '' }}>ญาติ</option>
                </select>
                <div class="invalid-feedback">
                    กรุณากรอก ความสัมพันท์.
                </div>
            </div>
        </div>


        <h5><strong>ข้อมูลที่อยู่</strong></h5>
        <hr>
        <div class="row mb-3">
            <div class="col-lg-4">
                <label for="address" class="form-label"><strong>ที่อยู่</strong></label>
                <input type="text" name="address" id="address" class="form-control" maxlength="100"
                    value="{{ $patient->address }}">
                <div class="invalid-feedback">
                    กรุณากรอก ที่อยู่.
                </div>
            </div>
            <div class="col-lg-2">
                <label for="district" class="form-label"><strong>ตำบล</strong></label>
                <input type="text" name="district" id="district" class="form-control" maxlength="100"
                    value="{{ $patient->district }}">
                <div class="invalid-feedback">
                    กรุณากรอก ตำบล.
                </div>
            </div>
            <div class="col-lg-2">
                <label for="amphoe" class="form-label"><strong>อำเภอ</strong></label>
                <input type="text" name="amphoe" id="amphoe" class="form-control" maxlength="100"
                    value="{{ $patient->amphoe }}">
                <div class="invalid-feedback">
                    กรุณากรอก อำเภอ.
                </div>
            </div>
            <div class="col-lg-2">
                <label for="province" class="form-label"><strong>จังหวัด</strong></label>
                <input type="text" name="province" id="province" class="form-control" maxlength="100"
                    value="{{ $patient->province }}">
                <div class="invalid-feedback">
                    กรุณากรอก จังหวัด.
                </div>
            </div>
            <div class="col-lg-2">
                <label for="zipcode" class="form-label"><strong>รหัสไปรษณี</strong></label>
                <input type="text" name="zipcode" id="zipcode" class="form-control" maxlength="100"
                    value="{{ $patient->zipcode }}">
                <div class="invalid-feedback">
                    กรุณากรอก รหัสไปรษณี.
                </div>
            </div>
        </div>

        <h5><strong>รูปผู้พิการ</strong></h5>
        <hr>
        <div class="row mb-3">
            <div class="col-lg-12">
                <label for="profile_picture" class="form-label">รูปภาพผู้พิการ</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                <div class="invalid-feedback">กรุณาเลือกรูปภาพผู้พิการ</div>
            </div>
        </div>
        @if ($patient->profile_picture)
            <img src="{{ $patient->getImageURL() }}" class="img-thumbnail" width="200px"
                alt="...">
        @endif
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">ยกเลิก</a>
        </div>
    </form>
@endsection

@section('script')
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add('was-validated');
                    }, false);
                });
        })();

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });



        // Check Personal ID exists and right 13 digi.
        $(document).ready(function() {
            $("#personal_id_number").on("input", function() {
                var personalId = $(this).val();
                if (personalId.length == 13) {
                    $("#id-exists").html("");
                    $.ajax({
                        url: "{{ url('checkPersonalId') }}", // Use the route you defined
                        method: "POST",
                        data: {
                            personal_id_number: personalId
                        },
                        success: function(data) {
                            var response = JSON.parse(data);
                            if (response.exists == true) {
                                $("#id-exists").html("เลขบัตรประชาชน ซ้ำ!!!");
                                // Personal ID exists, handle accordingly (e.g., display a message)
                                // You can also add a CSS class or change the input style
                                // Example: $("#personal_id_number").addClass("exists");
                            } else {
                                $("#id-exists").html("");
                                // Personal ID does not exist, clear any previous messages or styles
                                // Example: $("#personal_id_number").removeClass("exists");
                            }
                        }
                    });
                } else {
                    $("#id-exists").html("เลขบัตรประชาชน ไม่ครบ 13หลัก");
                }
            });
        });

        //AutoComplete Caregiver name
        $(document).ready(function() {
            // Autocomplete function
            $("#caregiver_name").on("input", function() {
                var input = $(this).val();
                if (input.length >= 2) { // Only make a request when at least 2 characters are typed
                    $.ajax({
                        url: "{{ url('getCaregivers') }}", // Replace with your actual controller and method
                        method: "POST",
                        data: {
                            query: input
                        },
                        success: function(data) {
                            $("#caregiverList").html(data); // Display results in the dropdown
                        },
                        error: function(data) {
                            // Handle error
                            console.log(data);
                        }
                    });
                } else {
                    $("#caregiverList").html(""); // Clear the dropdown
                }
            });

            // Handle click on a caregiver name in the list
            $("#caregiverList").on("click", "button", function() {
                var selectedName = $(this).text();
                var caregiverId = $(this).data('id');
                $("#caregiver_name").val(selectedName);
                $("#caregiver_id").val(caregiverId);
                $("#caregiverList").html(""); // Clear the dropdown
            });
        });


        // Initialize the datepicker Buddhist era.

        $('.datepicker').pickadate({
            max: true, //ไม่สามารถเลือกวันเดือนปี เกินวันที่ปัจจุบันได้
            monthsFull: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',
                'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
            ],
            monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.',
                'ธ.ค.'
            ],
            weekdaysFull: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
            weekdaysShort: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
            today: 'วันนี้',
            clear: 'ลบ',
            format: 'dd-mm-yyyy',
            formatSubmit: 'dd-mm-yyyy',
            selectMonths: true, //เลือกเดือนได้
            selectYears: 20, //เลือกปีได้ 5ปี (true, ค่าเริ่มต้น 10ปี )
            onStart: function() {
                // จัดรูปแบบค่าฟิลด์อินพุตหลังจากที่ตัวเลือกปิด
                var selectedDate = this.get('select', 'dd-mm-yyyy'); // รับวันที่เลือก
                var parts = selectedDate.split('-'); // แยกส่วนวันที่
                var buddhistYear = parseInt(parts[2]) +
                    543; // แปลงเป็น พ.ศ. (เนื่องจากค่าใน input จะยังเป็น ค.ศ. จึงต้องแปลงอีกรอบ)
                var formattedDate = parts[0] + '-' + parts[1] + '-' + buddhistYear; // จัดวันที่ใหม่
                this.$node.val(formattedDate); // อัปเดตค่าอินพุต

            },
            onRender: function() {
                var yearDropdown = this.$root.find('.picker__select--year');
                if (yearDropdown.length > 0) {
                    yearDropdown.find('option').each(function() {
                        var westernYear = parseInt($(this).text());
                        var buddhistYear = westernYear + 543; // แปลงเป็น พ.ศ.
                        $(this).text(buddhistYear);
                    });
                }
            },
            onClose: function() {
                // จัดรูปแบบค่าฟิลด์อินพุตหลังจากที่ตัวเลือกปิด
                var selectedDate = this.get('select', 'dd-mm-yyyy'); // รับวันที่เลือก
                var parts = selectedDate.split('-'); // แยกส่วนวันที่
                var buddhistYear = parseInt(parts[2]) +
                    543; // แปลงเป็น พ.ศ. (เนื่องจากค่าใน input จะยังเป็น ค.ศ. จึงต้องแปลงอีกรอบ)
                var formattedDate = parts[0] + '-' + parts[1] + '-' + buddhistYear; // จัดวันที่ใหม่
                this.$node.val(formattedDate); // อัปเดตค่าอินพุต
            }
        });


        $.Thailand({
            $district: $('#district'), // input ของตำบล
            $amphoe: $('#amphoe'), // input ของอำเภอ
            $province: $('#province'), // input ของจังหวัด
            $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
        });
    </script>
@endsection
