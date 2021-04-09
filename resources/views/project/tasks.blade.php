@extends('layouts.app')
@section('content')
        <div class="content">
            <div class="ntask">
                <h4 class="task-title">
                {{ isset($task) ? 'Edit Task' : 'New Task' }} 
                </h4>

                <div class="row">
                    <div class="col-md-4">
                        <div class="task-form">
                            <label for="">Company</label>
                    <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                      @if(isset($task))  
                        @method('PUT')
                      @endif

                            <select class="form-select"  aria-label="Default select example" name="company">
                                <option selected></option>
                               
                                 @foreach($companies as $company)
                                 @if(isset($task))
                                <option value="{{ $company->id }}" @if($task->Company==$company->id) selected @endif>{{ $company->name }}</option>
                                @else
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endif
                                @endforeach
                                <!-- <option value="2">Nick Simons Institute</option>
                                <option value="3">Almira</option>
                                <option value="4">Kathmandu Engineering Collge</option> -->
                            </select>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="task-form">
                           <label for="">Task Name</label>
                            <input type="text" name="title" id="title"  value="{{ isset($task) ? $task->title : '' }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="task-form">
                            
                            <label for="">Contact Person</label>
                            <input type="text" name="contact_person" id="contact_person"  value="{{ isset($task) ? $task->contact_person : '' }}">
                        </div>
                        
                    </div>

                    <div class="col-md-4">
                        <div class="task-form">
                            <label for="">Department</label>

                            <select class="form-select"  aria-label="Default select example" name="department">
                                <option selected> --- </option>
                                @if(!isset($task))
                                <option value="Design">Design</option>
                                <option value="Web">Web</option>
                                <option value="Print">Print</option>
                               @else
                                <option value="Design" {{ $task->department == 'Design' ? 'selected' : '' }}>Design</option>
                                <option value="Web" {{ $task->department == 'Web' ? 'selected' : '' }}>Web</option>
                                <option value="Print" {{ $task->department == 'Print' ? 'selected' : '' }}>Print</option>
                                @endif
                            </select>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="task-form">
                            <label for="">Assigned To</label>
                            
                            <select class=" js-example-basic-multiple" name="assigned_to[]" multiple >
                            @foreach($users as $user) 
                            @if(isset($task))
                            <option value="{{ $user->id }}" @if(in_array($user->id,json_decode($task->assigned_to))) selected @endif>{{ $user->name }}</option>
                            @else
                             <option value="{{ $user->id }}">{{ $user->name }}</option>
                             @endif
                            @endforeach
                                <!-- <option value="2">Yogesh Karki</option>
                                <option value="3">Looja Shakya</option>
                                <option value="4">Sameer Khadka</option> -->
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="task-form">
                            <label for="">Priority </label>

                            <select class="form-select"  aria-label="Default select example" name="priority">
                                <option selected> --- </option>
                                @if(!isset($task))
                                <option value="1" >Urgent</option>
                                <option value="2" >High</option>
                                <option value="3" >Medium</option>
                                <option value="4" >Low</option>
                                @else
                                <option value="1" {{ $task->priority == 1 ? 'selected' : '' }}>Urgent</option>
                                <option value="2" {{ $task->priority == 2 ? 'selected' : '' }}>High</option>
                                <option value="3" {{ $task->priority == 3 ? 'selected' : '' }}>Medium</option>
                                <option value="4" {{ $task->priority == 4 ? 'selected' : '' }}>Low</option>
                                @endif
                            </select>
                        </div>
                    </div>


                </div>


                <div class="row">
                    

                    <div class="col-md-12">
                        <div class="task-form">
                            <label for="description">Description</label>
                         
                            <input id="description" type="hidden" name="description" value="{{ isset($task) ? $task->description : '' }}">
                            <trix-editor input="description"></trix-editor>
                        </div>

                    </div>
                    
                   
                </div>

                    @if(isset($task))
                    <div class="task-media">
                    <h5>Media</h5>
                        <div class="media-wrap">
                        @if(!$task->image == '')
                            @foreach(json_decode($task->image) as $images)
                            <div class='m-img-wrap'>
                                <a  href="{{ asset('storage/tasks/' . $images)  }}" data-lightbox="media-img">                                    
                                    <img src="{{ asset('storage/tasks/' . $images)  }}" alt="">
                                    
                                </a>  
                                {!! csrf_field() !!}
                                <input type="hidden"  name="task_id" value="{{$task->id}}"/>
                                <a class='del-img' href="tasks/{id}/{images}/delete"> <i class="fas fa-times-circle"></i> </a>
                            </div>
                            
                         @endforeach
                         
                         @endif
                        
                                                      
                        </div>
                    </div>

                    @endif

                    <div class="col-md-12">
                        <div class="task-form file-up">
                            <label for="image"> {{ isset($task) ? 'Add Image' : '}Upload Image' }}</label>                               

                                <input type="file" name="image[]" multiple><br/>
                        
                                <div id="selectedFiles"></div>                                                 

                            <button type="submit" class="btn-submit">  {{ isset($task) ? 'Update Task' : 'Add Task' }} </button>
                        </div>
                    </div>
                    
                </form>
                    
                    </div>
       
                    

                </div>
    
                    
            </div>


        </div>

    </div>


    @endsection

    @section('scripts')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>

    @endsection

    @section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" >

    @endsection