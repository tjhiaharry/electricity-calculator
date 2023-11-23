@extends('layout')

@section('content')
    <!-- Page Content -->
    <div class="more-info about-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="clear"></div>
                    <div id="contentout">
                        <div id="content">
                            <h1>Electricity Calculator</h1>
                            <p>Use the calculator below to estimate electricity usage and cost based on the power
                                requirements and usage of appliances...</p>
                            <div class="row">
                                <div class="col-7">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>
                                                <form method="POST" action="/calculate">
                                                    @csrf
                                                    <table class="panel">
                                                        <tr>
                                                            <td align="right">Typical appliance:</td>
                                                            <td>
                                                                <select name="device" id="device">
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
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">Usage:</td>
                                                            <td>
                                                                <input type="hidden" name="time" id="timeInput">
                                                                <input type="text" id="displayTime" class="inhalf" name="time"
                                                                    placeholder="00:00:00">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">Electricity Price:</td>
                                                            <td>
                                                                <input type="text" class="inhalf indollar" placeholder="Electricity Price"
                                                                    aria-label="Electricity Price" aria-describedby="price" name="usage" id="price"
                                                                    oninput="formatNumber(this)" />
                                                                per kWh
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" align="center">
                                                                <button type="submit" class="btn btn-primary">Calculate</button>
                                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>
                                                <div class="mt-5 p-3 border border-info rounded text-center" style="background-color: rgb(23,162,184, 0.5)">
                                                    <h4>Timer</h4>
                                                    <div id="timer" class="pb-1">00:00:00</div>
                                                    <button onclick="startTimer()" class="btn btn-success">Start</button>
                                                    <button onclick="stopTimer()" class="btn btn-danger">Stop</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-4">
                                    @if(!empty($error))
                                        <div class="alert alert-danger mt-5" role="alert">
                                            Silahkan Pilih Typical Appliance Dahulu!
                                        </div>
                                    @endif
                                    @if(!empty($calculations))
                                    <div class="mt-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-bordered">
                                                    <thead class="table-primary">
                                                        <tr>
                                                            <th scope="col">Electricity usage</th>
                                                            <th scope="col">Cost</th>
                                                            <th scope="col">Time Span</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $tUsage = 0;
                                                            $tCost = 0;
                                                        @endphp
                                                        @foreach($calculations as $calculationId => $calculation)
                                                        <tr>
                                                            <td>
                                                                {{ $calculation['eUsage'] }}
                                                                kWh</td>
                                                            <td>Rp
                                                                {{ number_format($calculation['cost'], 0, ',', '.') }}
                                                            </td>
                                                            <td>{{ $calculation['timeSpan'] }} Second</td>
                                                            <td>
                                                                <form action="{{ route('deleteCalculation', ['id' => $calculationId]) }}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $tUsage += $calculation['eUsage'];
                                                            $tCost += $calculation['cost'];
                                                        @endphp
                                                        @endforeach
                                                        <tr>
                                                            <td><b>{{ $tUsage }} kWh</b></td>
                                                            <td><b>Rp{{ number_format($tCost, 0, ',', '.') }}</b></td>
                                                            <td colspan="2" class="text-center"><b>TOTAL</b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @if($tUsage > 8000)
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
                </div>
            </table>
        </div>
    </div>


    <div class="team">
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Your <em>Appliances</em></h2>
                        <span>Suspendisse a ante in neque iaculis lacinia</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-item">
                        <img src="https://i.imgur.com/kcauGS6.jpg" alt="">
                        <div class="down-content">
                            <h4>Lamps</h4>
                            <span>-----</span>
                            <p>In sem sem, dapibus non lacus auctor, ornare sollicitudin lacus. Aliquam ipsum urna,
                                semper quis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-item">
                        <img src="https://i.imgur.com/YqJoMOe.jpg" alt="">
                        <div class="down-content">
                            <h4>AirConditioner</h4>
                            <span>------</span>
                            <p>In sem sem, dapibus non lacus auctor, ornare sollicitudin lacus. Aliquam ipsum urna,
                                semper quis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-item">
                        <img src="https://i.imgur.com/HJr4cff.jpg" alt="">
                        <div class="down-content">
                            <h4>Fridge</h4>
                            <span>-------</span>
                            <p>In sem sem, dapibus non lacus auctor, ornare sollicitudin lacus. Aliquam ipsum urna,
                                semper quis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="fun-facts">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-content">
                        <span>ECOWEB</span>
                        <h2>Our solutions for your <em>Electricity problem</em></h2>
                        <p>Pellentesque ultrices at turpis in vestibulum. Aenean pretium elit nec congue elementum.
                            Nulla luctus laoreet porta. Maecenas at nisi tempus, porta metus vitae, faucibus augue.
                            <br><br>Fusce et venenatis ex. Quisque varius, velit quis dictum sagittis, odio velit
                            molestie nunc, ut posuere ante tortor ut neque.</p>
                        <a href="" class="filled-button">Read More</a>
                    </div>
                </div>
                <div class="col-md-6 align-self-center">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="count-area-content">
                                <div class="count-digit">945</div>
                                <div class="count-title">Trees Planted</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="count-area-content">
                                <div class="count-digit">1280</div>
                                <div class="count-title">Great Reviews</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="count-area-content">
                                <div class="count-digit">578</div>
                                <div class="count-title">Trees being chopped</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="count-area-content">
                                <div class="count-digit">26</div>
                                <div class="count-title">Complaints</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>What they say <em>about us</em></h2>
                        <span>testimonials from our greatest clients</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="owl-testimonials owl-carousel">

                        <div class="testimonial-item">
                            <div class="inner-content">
                                <h4>George Walker</h4>
                                <span>Climate Analyst</span>
                                <p>"Nulla ullamcorper, ipsum vel condimentum congue, mi odio vehicula tellus, sit amet
                                    malesuada justo sem sit amet quam. Pellentesque in sagittis lacus."</p>
                            </div>
                            <img src="http://placehold.it/60x60" alt="">
                        </div>

                        <div class="testimonial-item">
                            <div class="inner-content">
                                <h4>John Smith</h4>
                                <span>Tree Specialist</span>
                                <p>"In eget leo ante. Sed nibh leo, laoreet accumsan euismod quis, scelerisque a nunc.
                                    Mauris accumsan, arcu id ornare malesuada, est nulla luctus nisi."</p>
                            </div>
                            <img src="http://placehold.it/60x60" alt="">
                        </div>

                        <div class="testimonial-item">
                            <div class="inner-content">
                                <h4>David Wood</h4>
                                <span>Chief Accountant</span>
                                <p>"Ut ultricies maximus turpis, in sollicitudin ligula posuere vel. Donec finibus
                                    maximus neque, vitae egestas quam imperdiet nec. Proin nec mauris eu tortor
                                    consectetur tristique."</p>
                            </div>
                            <img src="http://placehold.it/60x60" alt="">
                        </div>

                        <div class="testimonial-item">
                            <div class="inner-content">
                                <h4>Andrew Boom</h4>
                                <span>Marketing Head</span>
                                <p>"Curabitur sollicitudin, tortor at suscipit volutpat, nisi arcu aliquet dui, vitae
                                    semper sem turpis quis libero. Quisque vulputate lacinia nisl ac lobortis."</p>
                            </div>
                            <img src="http://placehold.it/60x60" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}


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

@endsection
