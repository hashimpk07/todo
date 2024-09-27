@extends('dashboard')
@section('content')

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('todo'); }}'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Update  To Do App </h5>
</div>

<form action="javascript:void(0)" id="todoForm" name="todoForm-edit"  method="post">
   
    <div class="card-body">
    <input type="hidden" name="id" class="form-control" id="id" value="{{$todo->id}}">
        <div class="form-group">
            <label for="name"> Name <span style="color:#ff0000">*</span></label>
                <input type="text" name="name" class="form-control" id="name"  value="{{$todo->title}}" placeholder="Enter To Do Name ">
            <div class="error" id="nameErr"></div>
        </div>

        <div class="form-group">
            <label for="dueDate"> Due Date <span style="color:#ff0000">*</span></label>
            <div class="input-group">
                        <input type="date" class="form-control" id="dueDate" name="dueDate" value="{{$todo->due_date}}" >
                    </div>
            <div class="error" id="dueDateErr"></div>
        </div>

        <div class="form-group">
            <label for="Status"> Status <span style="color:#ff0000">*</span></label>
            <select class="form-control" id="status" name="status"> 
                <option {{ ( $todo->status) == 'pending' ? 'selected' : '' }}  value="1">Pending</option>
                <option {{ ( $todo->status) == 'completed' ? 'selected' : '' }}   value="2"> Completed</option>
                
            </select>
            <div class="error" id="statusErr"></div>
        </div>

        <div class="form-group">
            <label for="name"> Description </label>
            <textarea  type="textarea" name="description" class="form-control" id="description" placeholder="Description"  rows="4" cols="50">{{$todo->description}}</textarea>
        </div>
        <div class="error" id="todoErr"></div>
        
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="todoForm-edit btn btn-submit btn-primary" id="todoForm-edit">Save</button>
    </div>
</form>
                                          
<div style="display: none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading">To Do Update Successfully</h2>
    </div>
</div> 
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">  
        $( function() {     
            $('#todo').on('input', function() {
                $('#todoErr').hide();
            });
        });

        $(document).on('click', '.todoForm-edit', function (e) {
        
        $('#name').on('input', function() {
            $('#nameErr').hide();
            $('#dueDateErr').hide();
            $('#statusErr').hide();
        });
        $('#status').change(function(e) {
            var status = $(this,':selected').val();
            if( 0 != status ){
                $('#statusErr').hide();
            }else{
                $('#statusErr').show();
            }

        });
       
        var todoFlag    = 0;
        var id          = $("#id").val();
        var name        = $("#name").val();
        var dueDate     = $("#dueDate").val();
        var status      = $("#status option:selected").val();
        var description = $("#description").val();
        if(name == "") {
            $("#nameErr").html("Please Enter name");
            todoFlag = 1;
        }
        if(dueDate == "") {
            $("#dueDateErr").html("Please Enter Due Date");
            todoFlag = 1;
        }

        if( 0 == status || "" == status ){
            $("#statusErr").html("Please Select Status ");
            todoFlag = 1;
        }
        if( 1 == todoFlag ){
            return false;
        }else{
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:"{{ route('todo.update') }}",
                type: "POST",
                dataType: "json",
                data:{ 
                    id : id,
                    name:name,
                    dueDate :dueDate,
                    status : status,
                    description :description,
                },
                success:function(data){
                    if( data.status == 'success' ){
                        $(".pop-outer").fadeIn("slow");
                        setTimeout(function () {
                            window.location = '{{ route('todo') }}'
                        }, 2500);
                    }else{
                        $("#todoErr").html("Data Not Saved ! Please check Data");
                    }
                    
                },
                error: function(response) {
                    
                }
                 
            });
        }
    });
       

</script>
@endsection