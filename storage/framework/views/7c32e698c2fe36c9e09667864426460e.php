
<?php $__env->startSection('content'); ?>

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('todo')); ?>'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  New  To Do App </h5>
</div>

<form action="javascript:void(0)" id="todoForm" name="todoForm-add"  method="post">
   
    <div class="card-body">
        <div class="form-group">
            <label for="name"> Name <span style="color:#ff0000">*</span></label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter To Do Name ">
            <div class="error" id="nameErr"></div>
        </div>

        <div class="form-group">
            <label for="dueDate"> Due Date <span style="color:#ff0000">*</span></label>
            <div class="input-group">
                        <input type="date" class="form-control" id="dueDate" name="dueDate">
                    </div>
            <div class="error" id="dueDateErr"></div>
        </div>

        <div class="form-group">
            <label for="Status"> Status <span style="color:#ff0000">*</span></label>
            <select class="form-control" id="status" name="status"> 
                <option value="1">Pending</option>
                <option value="2"> Completed</option>
                
            </select>
            <div class="error" id="statusErr"></div>
        </div>

        <div class="form-group">
            <label for="name"> Description </label>
            <textarea  type="textarea" name="description" class="form-control" id="description" placeholder="Description"  rows="4" cols="50"></textarea>
        </div>
        <div class="error" id="todoErr"></div>
        
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="todoForm-add btn btn-submit btn-primary" id="todoForm-add">Save</button>
    </div>
</form>
                                          
<div style="display: none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading">To Do Added Successfully</h2>
    </div>
</div> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">  
        $( function() {     
            $('#todo').on('input', function() {
                $('#todoErr').hide();
            });
        });

        $(document).on('click', '.todoForm-add', function (e) {
        
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
                url:"<?php echo e(route('todo.create')); ?>",
                type: "POST",
                dataType: "json",
                data:{ 
                    name:name,
                    dueDate :dueDate,
                    status : status,
                    description :description,
                },
                success:function(data){
                    if( data.status == 'success' ){
                        $(".pop-outer").fadeIn("slow");
                        setTimeout(function () {
                            window.location = '<?php echo e(route('todo')); ?>'
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\todo-app\resources\views/todo/todo-add.blade.php ENDPATH**/ ?>