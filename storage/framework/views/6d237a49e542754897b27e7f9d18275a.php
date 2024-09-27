
<?php $__env->startSection('content'); ?>

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('todo')); ?>'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  To Da Add Share Page</h5>
</div>

<form action="javascript:void(0)" id="shareForm" name="shareForm-add"  method="post">

    <input type="hidden" name="id" class="form-control" id="id" value="<?php echo e($id); ?>">
    <div class="card-body">
        <div class="form-group">
            <label for="usershare">  Name  <span style="color:#ff0000">*</span></label>
            <div class="form-group">
                <select class="selectpicker" multiple data-live-search="true" name="usershare[]" id="usershare" style="width: 100% !important;">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>" <?php echo e((  in_array($user->id, $shareArray) )  ? 'selected' : ''); ?>> <?php echo e($user->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>       
                </select>
                <div class="error" id="usershareErr"></div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="shareForm-add btn btn-submit btn-primary" id="shareForm-add">Save</button>
    </div>
</form>
                                          
<div style="display: none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading">share Added Successfully</h2>
    </div>
</div> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">  
      
        $("#shareForm").submit(function(e) {
            e.preventDefault();
         
            var shareFlag    = 0;
            var id    = $("#id").val();
            var users = $('#usershare > option:selected');
           
            if(users.length == 0){
                $("#usershareErr").html("Please Select Atleast One User ");
                shareFlag = 1;
            }
            if( 1 == shareFlag ){
                return false;
            }else{
                formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url:"<?php echo e(route('todo.share.create')); ?>",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success:function(data){
                        if( data.status == 'success' ){
                            $(".pop-outer").fadeIn("slow");
                            setTimeout(function () {
                                window.location = '<?php echo e(route('todo')); ?>'
                            }, 2500);
                        }else{
                            $("#usershareErr").html("Data Not Saved ! Please check Data");
                        }
                    
                    },
                    error: function(response) {
                    }
                    
                });
            }
        });

       

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\todo-app\resources\views/todo/todo-share-add.blade.php ENDPATH**/ ?>