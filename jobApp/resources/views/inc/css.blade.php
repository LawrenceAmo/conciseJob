{{-- Vue Development mode --}}
 <script async src="{{ asset('js/vue.js') }}"></script> 
 <script async src="{{ asset('js/qrcode.min.js') }}"></script> <!-- QR Code. it makes the code for scanning -->
{{-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> --}}

{{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather:400,700|Montserrat:300,400,500"> --}}

<!-- //////////////////// text editer (ckeditor) -->
{{-- <script  src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script> --}}
<script async src="{{ asset('js/ckeditor5-build-classic/ckeditor.js') }}"></script>


<!-- //////////////////// loading google charts -->
{{-- <script  type="text/javascript" src="https://www.gstatic.com/charts/loader.js" ></script> --}}

{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"> --}}
<link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">

{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="{{ asset('mdb/css/bootstrap.min.css') }}">

{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="{{ asset('mdb/css/mdb.css') }}">

 <!-- JQuery -->
 {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
 <script async src="{{ asset('js/jquery.min.js') }}"></script>

{{-- ////////////////////////   ./ axios --}}
{{-- <script defer async src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
<script async src="{{ asset('js/axios/axios.min.js') }}"></script>

<!-- My custom styles -->
<link href="{{ asset('css/style.min.css') }}" rel="stylesheet">

 <link href="{{ asset('css/dark.min.css') }}" rel="stylesheet">
  {{-- my custom js --}}
  <script async src="{{ asset('js/custom.js') }}"></script> 
