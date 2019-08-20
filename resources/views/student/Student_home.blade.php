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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Student Dashboard</div>

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
                                    <a class='btn btn-warning btn-xs sendmsg' data-name='{{ $data->name }}' data-id='{{ $data->id }}'><span class="glyphicon glyphicon-edit"></span> Send Message</a> </div>
                                   </td>
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

<!-- line modal -->
<div class="modal fade" id="messagesendmodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="lineModalLabel">Send Message to <span id="tech"></span></h3>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            
        </div>
        <div class="modal-body">
            
            <!-- content goes here -->
            <form action="{{ route('message.store') }}" method="POST">
                @csrf
              <div class="form-group">
                <label for="message">Enter Message</label>
                <input type="text" class="form-control" name="message" id="message" placeholder="Enter message" required>
              </div>
              <input type="hidden" id="stud_id" name="stud_id" value={{ Auth::user()->id }}>
              <input type="hidden" id="tech_id" name="tech_id">

              <button type="submit" class="btn btn-default">Send</button>
            </form>

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
  
$(document).on('click', '.sendmsg', function(event) {
    event.preventDefault();
    var id=$(this).data('id');
    var name=$(this).data('name');
    $('#tech').text(name)
    $('#tech_id').val(id)
    $('#messagesendmodal').modal('show')
});

</script>
@endsection