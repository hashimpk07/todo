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
                <th style="width: 200px">Description</th>
                <th style="width: 220px">Actions</th>
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
                    <a class="btn"  title="edit" href="{{ route('todo.edit', ['id' => $todo->id]) }}"  ><i class="fas fa-edit"></i></a>
                    <a class="btn" title="view" href="{{ route('todo.show', ['id' => $todo->id]) }}" ><i class="fas fa-eye"></i></a> 
                    <a class="btn" title="delete" onclick="return confirm('Are you sure to detete plan {{ $todo->title }} ?')"  href="{{ route('todo.delete', ['id' => $todo->id]) }}" ><i class="fas fa-times"></i></a>
                    <a class="btn" title="share" href="{{ route('todo.shareAdd', ['id' => $todo->id]) }}"  > <i class="fas fa-share"></i></a>
                   
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
