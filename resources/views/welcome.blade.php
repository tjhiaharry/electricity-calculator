<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Matthew Alexander">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <title>Electricity Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-finance-business.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <h2 style="color: #A4C639">Electricity Calculator</h2>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex" role="search">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a style="color: #747474" class="nav-link" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a style="color: #A4C639" class="nav-link active" href="#">Calculator</a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </nav>

    <!-- Page Content -->
    <div class="header-text">
    </div>

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
                                <div class="col-8">
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
            </div>
            </table>
        </div>
    </div>


    <div class="team">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Your <em>Appliances</em></h2>
                        <span>Suspendisse a ante in neque iaculis lacinia</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-item">
                        <img src="{{ asset('assets/images/team_01.jpg') }}" alt="">
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
                        <img src="{{ asset('assets/images/team_02.jpg') }}" alt="">
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
                        <img src="{{ asset('assets/images/team_03.jpg') }}" alt="">
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

    <div class="fun-facts">
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
    </div>

    <!-- Footer Starts Here -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 footer-item">
                    <h4>Finance Business</h4>
                    <p>Vivamus tellus mi. Nulla ne cursus elit,vulputate. Sed ne cursus augue hasellus lacinia sapien
                        vitae.</p>
                    <ul class="social-icons">
                        <li><a rel="nofollow" href="https://fb.com/templatemo" target="_blank"><i
                                    class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-item">
                    <h4>Useful Links</h4>
                    <ul class="menu-list">
                        <li><a href="#">Vivamus ut tellus mi</a></li>
                        <li><a href="#">Nulla nec cursus elit</a></li>
                        <li><a href="#">Vulputate sed nec</a></li>
                        <li><a href="#">Cursus augue hasellus</a></li>
                        <li><a href="#">Lacinia ac sapien</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-item">
                    <h4>Additional Pages</h4>
                    <ul class="menu-list">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">How We Work</a></li>
                        <li><a href="#">Quick Support</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-item last-item">
                    <h4>Contact Us</h4>
                    <div class="contact-form">
                        <form id="contact footer-contact" action="" method="post">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="name" type="text" class="form-control" id="name"
                                            placeholder="Full Name" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="email" type="text" class="form-control" id="email"
                                            pattern="[^ @]*@[^ @]*" placeholder="E-Mail Address" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="message" rows="6" class="form-control" id="message"
                                            placeholder="Your Message" required=""></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="filled-button">Send
                                            Message</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Copyright &copy; 2023 ELECTRICITY CALCULATOR.

                        - Design: <a rel="nofollow noopener" href="https://github.com/MatthewAlexanderA"
                            target="_blank">ForrstCode</a></p>
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

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/owl.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/accordions.js') }}"></script>

</body>

</html>
