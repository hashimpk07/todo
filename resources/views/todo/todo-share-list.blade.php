@extends('dashboard')
@section('content')

<!-- /.card-header -->
<div class="card-header">
<button type="button" class="btn btn-primary" style="float: left;margin-left:10px"; onclick="window.location='{{ URL::route('todo'); }}'" ><i class="fa fa-plus"></i> My ToDo </button>
<button type="button" class="btn btn-success" style="float: left;margin-left:10px"; onclick="window.location='{{ URL::route('todo.share'); }}'" ><i class="fa fa-plus"></i> Share ToDo </button>
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('todo.add'); }}'" ><i class="fa fa-plus"></i> Add To Do </button>
</div>
<div class="card-body">
    <h5> To Do App Table</h5>
    <?php
    if( 0  != $todoData->total() ){?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th style="width: 150x">User Name</th>
                <th style="width: 150px"> Title</th>
                <th style="width: 120px"> Status </th>
                <th style="width: 120px">Due Date</th>
                <th style="width: 250px">Description</th>
                <th style="width: 70px">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = ($todoData->perPage() * ($todoData->currentPage() - 1)) + 1; ?>
            @foreach($todoData as $todo)
            <tr>
                <td >{{ $i++ }}</td>
                <td > {{ $todo->name }} </td>
                <td > {{ $todo->title }} </td>
                <td > {{ $todo->status }} </td>
                <td > {{ $todo->due_date }} </td>
                <td > {{ $todo->description }} </td>
                <td>
                    <i id="like-button" class="fa fa-thumbs-up" title="Like" data-liked="{{ $todo->id }}" style="cursor: pointer;color:blueviolet;">( {{$todo->likes_count}} )</i>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
</div>
<?php } else{?> 
<img src="{{url('/images/norecordfound.png')}}" class="no-data-found" style="width: 100%;" />
    <?php } ?>
</div>
<!-- /.card-body -->
<div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
        {!! $todoData->links('pagination::bootstrap-4') !!}
    </ul>
</div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">  
    $(document).ready(function() {
        $('#like-button').click(function() {
            var todoId = $(this).data('liked');
            const currentElement = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:"{{ route('todo.like') }}",
                type: "POST",
                dataType: "json",
                data:{ 
                    todoId:todoId,
                },
                success:function(data){
                    if( data.status == 'success' ){
                        currentElement.text(`(${data.count})`);
                    }else{
                        $("#todoErr").html("Data Not Saved ! Please check Data");
                    }
                  
                },
                error: function(response) {
                    
                }
                 
            });
        });
     
    });
</script>
@endsection