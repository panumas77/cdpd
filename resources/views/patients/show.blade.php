@extends('layout.app')

@section('title', 'ข้อมูลผู้พิการ | CDPD Thailand Data')

@section('content')
    <p class="pt-1"><a href="{{route('home')}}" class="btn btn-light"><i
                class="fa-solid fa-arrow-left-long fa-2xl"></i></a></p>
    <h1 class="display-5"><i class="fa-solid fa-wheelchair"></i> ข้อมูลผู้พิการ <small>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="fa-solid fa-circle-plus"></i> เพิ่มรับการบริการ
            </button>
        </small></h1>
    <hr>
    <div class="pb-5 px-4">
        <div class="row mb-3">
            <div class="col-lg-9">

                @if (!empty($patient->likely))
                    <h5 class="text-danger">ผู้มีแนวโน้มจะพิการ </h5>';
                @endif
                <p><strong class="fs-6"><i class="fa-solid fa-address-card"></i> เลขประจำตัวประชาชน: </strong><span
                        class="fs-4"> {{ $patient->personal_id_number }}</span> | <strong class="fs-6">ศาสนา:
                    </strong><span class="fs-4">{{ $patient->religion }}</span></p>
                <p><strong class="fs-6"><i class="fa-solid fa-user"></i> ชื่อ-สกุล: </strong> <span
                        class="fs-4">{{ $patient->full_name }} | <strong class="fs-6">เพศ: </strong> <span
                            class="fs-4">{{ $patient->gender }}</span></p>
                <p><strong class="fs-6"><i class="fa-solid fa-cake-candles"></i> วัน/เดือน/ปีเกิด: </strong> <span
                        class="fs-4">{{ date('d/m/Y', strtotime($patient->getThDate())) }} | <strong class="fs-6">อายุ:
                        </strong> <span class="fs-4">{{ $patient->getAge() }} ปี</span></p>
                <hr width="60%">
                <h4><i class="fa-solid fa-wheelchair"></i> ความพิการ</h2>
                    <ul>

                        @if (!empty($patient->disability_type_1))
                            <li class="fs-6"><strong>ประเภทความพิการที่ 1: </strong> ทางการมองเห็น</li>
                        @endif

                        @if (!empty($patient->disability_type_2))
                            <li class="fs-6"><strong>ประเภทความพิการที่ 2: </strong> ทางการได้ยินหรือ สื่อความหมาย</li>
                        @endif

                        @if (!empty($patient->disability_type_3))
                            <li class="fs-6"><strong>ประเภทความพิการที่ 3: </strong> ทางการเคลื่อนไหวหรือ ทางร่างกาย</li>
                        @endif

                        @if (!empty($patient->disability_type_4))
                            <li class="fs-6"><strong>ประเภทความพิการที่ 4: </strong> ทางจิตใจหรือ พฤติกรรม</li>
                        @endif

                        @if (!empty($patient->disability_type_5))
                            <li class="fs-6"><strong>ประเภทความพิการที่ 5: </strong> ทางสติปัญญา</li>
                        @endif

                        @if (!empty($patient->disability_type_6))
                            <li class="fs-6"><strong>ประเภทความพิการที่ 6: </strong> ทางการเรียนรู้</li>
                        @endif

                        @if (!empty($patient->disability_type_7))
                            <li class="fs-6"><strong>ประเภทความพิการที่ 7: </strong> ออทิสติก</li>
                        @endif

                    </ul>
                    <hr width="60%">
                    <p><strong class="fs-6"><i class="fa-solid fa-mobile-screen-button"></i> เบอร์โทรศัพท์: </strong><span
                            class="fs-4">{{ $patient->phone_number }}</span></p>
                    <p><strong class="fs-6"><i class="fa-solid fa-envelope"></i> อีเมล: </strong><span
                            class="fs-4">{{ $patient->email }}</span></p>
                    <p><strong class="fs-6"><i class="fa-solid fa-restroom"></i> สถานะสมรส: </strong><span
                            class="fs-4">{{ $patient->marriage_status }}</span> | <strong class="fs-6">จำนวนบุตร:
                        </strong><span class="fs-4">{{ $patient->number_of_children }}</span></p>

            </div>

            <div class="col-lg-3 text-center">
                <img src="{{ $patient->getImageURL() }}" alt="" class="patient-image img-thumbnail" width="300px">
            </div>
        </div>



        <h2><i class="fa-solid fa-clipboard-list"></i> ประวัติการเข้ารับบริการ </h5>
            <hr>

            <div class="table-responsive pb-5">
                <table id="servicesTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>วันที่รับบริการ</th>
                            <th class="d-none d-lg-table-cell">เลขที่แบบคำขอฯ</th>
                            <th>การบริการ</th>
                            <th class="d-none d-lg-table-cell">ผู้ให้บริการ</th>
                            <th>คำสั่ง</th>
                            <!-- Add other columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->getThDate() }}</td>
                                <td class="d-none d-lg-table-cell">{{ $service->service_number }}</td>
                                <td>{{ $service->service_category->short_name }}</td>
                                <td class="d-none d-lg-table-cell">{{ $service->user->name }}</td>
                                <td>
                                    <!-- Action buttons -->
                                    <button class="btn btn-info btn-sm btn-view" data-serviceid="{{ $service->id }}"><i
                                            class="fa-solid fa-info"></i></button>
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <button class="btn btn-danger btn-sm btn-delete" data-serviceid="{{ $service->id }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ลบข้อมูล."><i
                                            class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>

    <!-- Modal to display info -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="infoModalLabel">รายละเอียดบริการ</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="infoModalBody">
                    <!-- Patient info will be loaded dynamically here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="addModalLabel"><i class="fa-solid fa-hospital-user"></i>
                        เพิ่มรับการบริการ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form action="{{ route('services.store', $patient->id) }}" method="POST"
                        class="needs-validation pb-5" novalidate autocomplete="off" accept-charset="UTF-8">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
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
                                            {{ old('category_id') == $serviceCat->short_name ? 'selected' : '' }}>
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
                                            {{ old('user_id') == $user->name ? 'selected' : '' }}>
                                            {{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">กรุณากรอก ผู้ให้บริการ.</div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>
                    <!-- Form -->
                </div>
            </div>
        </div>
    </div>
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
            selectYears: 5, //เลือกปีได้ 5ปี (true, ค่าเริ่มต้น 10ปี )
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
