@extends('layout.app')

@section('title', 'เพิ่มข้อมูลบริการ | CDPD Thailand Data')

@section('content')
<h1 class="display-5">เพิ่มข้อมูลบริการ</h1>
<hr>
<!-- Form -->
<form action="{{ route('services.store') }}" method="POST"
    class="needs-validation pb-5" novalidate autocomplete="off" accept-charset="UTF-8">
    @csrf
    <div class="row mb-3">
        <div class="col-12">
            <label for="patient_name" class="form-label"><strong>ผู้พิการ (ชื่อ-สกุล) </strong></label>
            <input type="text" name="patient_name" id="patient_name" class="form-control" maxlength="100" value="{{ isset($patient->id) ? $patient->full_name : '' }}">
            <div class="invalid-feedback">
                กรุณากรอก ชื่อผู้ดูแล.
            </div>
            <div id="patientList"></div> <!-- Container for autocomplete results -->
        </div>

        <input type="hidden" id="patient_id" name="patient_id" value="{{ isset($patient->id) ? $patient->id : '' }}">
    </div>
    <div class="row mb-3">
        <div class="col-lg-12">
            <label for="service_date" class="form-label"><strong>วันที่รับบริการ <span
                        class="text-danger">*</span></strong></label>
            <div class="input-group">
                <input type="text" name="service_date" id="service_date"
                    class="form-control datepicker" value="{{ old('service_date') }}" required>
                <div class="invalid-feedback">
                    กรุณากรอก วันที่รับบริการ.
                </div>
                <span class="input-group-text"><i class="fa-regular fa-calendar"></i></span>
            </div>
        </div>
        <div class="col-lg-12 pt-2">
            <label for="category_id" class="form-label"><strong>ประเภทบริการ</strong><span
                    class="text-danger">*</span></label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">-- เลือก --</option>
                @foreach ($serviceCats as $serviceCat)
                    <option value="{{ $serviceCat->id }}"
                        {{ old('category_id' == $serviceCat->id ? 'selected' : '') }}>
                        {{ $serviceCat->short_name }}</option>
                @endforeach

            </select>
            <div class="invalid-feedback">
                กรุณากรอก ประเภทบริการที่ขอรับ.
            </div>
        </div>
        <div class="col-lg-12 pt-2">
            <label for="service_number" class="form-label"><strong>เลขที่แบบคำขอฯ <span
                        class="text-danger">*</span></strong></label>
            <input type="text" name="service_number" id="service_number" class="form-control"
                maxlength="100" value="{{ old('service_number') }}" required>
            <div class="invalid-feedback">
                กรุณากรอก เลขที่แบบคำขอฯ.
            </div>
        </div>
        <div class="col-lg-12 pt-2">
            <label for="service_detail" class="form-label"><strong>รายละเอียดบริการ<span
                        class="text-danger">*</span></strong></label>
            <textarea class="form-control" id="service_detail" name="service_detail" rows="4" required>{{ old('service_detail') }}</textarea>
            <div class="invalid-feedback">กรุณากรอก รายละเอียดบริการ</div>
        </div>

        <div class="col-lg-12 pt-2">
            <label for="user_id" class="form-label"><strong>ผู้ให้บริการ <span
                        class="text-danger">*</span></strong></label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">-- เลือก --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        {{ old('user_id' == $user->id ? 'selected' : '') }}>
                        {{ $user->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">กรุณากรอก ผู้ให้บริการ.</div>
        </div>
    </div>

    <div class="col-lg-4">
        <a href="{{route('home')}}" class="btn btn-secondary">ยกเลิก</a>
        <button type="submit" class="btn btn-primary">บันทึก</button>
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
        
        //AutoComplete Patient name
        $(document).ready(function() {
            // Autocomplete function
            $("#patient_name").on("input", function() {
                var input = $(this).val();
                if (input.length >= 2) { // Only make a request when at least 2 characters are typed
                    $.ajax({
                        url: "{{ url('getPatients') }}", // Replace with your actual controller and method
                        method: "POST",
                        data: {
                            query: input
                        },
                        success: function(data) {
                            $("#patientList").html(data); // Display results in the dropdown
                        },
                        error: function(data) {
                            // Handle error
                            console.log(data);
                        }
                    });
                } else {
                    $("#patientList").html(""); // Clear the dropdown
                }
            });

            // Handle click on a patient name in the list
            $("#patientList").on("click", "button", function() {
                var selectedName = $(this).text();
                var patientId = $(this).data('id');
                $("#patient_name").val(selectedName);
                $("#patient_id").val(patientId);
                $("#patientList").html(""); // Clear the dropdown
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

    </script>
@endsection