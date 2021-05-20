@extends('layouts._layout')

@section('content')
@php $title = 'Home'; @endphp
<div class="mt-5">
    .
</div>
<h1 class="m-5"></h1>

<div class="card m-5">
    <div class="card-body">
        <h4 class="card-title">Register New Account</h4>
        <div class="card-text w-25 ">
          
            <div class="msgDisplay"></div>

            <div class="form-group">
                <label for="">First Name</label>
                <input type="text" class="form-control" name="" id="first_name" aria-describedby="helpId" placeholder="">
              </div>
              <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" class="form-control" name="" id="last_name" aria-describedby="helpId" placeholder="">
              </div>
              <div class="form-group">
                <label for="">E-mail</label>
                <input type="email" class="form-control" name="" id="email" aria-describedby="helpId" placeholder="">
              </div>
              <div class="form-group">
                <label for="">Password</label>
                <input type="text" class="form-control" name="" id="password" aria-describedby="helpId" placeholder="">
              </div>
              <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="text" class="form-control" name="" id="confirm_password" aria-describedby="helpId" placeholder="">
              </div>

              <label for=""> Are you an Admin?:</label> <br>
              <div class="input-group">                 
                <label class="input-group-addon" onclick="role('no')">
                    <input type="radio" name="role" id="admin_no" aria-label="" class="active" aria-selected="true"> No
                  </label>
                  <label class="input-group-addon mx-5" onclick="role('yes')">
                    <input type="radio" name="role" id="admin_yes" aria-label=""> Yes
                  </label>
              </div> <br>
              <div class="d-none" id="role_admin">
                <div class="form-group">
                    <label for="">Enter Admin Code</label>
                    <input type="text" class="form-control" name="" id="admin_code" aria-describedby="helpId" placeholder="">
                  </div>
              </div>
 
            <button type="button" class="btn btn-sm rounded font-weight-bold" onclick="register();"> Register Account </button>
            </div>
    </div>
</div>

<script>

function role(role) {
    let role_admin = document.getElementById("role_admin");
    let admin_code = document.getElementById("admin_code");
    if (role == 'yes') {
        role_admin.classList.remove("d-none");
        admin_code.setAttribute("required",true);
    } if (role == 'no') {
        role_admin.classList.add("d-none");
        admin_code.setAttribute("required",false);
    }
}

    async function register() {

        let msgDisplay = document.querySelector(".msgDisplay")
        let msg = "";   msgDisplay.innerHTML = "";       
        let first_name = document.getElementById("first_name").value;
        let last_name = document.getElementById("last_name").value;
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let confirm_password = document.getElementById("confirm_password").value;
        let role_admin = document.getElementById("role_admin");
        let role = 0; let admin_code = "";

        // check if input is empty
        function validate(input, err) {
            if (input === "") {
                return err+"<br>";
            }   return "";
        }

        msg += validate(first_name, "Please enter your First Name");
        msg += validate(last_name, "Please enter your Last Name");
        msg += validate(email, "Please enter your Email");
        msg += validate(password, "Please enter Password");
        msg += validate(confirm_password, "Please confirm password");

        if (password != confirm_password) {  msg += "Password not match";  }

        // check the role of the user
        if (!role_admin.classList.contains("d-none")) {
             admin_code = document.getElementById("admin_code").value;
                msg += validate(admin_code, "Please enter your Admin Code!!!");
                role = 1;
        }else{
            admin_code = "";
            role = 2;
        }
        
        msgDisplay.innerHTML = msg;  // display all available errors to the user

        if (msg != "") {    return false;   }         
                 
        const formData = new FormData();
              formData.append('role', role);
              formData.append('first_name', first_name);
              formData.append('last_name', last_name);
              formData.append('email', email);
              formData.append('password', password);
              formData.append('admin_code', admin_code);

            try {
                const response = await axios.post('http://127.0.0.1:8000/api/register',formData)
                    console.log(response);
            } catch (error) {
                console.log(error);
            }

    }
</script>
    
  @endsection

