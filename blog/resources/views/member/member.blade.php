@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Member Panel</h5>
                    <hr>

                    <div class="col-md-12">
                            <form method="POST" id="member-form" action="{{ url('/member/newWinNumber') }}">                            
                            {{-- Member name --}}
                                <div class="form-group row">
                                    <label for="member-name" class="col-sm-6 col-form-label">Member Name</label>
                                    <input class="form-control" id="member-name" type="text" name="mName" placeholder="Input Member Name">
                                    
                                    <span class="invalid-feedback error-hide" role="alert">
                                        <strong id="mnError"></strong>
                                    </span>
                                    
                                </div>
                            {{-- Winning Number --}}
                                <div class="form-group row">
                                    <label for="win-num" class="col-sm-6 col-form-label">Winning Number</label>                                
                                    <input class="form-control" id="win-num" type="text" name="winNumber" placeholder="Input winning number">                                    
                                    <span class="invalid-feedback error-hide" role="alert">
                                            <strong id="wnError"></strong>
                                    </span>                                    
                                </div>
    
                                <div class="form-group row mb-0">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">Draw</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/member.js') }}" defer></script>
@endsection
