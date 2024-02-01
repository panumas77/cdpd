@extends('layout.app')

@section('title', 'ลงทะเบียน | CDPD Thailand Data')

@section('content')
    <h1 class="display-5">แก้ไขข้อมูลผู้ใช้</h1>
    <hr>
    <form action="{{ route('users.update', $user->id) }}" method="POST"  class="needs-validation pb-5" novalidate autocomplete="off" accept-charset="UTF-8">
        @csrf
        @method('put')
        <div class="row mb-3">
            <div class="col-lg-4">
                <label for="name" class="form-label">ชื่อ-สกุล</label><span class="text-danger">*</span>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="col-lg-2">
                <label for="nickname" class="form-label">ชื่อเล่น</label>
                <input type="text" class="form-control" id="nickname" name="nickname" value="{{ $user->nickname }}">
            </div>
            <div class="col-lg-6">
                <label for="position" class="form-label">ตำแหน่ง</label><span class="text-danger">*</span>
                <input type="text" class="form-control" id="position" name="position" value="{{ $user->position }}" required>
            </div>
    
        </div>
        <div class="row mb-3">
        <div class="col-lg-4">
                <label for="username" class="form-label">ชื่อผู้ใช้ (Username)</label><span class="text-danger">*</span>
                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
            </div>
            <div class="col-lg-4">
                <label for="password" class="form-label">พาสเวิร์ด</label><span class="text-danger">*</span>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="col-lg-4">
                <label for="email" class="form-label">อีเมล์</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>
            
        </div>
        <div class="row mb-3">
            <div class="col-lg-6">
                <label for="role" class="form-label">สิทธิ</label>
                <select class="form-select" id="role" name="role">
                    <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User</option>
                    <option value="SuperUser" {{ $user->role == 'SuperUser' ? 'selected' : '' }}>SuperUser</option>
                    <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="SuperAdmin" {{ $user->role == 'SuperAdmin' ? 'selected' : '' }}>SuperAdmin</option>
                    <option value="Root" {{ $user->role == 'Root' ? 'selected' : '' }}>Root</option>
    
                </select>
            </div>
            <div class="col-lg-6">
                <label for="is_active" class="form-label">ใช้งาน</label>
                <select class="form-select" id="is_active" name="is_active">
                    <option value="1" {{ $user->is_active == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ $user->is_active == '0' ? 'selected' : '' }}>No</option>
    
                </select>
            </div>
        </div>
    
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <a href="{{route('users.index')}}" class="btn btn-secondary">ยกเลิก</a>
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
