@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lucky Draw</h5>
                    <hr>
                    <div class="col-md-12">

                    <form method="POST" id="draw-form" action="{{ url('/luckydraw/getdraw') }}">
                        {{-- Prize Type --}}
                            <div class="form-group row">
                                <label for="prize-type" class="col-sm-6 col-form-label">Prize Type</label>                                
                                <select class="form-control" id="prize-type" name="prizeType">
                                        <option>please select</option>
                                        <option value='31'>third prize - 1st winner</option>
                                        <option value='32'>third prize - 2nd winner</option>
                                        <option value='33'>third prize - 3rd winner</option>
                                        <option value='21'>second prize - 1rd winner</option>
                                        <option value='22'>second prize - 2nd winner</option>
                                        <option value='11'>first prize</option>
                                </select>
                                @error('prizeType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        {{-- Generate Randomly --}}
                            <div class="form-group row">
                                <label for="gen-random" class="col-sm-6 col-form-label">Generate Randomly</label>
                                <select class="form-control" id="gen-random" name="genRandom">
                                    <option>please select</option>
                                    <option value='0'>no</option>
                                    <option value='1'>yes</option>
                                </select>
                                @error('genRandom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        {{-- Winning Number --}}
                            <div class="form-group row">
                                <label for="win-num" class="col-sm-6 col-form-label">Winning Number</label>                                
                                <input class="form-control" id="win-num" type="text" name="winNumber" placeholder="Input winning number">
                                @error('winNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
<script src="{{ asset('js/luckydraw.js') }}" defer></script>
@endsection
