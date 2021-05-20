<!DOCTYPE html>
<html lang="en">
<head>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta property="og:locale" content="en_US">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', '') }} | {{ $title ?? '' }} </title>
  @include('inc.css')

</head>

<body class="" >

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white scrolling-navbar shadow-none m-0 border-bottom" id="navbar-scroll">
      <div class="container  w-100 m-0 p-0">

        <!-- Brand -->
        <a class="navbar-brand m-0 p-0  pl-0" href="/" >
Company Logo        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item  rounded">
              <a class="nav-link" href="/">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="/pg/pricing " >Pricing</a>
            </li>
            <li class="nav-item mr-5">
              <a class="nav-link" href="/pg/about" >About</a>
            </li>
           
            {{--  --}}
            @if (Route::has('login'))
            @auth

              <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin') }}">Admin</a>
            </li>

            @else
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">
                    <i class="fas fa-user mr-2"></i>Login</a>
                  </li>

                @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link " href="{{ route('register') }}">
                    <i class="fas fa-user mr-2"></i>Register</a>
                  </li>
                @endif
            @endauth
            @endif

            {{--  --}}

          </ul>

        </div>

      </div>
    </nav>

    <main class="m-0 p-0">

        @yield('content')

    </main>

        <footer class="page-footer font-small stylish-color-dark  px-0 pt-4 d-none">
          <div class="footer-copyright text-center py-3"> 
            &copy; @php echo date("Y"); @endphp Copyright:
            <a href="#"> A Madiba </a> &nbsp; All rights reserved.
          </div>
        </footer>
    {{-- FOOTER  --}}

          <!-- SCRIPTS -->
          @include('inc.js')
           <script>

var name = document.getElementById("subscribename");
new Vue({
    el: '#subscribe',
    data: {
        name: '',
        email: ''
    },
    methods: {
      addemail: function(){
        var email = document.getElementById("subscribemail").value;
        var identity = document.getElementById("identity").value;

            axios.post('http://127.0.0.1:8000/api/subscribe', {  // url where you post to
              email: email,
              identity: identity
            }).then(function (response) {            // function that return's the success responce
            if(response.request.response = email){
             // alert(response.request.response);
                    this.email = email;
                    var addnames = document.getElementById("addnames");   // Create a <button> element
                    var revmail = document.getElementById("revmail");
                      revmail.classList = " d-none";
                      addnames.classList = "input-group mb-3";
                      var addmails = document.getElementById("addmails");                 // Insert text
                      addmails.appendChild(addnames);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        ////////////////////////////////////////////////////////////////////////
        addname: function(){
          var name = document.getElementById("subscribename").value;
            axios.post('http://127.0.0.1:8000/api/subscribers', {  // url where you post to
              name: name,                    /// data that you post to the database
              email: email
            })
            .then(function (response) {
              var msg = document.getElementById("msg");
              var addnames = document.getElementById("addnames");
              var addmails = document.getElementById("addmails");
                  addnames.classList = "d-none";
                  addmails.appendChild(msg);

            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
});

        </script>
        </body>

        </html>
