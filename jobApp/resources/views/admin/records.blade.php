@extends('layouts._layout')

@section('content')
@php $title = 'Home'; @endphp
<div class="mt-5">
    .
</div>
<h1 class="m-5"></h1>

<div class="card m-5">
    <div class="card-body">
        <h4 class="card-title">Upload Records</h4>
        <div class="card-text border rounded p-1 d-flex">
            <div class="">
                <div class="msgDisplay"></div>
                <input type="file" name="userEx" class="file rounded" id="file">
                <button type="button" class="btn btn-sm rounded font-weight-bold" onclick="uploadFile();"> Upload </button>
            </div>  
            <div class=" ml-auto d-flex flex-column justify-content-center  w-25">
                <input type="text" name="search" class=" w-100 rounded" placeholder="Search by Employee Number" id="search" onkeyup="search();">            
            </div>
            </div><hr> 

        <div class=" d-none">
            <form action="{{ route('import')}}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <input type="file" name="userEx" class=" rounded" >
            <button type="submit" class="btn btn-sm rounded font-weight-bold"> Import Data </button>
            </form>     
   </div>

   <div class=" py-2 border mb-5 rounded d-none search_table">
<table class="table table-striped table-inverse table-responsive">
    <thead class="thead-inverse">
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
        </tr>
        </thead>
        <tbody id="search_table">
            
        </tbody>
</table>
   </div>

        <div class="p-2">
            Export User Records: <a href="{{ route("export")}}" target="" class="btn btn-sm rounded btn-blue-grey" rel="noopener noreferrer">DownLoad data</a>
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
                        <tbody>
                            @for ($i = 0; $i < count($users); $i++)                        
                            {{-- @php $hd=""; if ($i < 1) { $hd = "bg-dark text-light"; }  @endphp --}}

                            <tr class="">
                                <td>{{$users[$i]->employee_number}}</td>
                                <td>{{$users[$i]->first_name}}</td>
                                <td>{{$users[$i]->last_name}}</td>
                                <td>{{$users[$i]->dob}}</td>
                                <td>{{$users[$i]->position}}</td>
                                <td>{{$users[$i]->start_date}}</td>
                                <td>{{$users[$i]->department}}</td>
                                <td>R{{number_format($users[$i]->annual_salary)}}</td>
                                <td>{{$users[$i]->manager_employee_number}}</td>
                                <td>{{$users[$i]->project_c1}}</td>
                                <td>{{$users[$i]->ptoject_c2}}</td>
                                <td>{{$users[$i]->project_c3}}</td>

                            </tr>
                            @endfor
                        </tbody>
                </table>
        </div>
    </div>
</div>

<script>

    async function getRecords(id) {
        function element(element) {   return document.createElement(element);     }        
        let search_table = document.getElementById("search_table");  
        search_table.innerHTML = "";   if (id.length >= 3) {  search_table.innerHTML = ""; } 
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/get/records/'+id)
                    console.log(response.data);

                    response.data.forEach(user => {
                        let tr = element("tr");
                        var empnum = element("td"); empnum.innerHTML = user.employee_number; tr.appendChild(empnum);
                        var fname = element("td"); fname.innerHTML = user.first_name;  tr.appendChild(fname);
                        var lname = element("td"); lname.innerHTML = user.last_name;  tr.appendChild(lname);
                        var dob = element("td");     dob.innerHTML = user.dob;  tr.appendChild(dob);
                        var position = element("td"); position.innerHTML = user.position;  tr.appendChild(position);
                        var sdate = element("td"); sdate.innerHTML = user.start_date;  tr.appendChild(sdate);
                        var dep = element("td"); dep.innerHTML = user.department;  tr.appendChild(dep);
                        var annsal = element("td"); annsal.innerHTML = "R"+user.annual_salary;  tr.appendChild(annsal);
                        var men = element("td"); men.innerHTML = user.manager_employee_number;  tr.appendChild(men);
                        var p1 = element("td");  p1.innerHTML = user.project_c1;  tr.appendChild(p1);
                        var p2 = element("td"); p2.innerHTML = user.project_c2;  tr.appendChild(p2);
                        var p3 = element("td"); p3.innerHTML = user.project_c1;  tr.appendChild(p3);                      
                            search_table.appendChild(tr);
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
    async function uploadFile() {

        let msgDisplay = document.querySelector(".msgDisplay")
            msgDisplay.innerHTML = "";
        let file = document.getElementById("file").files[0];
        if (file == null) {
            msgDisplay.innerHTML = "No File selected";
            return false;         
        }
        const token = "uhefcoi734-c9234yugrc0y243u94tp9m8xcwr4htmc45hc2";
         
        const formData = new FormData();
              formData.append('token', token);
              formData.append('userEx', file);

            try {
                const response = await axios.post('http://127.0.0.1:8000/api/upload/records',formData,
                {headers:{'Content-Type': 'multipart/form-data'}} );
                if (response.data == "success") {
                    msgDisplay.innerHTML = "Your data record uploaded successfully";
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    
                }
               
            } catch (error) {
                console.log(error);
            }

    }
</script>
    
  @endsection

