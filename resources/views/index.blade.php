@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
    margin-top: 40px;
    max-width: 500px;
    margin: 40px auto;
  }
  .card {
    border: 0;
    box-shadow: 0px 0px 14px #ded2d2;
}

.card .card-footer {
    height: 5px;
    padding: 0;
}
.bg-none {
    background: transparent;
    border: 0;
    padding: 0;
}
.bg-none i {
    color: #61aeab;
    font-size: 18px;
}
</style>
<div class="uper justify-content-center">
  @if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div><br />
  @endif
  <div class="d-flex justify-content-between mb-2">
    <h4 class="float-left" style="color:#61aeab;font-weight:bold;">Task List</h4>
    <button class="mb-2 ml-auto float-right bg-none" data-toggle="modal" data-target="#CreateTask"><i class="fa fa-plus-circle" style="font-size:30px;" aria-hidden="true"></i></button>
  </div>
  @foreach($tasks as $task)
  <div class="card mb-3">
    <div class="card-header border-0">
      <h6 class="float-left text-muted font-weight-bold">{{$task->due_date}}</h6>
      <div class=" d-flex float-right">
        <a href="{{ route('tasks.edit', $task->id)}}" class="m-1 bg-none"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
        <form action="{{ route('tasks.destroy', $task->id)}}" method="post">
          @csrf
          @method('DELETE')
          <button class="m-1 bg-none" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </form>

      </div>
    </div>
    <div class="card-body pt-0 pb-0">
      <h5 class="card-title">{{$task->task}}</h5>
    </div>
    @if($task->priority=="low")
    <div class="card-footer h-1" style=" background:green;"></div>
    @endif
    @if($task->priority=="medium")
    <div class="card-footer" style=" background:orange;"></div>
    @endif
    @if($task->priority=="high")
    <div class="card-footer" style=" background:red;"></div>
    @endif
  </div>

  @endforeach

  <!-- Modal -->
  <div class="modal fade" id="CreateTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div><br />
          @endif
          <form method="post" action="{{ route('tasks.store') }}">
            <div class="form-group">
              @csrf
              <label for="country_name">Task Name:</label>
              <input type="text" class="form-control" name="task" />
            </div>
            <div class="form-group">
              @csrf
              <label for="country_name">Due Date:</label>
              <input type="datetime-local" class="form-control" name="due_date" />
            </div>
            <div class="form-group">
              <label for="cases">Priority :</label>
              <select name="priority" class="form-control">
                <option value="high">high</option>
                <option value="medium">medium</option>
                <option value="low">low</option>
              </select>
            </div>


            <div class="modal-footer">

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add Task</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
  @endsection