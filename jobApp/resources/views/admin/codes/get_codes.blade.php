@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Title</h4>
        <p class="card-text">
            <div class="">
               Total course coupon codes available:  {{count($all_codes)}}
            </div>
            <div class="">
                <a href="#" onclick="generate_code();" class="btn btn-sm rounded blue-gradient-rgba">Generate Code</a>
           </div> <br>
           <div class="">
            <a href="#" onclick="get_dublicated_codes();" class="btn btn-sm rounded blue-gradient-rgba">get dublicated Code</a>
       </div> <br>
       <div class="">
        <a href="#" onclick="get_codes();" class="btn btn-sm rounded blue-gradient-rgba">get Codes</a>
   </div> <br>
            <div class=" " style="column-fill: balance;">
                <span id="codes_display" class="text-uppercase px-3 font-weight-bold" style="column-fill: auto;">
                    
                </span>   
            </div>
        </p>
    </div>
</div>
<script>

async function get_codes(){
        let codes_display = document.getElementById("codes_display");
        codes_display.innerHTML = "<i>Loading Content</i>";
        try {
            const response = await axios.get('/api/admin/course/get/codes');
            let codes = response.data;  codes_display.innerHTML = null;

            for (let i = 0; i < codes.length; i++) {
                let span = document.createElement("span");
                    span.className = 'px-3 border-right border-danger';
                    span.innerHTML = codes[i]; 
                    codes_display.appendChild(span);       
            }
        } catch (error) {
            console.log(error);
        }
} 

async function generate_code(){
try {
    const response = await axios.get('/api/admin/generate/code');
    console.log(response.data);
} catch (error) {
    console.log(error);
}
}

async function get_dublicated_codes(){
try {
    const response = await axios.get('/api/admin/dublicated/code');
    if (response.data == false) {
        console.log("No Dublicated Codes");
    } else {
        console.log(response.data);
    }
} catch (error) {
    console.log(error);
}
}
</script>
@endsection



{{-- 
    &nbsp; <span class="red-text">|</span> &nbsp;
 --}}