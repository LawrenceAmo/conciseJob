@extends('layouts.app')

@section('content')

{{-- {{$student}} --}}
{{-- <h1>{{$student[0]->fname}}  {{$student[0]->lname}}  --}}
    <h1>
    @for ($i = 0; $i < count($student); $i++)
    {{$student[$i]->fname}} {{$student[$i]->lname}}
    @endfor    
    Hi</h1> 
{{-- <img src="http://3.bp.blogspot.com/-rKXU7l5InCM/T32MCcIg7KI/AAAAAAAAByc/pAfbBtkc5NA/s1600/Water+Splash+Wallpapers+1.jpg" width="200" alt="imgPic"> <br> --}}
{{-- {{$avater = Auth::user()->avater }}  <br> --}} <br>
{{-- <img src="/home/ubuntu/Documents/projects/effectivewing/public/storage/images/" alt="avater" />  --}}
<br>
<img src="{{ asset('storage/images/'. Auth::user()->avater) }}" class="rounded img-thumbnail" width="200" alt="test img">
<br>
{{-- <pre>
{{print_r($student)}}
</pre> --}}
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col"><svg class="bi bi-hash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>
          </svg></th>
        <th scope="col">First Name</th>
        <th scope="col">last Name</th>
        <th scope="col">Email</th>
        <th scope="col">Password</th>
      </tr>
    </thead>
    <tbody>
        
@foreach ($student as $user)
<tr>
        <th scope="row">1</th>
        <th>{{$user->fname}}</th>
        <td>{{$user->lname}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->password}}</td>
</tr>
@endforeach
</tbody>
</table>



@endsection