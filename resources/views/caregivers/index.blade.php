@extends('layout.app')

@section('title', 'ฐานข้อมูลผู้ดูแลผู้พิการ | CDPD Thailand Data')

@section('content')
    <h1 class="display-5">ฐานข้อมูลผู้ดูแล <small>จำนวน {{ $caregiver_count }} คน</small></h1>
    <hr>
    <div class="order-0 order-xxl-1">
        <div class="pb-3">
            <h3>ค้นหาผู้ดูแลผู้พิการ</h3>
        </div>
        <div class="row pb-5">
            <form action="{{ route('caregivers.index') }}" method="GET" class="d-flex" role="search">
                <input class="form-control me-2" value="{{ request('search', '') }}" name="search" type="search"
                    placeholder="ชื่อ,เลขบัตรประชาชน,เบอร์มือถือ" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">ค้นหา</button>
            </form>
        </div>
    </div>
{{-- Pagination ideas section --}}
<div>
  {{ $caregivers->withQueryString()->links() }}
</div>
{{-- Pagination ideas section --}}
    <table class="table table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th class="text-center">#</th>
                <th class="d-none d-lg-table-cell">เลขประชาชน</th>
                <th>ชื่อ-สกุล</th>
                <th class="d-none d-lg-table-cell text-center">เพศ</th>
                <th class="d-none d-lg-table-cell">เบอร์โทร</th>
                <th class="text-center">อายุ</th>
                <th class="text-center">คำสั่ง</th>
                <!-- Add other columns as needed -->
            </tr>
        </thead>
        <tbody>
            @php
                $no = $caregivers->firstItem();
            @endphp
            @foreach ($caregivers as $caregiver)
                <tr>
                    <td class="text-center">{{ $no }}</td>
                    <td class="d-none d-lg-table-cell">{{ $caregiver->personal_id_number }}</td>
                    <td>{{ $caregiver->full_name }}</td>
                    <td class="d-none d-lg-table-cell text-center">{{ $caregiver->gender }}</td>
                    <td class="d-none d-lg-table-cell">{{ $caregiver->phone_number }}</td>
                    <td class="text-center">{{$caregiver->getAge('birthdate')}}ปี</td>
                    <td class="text-center">
                        <!-- Action buttons -->
                        <button class="btn btn-info btn-sm btn-view" data-caregiverid="{{ $caregiver->id }}"><i
                                class="fa-solid fa-info"></i></button>
                        <a href="{{ route('caregivers.edit', $caregiver->id) }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                        <button class="btn btn-danger btn-sm btn-delete" data-caregiverid="{{ $caregiver->id }}"
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
        {{ $caregivers->withQueryString()->links() }}
    </div>
    {{-- Pagination ideas section --}}

@endsection

@section('script')
@endsection
