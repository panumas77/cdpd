@extends('layout.app')

@section('title', 'ฐานข้อมูลผู้ดูแลผู้พิการ | CDPD Thailand Data')

@section('content')
    <h1 class="display-5">ฐานข้อมูลผู้ใช้งาน <small>จำนวน {{ $user_count }} คน {{Auth::user()->role}} <a class="btn btn-primary" href="{{route('users.form')}}">เพิ่มผู้ใช้</a></small></h1>
    <hr>
    <div class="order-0 order-xxl-1">
        <div class="pb-3">
            <h3>ค้นหาผู้ใช้งาน</h3>
        </div>
        <div class="row pb-5">
            <form action="{{ route('users.index') }}" method="GET" class="d-flex" role="search">
                <input class="form-control me-2" value="{{ request('search', '') }}" name="search" type="search"
                    placeholder="ชื่อ,ชื่อเล่น,username" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">ค้นหา</button>
            </form>
        </div>
    </div>
{{-- Pagination ideas section --}}
<div>
  {{ $users->withQueryString()->links() }}
</div>
{{-- Pagination ideas section --}}
    <table class="table table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th class="text-center">#</th>
                <th>ชื่อ-สกุล</th>
                <th class="d-none d-lg-table-cell">ชื่อเล่น</th>
                <th class="d-none d-lg-table-cell">Username</th>
                <th class="d-none d-lg-table-cell">อีเมล์</th>
                <th class="d-none d-lg-table-cell">ตำแหน่ง</th>
                <th class="text-center">Role</th>
                <th class="text-center">คำสั่ง</th>
                <!-- Add other columns as needed -->
            </tr>
        </thead>
        <tbody>
            @php
                $no = $users->firstItem();
            @endphp
            @foreach ($users as $user)
                <tr>
                    <td class="text-center">{{ $no }}</td>
                    <td>{{ $user->name }}</td>
                    <td class="d-none d-lg-table-cell">{{ $user->nickname }}</td>
                    <td class="d-none d-lg-table-cell">{{ $user->username }}</td>
                    <td class="d-none d-lg-table-cell">{{ $user->email }}</td>
                    <td class="d-none d-lg-table-cell">{{ $user->position }}</td>
                    <td class="text-center">{{$user->role}}</td>
                    <td class="text-center">
                        <!-- Action buttons -->
                        <button class="btn btn-info btn-sm btn-view" data-userid="{{ $user->id }}"><i
                                class="fa-solid fa-info"></i></button>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                        <button class="btn btn-danger btn-sm btn-delete" data-userid="{{ $user->id }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ลบข้อมูล."><i
                                class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                @php
                    $no++;
                @endphp
            @endforeach
        </tbody>
    </table>
    {{-- Pagination ideas section --}}
    <div class="mt-3">
        {{ $users->withQueryString()->links() }}
    </div>
    {{-- Pagination ideas section --}}

@endsection

@section('script')
@endsection
