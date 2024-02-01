@extends('layout.app')

@section('title', 'ลงทะเบียน | CDPD Thailand Data')

@section('content')
    <h1 class="display-5">แก้ไขข้อมูลผู้ดูแล</h1>
    <hr>
    <form action="{{ route('caregivers.update', $caregiver->id) }}" method="POST" class="needs-validation" novalidate autocomplete="off"
        accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row mb-3">
            <div class="col-lg-6">
                <label for="full_name" class="form-label"><strong>ชื่อ-สกุล <span
                            class="text-danger">*</span></strong></label>
                <input type="text" name="full_name" id="full_name" class="form-control" maxlength="100"
                    value="{{ $caregiver->full_name }}" required>
                <div class="invalid-feedback">
                    กรุณากรอก ชื่อ-สกุล.
                </div>
            </div>
            <div class="col-lg-2">
                <label for="gender" class="form-label"><strong>เพศ</strong></label>
                <select name="gender" id="gender" class="form-select">
                    <option value="">-- เลือก --</option>
                    <option value="ชาย" {{ $caregiver->gender == 'ชาย' ? 'selected' : '' }}>ชาย</option>
                    <option value="หญิง" {{ $caregiver->gender == 'หญิง' ? 'selected' : '' }}>หญิง</option>
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
                        value="{{ date('d-m-Y', strtotime($caregiver->birthdate)) }}" placeholder="วว-ดด-ปปปป" required>
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
                    <option value="พุทธ" {{ $caregiver->religion == 'พุทธ' ? 'selected' : '' }}>พุทธ</option>
                    <option value="คริสต์" {{ $caregiver->religion == 'คริสต์' ? 'selected' : '' }}>คริสต์</option>
                    <option value="อิสลาม" {{ $caregiver->religion == 'อิสลาม' ? 'selected' : '' }}>อิสลาม</option>
                    <option value="ไม่มีศาสนา" {{ $caregiver->religion == 'ไม่มีศาสนา' ? 'selected' : '' }}>ไม่มีศาสนา
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
                <input type="text" name="personal_id_number" id="personal_id_number" class="form-control" maxlength="13"
                    placeholder="123456789xxxx" value="{{ $caregiver->personal_id_number }}" required>
                <div class="invalid-feedback">
                    กรุณากรอก เลขบัตรประชาชน.
                </div>
            </div>
            <div class="col-lg-3">
                <label for="phone_number" class="form-label"><strong>เบอร์ติดต่อ<span
                            class="text-danger">*</span></strong></label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" maxlength="10"
                    placeholder="089xxxxxxx" value="{{ $caregiver->phone_number }}" required>
                <div class="invalid-feedback">
                    กรุณากรอก เบอร์ติดต่อ.
                </div>
            </div>
            <div class="col-lg-3">
                <label for="email" class="form-label"><strong>อีเมล์</strong></label>
                <input type="text" name="email" id="email" class="form-control" maxlength="70"
                    value="{{ $caregiver->email }}">
                <div class="invalid-feedback">
                    กรุณากรอก อีเมล์.
                </div>
            </div>

        </div>

        <h5><strong>ข้อมูลที่อยู่</strong></h5>
        <hr>
        <div class="row mb-3">
            <div class="col-lg-4">
                <label for="address" class="form-label"><strong>ที่อยู่</strong></label>
                <input type="text" name="address" id="address" class="form-control" maxlength="20"
                    value="{{ $caregiver->address }}">
                <div class="invalid-feedback">
                    กรุณากรอก ที่อยู่.
                </div>
            </div>
            <div class="col-lg-2">
                <label for="district" class="form-label"><strong>ตำบล</strong></label>
                <input type="text" name="district" id="district" class="form-control" maxlength="50"
                    value="{{ $caregiver->district }}">
                <div class="invalid-feedback">
                    กรุณากรอก ตำบล.
                </div>
            </div>
            <div class="col-lg-2">
                <label for="amphoe" class="form-label"><strong>อำเภอ</strong></label>
                <input type="text" name="amphoe" id="amphoe" class="form-control" maxlength="50"
                    value="{{ $caregiver->amphoe }}">
                <div class="invalid-feedback">
                    กรุณากรอก อำเภอ.
                </div>
            </div>
            <div class="col-lg-2">
                <label for="province" class="form-label"><strong>จังหวัด</strong></label>
                <input type="text" name="province" id="province" class="form-control" maxlength="50"
                    value="{{ $caregiver->province }}">
                <div class="invalid-feedback">
                    กรุณากรอก จังหวัด.
                </div>
            </div>
            <div class="col-lg-2">
                <label for="zipcode" class="form-label"><strong>รหัสไปรษณี</strong></label>
                <input type="text" name="zipcode" id="zipcode" class="form-control" maxlength="5"
                    value="{{ $caregiver->zipcode }}">
                <div class="invalid-feedback">
                    กรุณากรอก รหัสไปรษณี.
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-12">
                <label for="profile_picture" class="form-label">รูปภาพผู้ดูแล</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                <div class="invalid-feedback">กรุณาเลือกรูปภาพผู้ดูแล</div>
            </div>
        </div>

            <img src="{{ $caregiver->getImageURL() }}" class="img-thumbnail" width="200px" alt="...">


        <div class="mt-4">
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <a href="{{ url()->previous()}}" class="btn btn-secondary">ยกเลิก</a>
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
