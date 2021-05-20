@extends('layouts.admin')

@section('content')

      <link href="{{ asset('css/fileUpload/style.css') }}" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="{{ asset('css/fileUpload/code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') }}">
   
      <div class="container" >
          <input type="file" name="image" id="file">

          <!-- Drag and Drop container-->
          <div class="upload-area"  id="uploadfile">
              <h1>Drag and Drop file here<br/>Or<br/>Click to select file</h1>
          </div>
      </div>
      <script src="{{ asset('js/fileUpload/jquery.min.js') }}" type="text/javascript"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script src="{{ asset('js/fileUpload/script.js') }}" type="text/javascript"></script>
   

@endsection