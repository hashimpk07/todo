
<?php $__env->startSection('content'); ?>

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('todo')); ?>'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Update  To Do App </h5>
</div>

<form action="javascript:void(0)" id="todoForm" name="todoForm-edit"  method="post">
   
    <div class="card-body">
    <input type="hidden" name="id" class="form-control" id="id" value="<?php echo e($todo->id); ?> ">
        <div class="form-group">
            <label for="name"> Name <span style="color:#ff0000">*</span></label>
                <input type="text" name="name" class="form-control" id="name"  value="<?php echo e($todo->title); ?>" placeholder="Enter To Do Name " disabled>
            <div class="error" id="nameErr"></div>
        </div>

        <div class="form-group">
            <label for="dueDate"> Due Date <span style="color:#ff0000">*</span></label>
            <div class="input-group">
                        <input type="date" class="form-control" id="dueDate" name="dueDate" value="<?php echo e($todo->due_date); ?>" disabled>
                    </div>
            <div class="error" id="dueDateErr"></div>
        </div>

        <div class="form-group">
            <label for="Status"> Status <span style="color:#ff0000">*</span></label>
            <select class="form-control" id="status" name="status" disabled> 
                <option <?php echo e(( $todo->status) == 'pending' ? 'selected' : ''); ?>  value="1">Pending</option>
                <option <?php echo e(( $todo->status) == 'completed' ? 'selected' : ''); ?>   value="2"> Completed</option>
                
            </select>
            <div class="error" id="statusErr"></div>
        </div>

        <div class="form-group">
            <label for="name"> Description </label>
            <textarea  type="textarea" name="description" class="form-control" id="description" placeholder="Description"  rows="4" cols="50" disabled><?php echo e($todo->description); ?></textarea>
        </div>
        <div class="error" id="todoErr"></div>
        
    </div>
    <!-- /.card-body -->
    
</form>
                                          
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\todo-app\resources\views/todo/todo-show.blade.php ENDPATH**/ ?>