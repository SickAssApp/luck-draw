@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Draw Result</h5>
                    <hr>
                    <div class="col-md-12">

                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Prize</th>
                                    <th scope="col">Second Prize - 1st winner</th>
                                    <th scope="col">Second Prize - 2nd winner</th>
                                    <th scope="col">Third Prize - 1st winner</th>
                                    <th scope="col">Third Prize - 2nd winner</th>
                                    <th scope="col">Third Prize - 3rd winner</th>
                                    </tr>
                                </thead>
                                <tbody id="draw-body">
                                    {{-- Table content here --}}
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var GET_DRAW_URL = '{!! url('/showdraw/getdrawresult') !!}'
</script>
<script src="{{ asset('js/showdraw.js') }}" defer></script>

@endsection
