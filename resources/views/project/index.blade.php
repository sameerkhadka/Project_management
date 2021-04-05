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
                        <th>Assigned Date</th>
                        <th>Assigned To</th>
                        <th>Contact Person</th>
                   </tr>

                   @foreach($tasks as $task)
                    <tr>                              
                        <td>1</td>
                        <td><a href="{{route('tasks.show', $task->id)}}"> {{ $task->title  }}  </a></td>
                        <td>{{ \App\Models\Company::find($task->Company )->name}}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>@foreach(json_decode($task->assigned_to) as $assigned_id)<span>{{ \App\Models\User::find($assigned_id)->name }}</span>@endforeach</td>
                        <td><span>{{ $task->contact_person }}</span></td>
                    </tr>
                    @endforeach
            </div>


        </div>

@endsection