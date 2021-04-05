@extends('layouts.app')
@section('content')
<div class="content">
            <div class="task-detail">
                <div class="tash-headwrap">
                    <ul class="td-head">
                        <li>
                            Priority: <span>Urgent</span>
                        </li>

                        <li>
                        <form action="/tasks/{{ $task->id  }}/completed" method="POST">
                             @csrf
                             @method('PATCH')
                            
                            <button class="complete"><i class="far fa-check-circle"></i> <span>{{ $task->completed == true ? "Mark as Pending" : "Mark as Completed"}}</span></button>
                        </form>
                        </li>
                    </ul>
                    <ul class='actions'>
                        <li>                           
                            <a href="{{route('tasks.edit', $task->id)}}" class="edit-btn">Edit</a>
                        </li>
    
                        <li><button onclick="handleDelete({{ $task->id  }})" class="delete-btn">Delete</button></li>
                    </ul>
                </div>

            

                
                <div class="task-wrap">
                    <div class="main-det">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="task-show">
                                    <label for="">Company</label>
                                    <h4>{{\App\Models\Company::find($task->Company)->name }}</h4>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="task-show">
                                    <label for="">Title</label>
                                    <h4>{{ $task->title  }}</h4>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="task-show">
                                    <label for="">Contact Person</label>
                                    <h4>{{ $task->contact_person  }}</h4>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="task-show">
                                    <label for="">Department</label>
                                    <h4>{{ $task->department  }}</h4>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="task-show">
                                    <label for="">Assigned To</label>
                                    <h4>
                                    @foreach(json_decode($task->assigned_to) as $assigned_id)
                                    <span>{{ \App\Models\User::find($assigned_id)->name }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="task-show">
                                    <label for=""> Description</label>
                                    <h4> {{ $task->description  }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                </div>

                <div class="task-media">
                    <h5>Media</h5>

                    <div class="media-wrap">
                        <a href="{{ asset('storage/' . $task->image)  }}" data-lightbox="media-img">
                            <img src="{{ asset('storage/' . $task->image)  }}" alt="">
                        </a>                 
              
                    </div>
                </div>
                
            </div>
        </div>

    </div>


             <!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModallabel" aria-hidden="true">
  <div class="modal-dialog">
        <form action="" method="POST" id="deleteTask">
        
        @csrf
        
        @method('DELETE')
       
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Delete Company</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true"></span>
             </button>
      </div>
      <div class="modal-body">
        <p class="text-center text-bold"> Are you sure you want to delete???</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
      </div>
    </div>
        
        </form>
  </div>
</div>

    </div>

@endsection

@section('scripts')

    <script>
    
        function handleDelete(id) {
    
            var form = document.getElementById('deleteTask')        

            form.action = '/tasks/' + id       

            $('#deleteModal').modal('show')        

        }
    
    </script>

@endsection