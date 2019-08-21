@extends('layouts.app')
@section('style')
<style type="text/css" media="screen">
.custab{
    border: 1px solid #ccc;
    padding: 5px;
    margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
.custab:hover{
    box-shadow: 3px 3px 0px transparent;
    transition: 0.5s;
    }
    .text-ri{
            right: 0;
    position: absolute;
    }    
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" id="alertmsg" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                   <div class="container">
                        <div class="row col-md-12 col-md-offset-2 custyle">

                        <table class="table table-striped custab">
                        <thead>
                        <h3>TEACHERS LISTS</h3>
                         <a href="{{ route('admin.create') }}" class="btn btn-primary btn-xs pull-right text-ri"><b>+</b>Register Teacher</a>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Dapartment</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                            @if($teach)
                             @foreach($teach as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->department }}</td>
                                    <td class="text-center row">
                                    <div class="col-6">
                                    <a class='btn btn-info btn-xs' href={{ url('admin/'.$data->id.'/edit') }}><span class="glyphicon glyphicon-edit"></span> Edit</a> </div>
                                     <div class="col-2">   
                                        <form action="{{ route('admin.destroy',$data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs delt-teacher">Delete</button>
                                        </form>
                                    </div>
                                    </td>
                                </tr>
                              @endforeach
                            @endif     
                        </table>
                        </div>
                    </div>

                     <div class="container">
                        <div class="row col-md-12 col-md-offset-2 custyle">

                        <table class="table table-striped custab">
                        <thead>
                        <h3>STUDENT LISTS</h3>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Std</th>
                                <th>Age</th>
                            </tr>
                        </thead>
                           @if($stud)  
                             @foreach($stud as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->std }}</td>
                                    <td>{{ $data->age }}</td>
                                    
                                </tr>
                              @endforeach
                           @endif      
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script type="text/javascript" charset="utf-8" async defer>
     $("#alertmsg").fadeTo(2000, 500).slideUp(500, function() {
      $("#alertmsg").slideUp(500);
    });
  

</script>
@endsection