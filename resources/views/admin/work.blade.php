@extends('admin/dashboard')

@section('container1')
    @forelse ($petani as $key => $data)

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Spent</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">${{ $data->spent }}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ $data->spent * 2 }}%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="50"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Creaive work
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $data->work }}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ $data->work * 25 }}%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Quality of the Day
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $data->day }}</div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Communication with Friends</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data->friend }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">User Overview</h6>


                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">


                        <div class="row">
                            <div class="container">

                                <form action="{{ route('tracker.insert') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm">
                                            have 4 hours for creative work!
                                            <div class="slidecontainer">
                                                <input type="range" min="0" max="4" style="width:100%"
                                                    name="hours" value="{{ $data->work }}" step="0.25" class="slider"
                                                    id="score">
                                                <p style="text-align:center">Hours : <span id="score2"> </span></p>
                                            </div>
                                        </div>
                                        <script>
                                            var slider = document.getElementById("score");
                                            var output = document.getElementById("score2");
                                            output.innerHTML = slider.value;

                                            slider.oninput = function() {
                                                output.innerHTML = this.value;
                                            }
                                        </script>
                                        <div class="col-sm">
                                            have $50 to spend on fun activity.
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                    <span class="input-group-text">{{ $data->spent }}</span>
                                                </div>
                                                <input type="text" class="form-control" name="spent"
                                                    value="{{ $data->spent }}" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            Score your day!
                                            <div class="slidecontainer">
                                                <input type="range" min="-2" max="2" style="width:100%"
                                                    name="score" value="{{ $data->day }}" step="0.50"
                                                    class="slider" id="hr">
                                                <p style="text-align:center">Score : <span id="sr"> </span></p>
                                            </div>
                                        </div>
                                        <script>
                                            var slider2 = document.getElementById("hr");
                                            var output2 = document.getElementById("sr");
                                            output2.innerHTML = slider2.value;

                                            slider2.oninput = function() {
                                                output2.innerHTML = this.value;
                                            }
                                        </script>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        communicate with your friends to impove your Friendship!
                                        <div class="col-sm">
                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" type="checkbox" name="f1"
                                                    id="inlineCheckbox1" value="option1" <?php if ($data->friend >= 1) {
                                                        echo 'checked';
                                                    } ?>>
                                                <label class="form-check-label" for="inlineCheckbox1"> Friend 1</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="f2"
                                                    id="inlineCheckbox2" value="option2" <?php if ($data->friend == 2) {
                                                        echo 'checked';
                                                    } ?>>
                                                <label class="form-check-label" for="inlineCheckbox2">Friend 2</label>
                                            </div>

                                        </div>
                                    </div>
                            </div>
                            <hr>

                            @forelse($petani as $key => $data)
                                <button class="btn btn-primary" type="submit">Update</button>
                            @empty
                                <button class="btn btn-primary" type="submit">Submit</button>

                            @endif
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    @empty

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Spent</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">--</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Creaive work</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">--</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Quality of the Day
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">--</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 0%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Communication with Friends</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">--</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">User Overview</h6>


                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">


                        <div class="row">
                            <div class="container">

                                <form action="{{ route('tracker.insert') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm">
                                            have 4 hours for creative work!
                                            <div class="slidecontainer">
                                                <input type="range" min="0" max="4" style="width:100%"
                                                    name="hours" value="0" step="0.25" class="slider"
                                                    id="score">
                                                <p style="text-align:center">Hours : <span id="score2"> </span></p>
                                            </div>
                                        </div>
                                        <script>
                                            var slider = document.getElementById("score");
                                            var output = document.getElementById("score2");
                                            output.innerHTML = slider.value;

                                            slider.oninput = function() {
                                                output.innerHTML = this.value;
                                            }
                                        </script>
                                        <div class="col-sm">
                                            have $50 to spend on fun activity.
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                    <span class="input-group-text">0.00</span>
                                                </div>
                                                <input type="text" class="form-control" name="spent"
                                                    aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            Score your day!
                                            <div class="slidecontainer">
                                                <input type="range" min="-2" max="2" style="width:100%"
                                                    name="score" value="0" step="0.50" class="slider"
                                                    id="hr">
                                                <p style="text-align:center">Score : <span id="sr"> </span></p>
                                            </div>
                                        </div>
                                        <script>
                                            var slider2 = document.getElementById("hr");
                                            var output2 = document.getElementById("sr");
                                            output2.innerHTML = slider2.value;

                                            slider2.oninput = function() {
                                                output2.innerHTML = this.value;
                                            }
                                        </script>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        communicate with your friends to impove your Friendship!
                                        <div class="col-sm">

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="f1"
                                                    id="inlineCheckbox1" value="option1">
                                                <label class="form-check-label" for="inlineCheckbox1"> Friend 1</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="f2"
                                                    id="inlineCheckbox2" value="option2">
                                                <label class="form-check-label" for="inlineCheckbox2">Friend 2</label>
                                            </div>

                                        </div>
                                    </div>
                            </div>
                            <hr>

                            @forelse($petani as $key => $data)
                                <button class="btn btn-primary" type="submit">Update</button>
                            @empty
                                <button class="btn btn-primary" type="submit">Submit</button>

                            @endif
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>


        </div>
    @endforelse
@endsection
