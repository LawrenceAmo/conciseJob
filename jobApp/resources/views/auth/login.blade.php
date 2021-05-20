@extends('layouts._layout')

@section('content')
@php $title = 'Home'; @endphp
<div class="mt-5">
    .
</div>
<h1 class="m-5"></h1>

<div class=" d-flex justify-content-center">
    <div class="card m-5 w-50 mx-lg-5">
        <div class="card-body px-lg-5">
            <h4 class="card-title">Log in to your Account</h4>
            <div class="card-text ">
              
                <div class="msgDisplay text-danger"></div>    
                <div class="form-group mt-3">
                  <div class="form-group">
                    <label for="">E-mail</label>
                    <input type="email" class="form-control" name="" id="email" aria-describedby="helpId" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" class="form-control" name="" id="password" aria-describedby="helpId" placeholder="">
                  </div>
     
                <button type="button" class="btn btn-sm rounded font-weight-bold" onclick="login();"> Log In </button>
                </div>
        </div>
    </div>
</div>

<script>

    async function login() {

        let msgDisplay = document.querySelector(".msgDisplay")
        let msg = "";   msgDisplay.innerHTML = "";       
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;

        // check if input is empty
        function validate(input, err) {
            if (input === "") {
                return err+"<br>";
            }   return "";
        }

        msg += validate(email, "Please enter your Email");
        msg += validate(password, "Please enter Password");
        
        msgDisplay.innerHTML = msg;  // display all available errors to the user

        if (msg != "") {    return false;   }         
                 
        const formData = new FormData();
              formData.append('email', email);
              formData.append('password', password);

            try {
                const response = await axios.post('http://127.0.0.1:8000/api/login',formData)
                    console.log(response.data);
                    
                    if (response.data.includes("ERROR")) {
                        msgDisplay.innerHTML = response.data; 
                    } else {
                        msgDisplay.innerHTML = response.data;
                    }
            } catch (error) {
                console.log(error);
            }

    }
</script>
    
  @endsection

