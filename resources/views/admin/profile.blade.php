@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">👤 Admin Profile</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-success text-white d-inline-flex justify-content-center align-items-center" style="width: 80px; height: 80px; font-size: 28px;">
                            {{ strtoupper(auth()->user()->name[0]) }}
                        </div>
                        <h5 class="mt-3">{{ auth()->user()->name }}</h5>
                        <p class="text-muted mb-0">{{ auth()->user()->email }}</p>
                        <span class="badge bg-primary mt-1 text-capitalize">{{ auth()->user()->role }}</span>
                    </div>

                    <hr>

                    <h6 class="text-muted">Account Information</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Name:</strong> {{ auth()->user()->name }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ auth()->user()->email }}</li>
                        <li class="list-group-item"><strong>Role:</strong> {{ auth()->user()->role }}</li>
                        <li class="list-group-item"><strong>Joined:</strong> {{ auth()->user()->created_at->format('F j, Y') }}</li>
                    </ul>

                    <div class="mt-4 text-end">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">⬅ Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
