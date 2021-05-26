@extends('layouts._layout')

@section('content')
@php $title = 'Home'; @endphp
<div class="mt-5">
    .
</div>
<h1 class="m-5"></h1>

<div class="card m-5">
    <div class="card-body">
        <div class=" d-flex">
            <h4 class="card-title">Upload Records</h4>
            <h4 class="msgDisplay ml-auto border rounded shadow bg-light font-weight-bold d-none"></h4>
        </div>
        <div class="card-text border rounded p-1 d-flex">
            <div class="">
                
                <input type="file" name="userEx" class="file rounded" id="insert">
                <button type="button" class="btn btn-sm rounded blue-gradient-rgba text-light font-weight-bold" onclick="uploadFile('insert');"> Insert Data </button>
            </div>  
            <div class="  ml-auto">
                {{-- <form action="{{ route('import')}}" enctype="multipart/form-data" method="post"> --}}
                {{-- {{ csrf_field() }} --}}
                <input type="file" name="userEx" id="update" class=" rounded" >
                <button onclick="uploadFile('update');"  class="btn btn-sm blue-gradient-rgba text-light rounded font-weight-bold"> Update Data </button>
                {{-- </form>      --}}
       </div>
           
            </div><hr>  
           <div class=" border d-flex rounded">
            <div class="p-2 ">
                Export User Records: <a href="{{ route("export")}}" target="" class="btn btn-sm rounded btn-blue-grey" rel="noopener noreferrer">DownLoad data</a>
            </div>
            <div class=" ml-auto d-flex flex-column justify-content-center  w-25">
                <input type="text" name="search" class=" w-100 rounded" placeholder="Search by Employee Number" id="search" onkeyup="search();">            
            </div>
           </div>
   <div class=" py-2 border border-success shadow mb-5 rounded d-none search_table">
<table class="table table-striped table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr class="grey text-light">
            <th>Employee Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Position</th>
            <th>Start Date</th>
            <th>Department</th>
            <th>Annual Salary</th>
            <th>Manager Employee Number</th>
            <th>Project Code 1</th>
            <th>Project Code 2</th>
            <th>Project Code 3</th>
        </tr>
        </tr>
        </thead>
        <tbody id="search_table">
            
        </tbody>
</table>
   </div>

        
        <hr>
        <div class="border">
                <table class="table table-striped  table-responsive">
                    <thead class=" ">
                        <tr class="bg-dark text-light">
                            <th>Employee Number</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th>Position</th>
                            <th>Start Date</th>
                            <th>Department</th>
                            <th>Annual Salary</th>
                            <th>Manager Employee Number</th>
                            <th>Project Code 1</th>
                            <th>Project Code 2</th>
                            <th>Project Code 3</th>
                        </tr>
                        </thead>
                        <tbody id="display_table">
                     
                        </tbody>
                </table>
        </div>
    </div>
</div>

<script>
        function element(element) {   return document.createElement(element);     }  

        function createTable(user, search_table) {
            let tr = element("tr");
                        var empnum = element("td"); empnum.innerHTML = user.employee_number; tr.appendChild(empnum);
                        var fname = element("td"); fname.innerHTML = user.first_name;  tr.appendChild(fname);
                        var lname = element("td"); lname.innerHTML = user.last_name;  tr.appendChild(lname);
                        var dob = element("td");     dob.innerHTML = user.dob;  tr.appendChild(dob);
                        var position = element("td"); position.innerHTML = user.position;  tr.appendChild(position);
                        var sdate = element("td"); sdate.innerHTML = user.start_date;  tr.appendChild(sdate);
                        var dep = element("td"); dep.innerHTML = user.department;  tr.appendChild(dep);
                        var annsal = element("td"); annsal.innerHTML = user.annual_salary;  tr.appendChild(annsal);
                        var men = element("td"); men.innerHTML = user.manager_employee_number;  tr.appendChild(men);
                        var p1 = element("td");  p1.innerHTML = user.project_c1;  tr.appendChild(p1);
                        var p2 = element("td"); p2.innerHTML = user.project_c2;  tr.appendChild(p2);
                        var p3 = element("td"); p3.innerHTML = user.project_c1;  tr.appendChild(p3);                      
                            search_table.appendChild(tr);
        }      

    async function getRecords(id) {
        let search_table = document.getElementById("search_table");  
        search_table.innerHTML = "";   if (id.length >= 3) {  search_table.innerHTML = ""; } 
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/get/records/'+id)
                    console.log(response.data);

                    response.data.forEach(user => {
                        createTable(user, search_table) 
                    });
        } catch (error) {
            console.log(error);

        }
    }

    function search(){
        let el = document.getElementById("search").value;
        let search_table = document.querySelector(".search_table");

        if (el.length >= 3) {
            search_table.classList.remove("d-none");
            getRecords(el);
        }else{
            search_table.classList.add("d-none");
           document.getElementById("search_table").innerHTML = "";   
        }
    }

   async function displayData() {
        let display_table = document.getElementById("display_table");

        try {
            const data = await axios.get('http://127.0.0.1:8000/api/get/records')
                data.data.forEach(user => {
                        createTable(user, display_table) 
                    });
        } catch (error) {
            console.log(error);
        }
    }
    displayData();

    async function uploadFile(post_type) {
        let url = "";       
        let msgDisplay = document.querySelector(".msgDisplay")
        let display_table = document.getElementById("display_table");
            msgDisplay.innerHTML = "";
            msgDisplay.classList.remove('d-none');
       
        if (post_type == "insert") {
            url = 'http://127.0.0.1:8000/api/upload/records';
        } else if(post_type == "update") {
            url = 'http://127.0.0.1:8000/api/update/records';
        }else{
            msgDisplay.innerHTML = "Unknown Error!!!";
            return false; 
        }
        let file = document.getElementById(post_type).files[0];
        if (file == null) {
            msgDisplay.innerHTML = "No File selected";
            return false;         
        }
        msgDisplay.innerHTML = "Uploading Data!!! Please wait...";
        const token = "uhefcoi734-c9234yugrc0y243u94tp9m8xcwr4htmc45hc2";
         
        const formData = new FormData();
              formData.append('token', token);
              formData.append('userEx', file);

            try {
                const response = await axios.post(url, formData,
                {headers:{'Content-Type': 'multipart/form-data'}} );
                if (response.data == "success") {
                    msgDisplay.innerHTML = "Your data record uploaded successfully";
                } else {
                    msgDisplay.innerHTML = response.data;
                }
                const data = await axios.get('http://127.0.0.1:8000/api/get/records')
                display_table.innerHTML ="";
                data.data.forEach(user => {
                        createTable(user, display_table) 
                    });
                              
            } catch (error) {
                console.log(error);
                msgDisplay.innerHTML = "Something went wrong, or maybe your data is dublicated. Please try again...";
                    setTimeout(() => {
                        window.location.reload();
                    }, 5000);
            }
            setTimeout(() => {
                msgDisplay.innerHTML = "";
                file.value = null;
            }, 5000);

    }
</script>
    
  @endsection

