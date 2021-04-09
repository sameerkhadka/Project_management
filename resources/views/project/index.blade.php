@extends('layouts.app')
@section('content')
        <div class="content">
            <div class="table-wrap">
                <!-- <h5 class='table-head'>Today</h5> -->
                <table class="list-task">
                    <tr>
                        <th>S.N.</th>
                        <th>Task</th>
                        <th>Company</th>
                        <th>Priority</th>
                        <th>Assigned To</th>
                        <th>Contact Person</th>
                   </tr>

                   @foreach($tasks as $task)
                   @if(auth()->user()->isAdmin())
                    <tr>                              
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{route('tasks.show', $task->id)}}"> {{ $task->title  }}  </a></td>
                        <td>{{\App\Models\Company::find($task->Company)->name }}</td>
                        <td>
                        @if($task->priority==1)
                            Urgent
                       
                        @elseif($task->priority==2)
                            High
                      
                        @elseif($task->priority==3)
                            Medium
                       
                        @elseif($task->priority==4)
                            Low
                        @endif 
                       </td>

                        <td>@foreach(json_decode($task->assigned_to) as $assigned_id)<span>{{ \App\Models\User::find($assigned_id)->name }}</span>@endforeach</td>
                       
                        <td><span>{{ $task->contact_person }}</span></td>
                   
                    </tr>
                    @else
                    <tr>                              
                        <td>{{ $loop->iteration }}</td>
                       
                        <td><a href="{{route('tasks.show', $task->id)}}"> {{ $task->title  }}  </a></td>
                       
                        <td>{{ \App\Models\Company::find($task->Company )->name}}</td>
                       
                        <td> 
                        @if($task->priority==1)
                            Urgent
                        @endif

                        @if($task->priority==2)
                            High
                        @endif

                        @if($task->priority==3)
                            Medium
                        @endif

                        @if($task->priority==4)
                            Low
                        @endif 
                        </td>

                        <td>@foreach(json_decode($task->assigned_to) as $assigned_id)<span>{{ \App\Models\User::find($assigned_id)->name }}</span>@endforeach</td>
                        <td><span>{{ $task->contact_person }}</span></td>
                        
                    </tr>
                    @endif
                    @endforeach
            </div>


        </div>

@endsection