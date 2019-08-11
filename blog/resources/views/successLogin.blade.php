@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">                
                <div class="card-body">
                    <h5 class="card-title">Lucky Draw Dashboard</h5>
                    <p class="card-text">Select/draw the winning numbers with <u>Lucky Draw</u>.</p>
                    <p class="card-text">Generate users and input winning numbers with <u>Member Panel</u>.</p>
                </div>
                <div class="card-body">
                    <a href="{{ url('/luckydraw') }}" class="card-link">Lucky Draw</a>
                    <a href="{{ url('/member') }}" class="card-link">Member Panel</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
