@extends('layouts.app') @section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Teacher Dashboard</h1>
</div>

<div class="row mb-3">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Exam</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $teacher_exam }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Student Your Batch</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_student_under }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Row-->
@endsection
