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
    a.disabled {
      pointer-events: none;
      cursor: default;
    }
</style>
@section('content')
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
                        <h3>STUDENTS LISTS</h3>
                            <tr>
                                <th>ID</th>
                                <th>Student name</th>
                                <th>Message</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                            @if($message)
                             @foreach($message as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->student_name }}</td>
                                    <td>{{ $data->message }}</td>
                                    <td class="text-center row">
                                    <div class="col-6">
                                   @if($data->status == 1)
                                    <a class='btn btn-success btn-xs disabled'>Allready Replied</a> </div>
                                   @else
                                    <a class='btn btn-warning btn-xs sendmsg' data-name='{{ $data->student_name }}' data-studid='{{ $data->student_id }}' data-id={{ $data->id }}><span class="glyphicon glyphicon-edit"></span>Send Reply</a> </div>
                                    @endif
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
<div class="modal fade" id="replymodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="lineModalLabel">Reply to <span id="stud"></span></h3>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            
        </div>
        <div class="modal-body">
            
            <!-- content goes here -->
            {{-- <form action="{{ route('message.store') }}" method="POST">
                @csrf --}}
                <form action="{{ route('message.update', 'reply') }}" method="POST">
                @csrf
                @method('PUT')
              <div class="form-group">
                <label for="message">Enter Message</label>
                <input type="text" class="form-control" name="message" id="message" placeholder="Enter message" required>
              </div>
              <input type="hidden" id="stud_id" name="stud_id">
              <input type="hidden" id="user_id" name="user_id" value={{ Auth::user()->id }}>
              <input type="hidden" id="msg_id" name="msg_id">

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
        var id=$(this).data('studid');
        var msgid=$(this).data('id');
        var name=$(this).data('name');
        $('#stud').text(name)
        $('#stud_id').val(id)
        $('#msg_id').val(msgid)
        $('#replymodal').modal('show')
    });

</script>
@endsection