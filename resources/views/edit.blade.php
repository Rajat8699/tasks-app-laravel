@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    <h4 class="float-left">Edit Task</h4>
    
  <div><a class="btn btn-warning mb-2 mr-auto float-right" href="/tasks">Go Back</a></div>
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('tasks.update', $task->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Task:</label>
              <input type="text" class="form-control" name="task" value="{{ $task->task }}"/>
          </div>
          <div class="form-group">
              <label for="cases">Due Date :</label>
              <input type="datetime-local" class="form-control" name="due_date" value="{{ $task->due_date }}"/>
          </div>
          
          <div class="form-group">
              <label for="cases">Priority :</label>
              <select name="priority" class="form-control" value="{{$task->priority}}">
                <option value="high">high</option>
                <option value="medium">medium</option>
                <option value="low">low</option>
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Update Task</button>
          
      </form>
  </div>
</div>
@endsection
