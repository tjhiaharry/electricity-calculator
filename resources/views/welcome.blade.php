<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Electricity Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="background-color: #f8f8f8">

    <nav class="navbar bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand ms-3" href="#">
                Electricity Calculator.
            </a>
        </div>
    </nav>

    <div class="text-center">
        <div class="row">
            <div class="col-7">
                <div class="row mt-5">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="p-3 bg-dark bg-opacity-10 border border-dark rounded">
                            <form method="POST" action="/calculate">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="device">Typical Appliance</span>
                                    <select class="form-select" name="device" id="device" required>
                                        <option selected disabled>Define your own</option>
                                        <option value='zero_watt_bulb'>Zero Watt Bulb</option>
                                        <option value='cfl_bulb'>CFL bulb</option>
                                        <option value='bulb'>Bulb</option>
                                        <option value='tube_light'>Tube Light</option>
                                        <option value='ceiling_fan'>Ceiling Fan</option>
                                        <option value='fridge_165_litre'>Fridge 165 Litre</option>
                                        <option value='mixie'>Mixie</option>
                                        <option value='washing_machine'>Washing Machine</option>
                                        <option value='iron_box'>Iron Box</option>
                                        <option value='water_pump'>Water Pump</option>
                                        <option value='vacuum_cleaner'>Vacuum Cleaner</option>
                                        <option value='television'>Television</option>
                                        <option value='tape_recorder'>Tape Recorder</option>
                                        <option value='video_player'>Video Player</option>
                                        <option value='mobile_charger'>Mobile Charger</option>
                                        <option value='computer'>Computer</option>
                                        <option value='air_conditioner'>Air Conditioner</option>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="time">Usage</span>
                                    <input type="hidden" name="time" id="timeInput">
                                    <input type="text" id="displayTime" class="form-control" name="time"
                                        placeholder="00:00:00" required>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="price">Electricity Price</span>
                                    <span class="input-group-text" id="price">Rp</span>
                                    <input type="text" class="form-control" placeholder="Electricity Price"
                                        aria-label="Electricity Price" aria-describedby="price" name="usage" id="price" required
                                        oninput="formatNumber(this)" />
                                    <span class="input-group-text">per kWh</span>
                                </div>
                                <button type="submit" class="btn btn-primary">Calculate</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>

                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="mt-5 p-3 bg-info bg-opacity-10 border border-info rounded">
                            <h4>Timer</h4>
                            <div id="timer" class="pb-1">00:00:00</div>
                            <button onclick="startTimer()" class="btn btn-success">Start</button>
                            <button onclick="stopTimer()" class="btn btn-danger">Stop</button>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>

            <div class="col-5">
                <div class="row">
                    <div class="col-10">
                        @if(!empty($error))
                            <div class="alert alert-danger" role="alert">
                                Silahkan Pilih Typical Appliance Dahulu!
                            </div>
                        @endif
                        @if(!empty($timeSpan) && !empty($eUsage) && !empty($cost))
                            <div class="mt-5">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th scope="col">Electricity usage</th>
                                                    <th scope="col">Cost</th>
                                                    <th scope="col">Time Span</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        {{ $eUsage }}
                                                        kWh</td>
                                                    <td>Rp
                                                        {{ number_format($cost, 0, ',', '.') }}
                                                    </td>
                                                    <td>{{ $timeSpan }} Second</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if($eUsage > 8000)
                                <div class="alert alert-danger" role="alert">
                                    Penggunaan peralatan listrik anda berlebihan!
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Timer --}}
    <script>
        var seconds = 0;
        var minutes = 0;
        var hours = 0;
        var timerInterval;

        function pad(value) {
            return value < 10 ? '0' + value : value;
        }

        function startTimer() {
            timerInterval = setInterval(function () {
                seconds++;
                if (seconds >= 60) {
                    seconds = 0;
                    minutes++;
                    if (minutes >= 60) {
                        minutes = 0;
                        hours++;
                    }
                }

                document.getElementById("timer").innerHTML = pad(hours) + ":" + pad(minutes) + ":" + pad(
                    seconds);
                document.getElementById("displayTime").value = pad(hours) + ":" + pad(minutes) + ":" + pad(
                    seconds);
            }, 1000);
        }

        function stopTimer() {
            clearInterval(timerInterval);
            document.getElementById("timeInput").value = pad(hours) + ":" + pad(minutes) + ":" + pad(seconds);
        }

    </script>

    {{-- Auto Currency --}}
    <script>
        function formatNumber(input) {
            // Remove non-numeric characters
            let value = input.value.replace(/\D/g, '');

            // Format the number with commas
            value = new Intl.NumberFormat().format(value);

            // Update the input field with the formatted number
            input.value = value;
        }

    </script>

    {{-- Auto input 00:00:00 --}}
    <script>
        window.onload = function () {
            document.getElementById('displayTime').value = '00:00:00';
        };

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>
