@extends('layout.app')

@section('title', 'เพิ่มข้อมูลผู้ใช้ | CDPD Thailand Data')

@section('content')
<h1 class="display-5">ข้อมูลผู้ใช้</h1>
<hr>
<form action="{{ route('users.store') }}" method="POST"  class="needs-validation pb-5" novalidate autocomplete="off" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col-lg-4">
            <label for="name" class="form-label">ชื่อ-สกุล</label><span class="text-danger">*</span>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="col-lg-2">
            <label for="nickname" class="form-label">ชื่อเล่น</label>
            <input type="text" class="form-control" id="nickname" name="nickname" value="{{ old('nickname') }}">
        </div>
        <div class="col-lg-6">
            <label for="position" class="form-label">ตำแหน่ง</label><span class="text-danger">*</span>
            <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}" required>
        </div>

    </div>
    <div class="row mb-3">
    <div class="col-lg-4">
            <label for="username" class="form-label">ชื่อผู้ใช้ (Username)</label><span class="text-danger">*</span>
            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
        </div>
        <div class="col-lg-4">
            <label for="password" class="form-label">พาสเวิร์ด</label><span class="text-danger">*</span>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="col-lg-4">
            <label for="email" class="form-label">อีเมล์</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
        </div>
        
    </div>
    <div class="row mb-3">
        <div class="col-lg-6">
            <label for="role" class="form-label">สิทธิ</label>
            <select class="form-select" id="role" name="role">
                <option value="User" {{ old('role', 'User') }}>User</option>
                <option value="SuperUser" {{ old('role', 'SuperUser') }}>SuperUser</option>
                <option value="Admin" {{ old('role', 'Admin') }}>Admin</option>
                <option value="SuperAdmin" {{ old('role', 'SuperAdmin') }}>SuperAdmin</option>
                <option value="Root" {{ old('role', 'Root') }}>Root</option>

            </select>
        </div>
        <div class="col-lg-6">
            <label for="is_active" class="form-label">ใช้งาน</label>
            <select class="form-select" id="is_active" name="is_active">
                <option value="1" {{ old('is_active') }}>Yes</option>
                <option value="0" {{ old('is_active') }}>No</option>

            </select>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">บันทึก</button>
        <a href="{{url()->previous()}}" class="btn btn-secondary">ยกเลิก</a>
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

    </script>
@endsection