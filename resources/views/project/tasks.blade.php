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
                                <option selected>Company </option>
                               
                                  @foreach($companies as $company)                                         
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
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
                                <option value="Design">Design</option>
                                <option value="Web">Web</option>
                                <option value="Print">Print</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="task-form">
                            <label for="">Assigned To</label>
                            
                            <select class=" js-example-basic-multiple" name="assigned_to[]" multiple >
                            @foreach($users as $user) 
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                                <option value="1">Urgent</option>
                                <option value="2">High</option>
                                <option value="3">Medium</option>
                                <option value="4">Low</option>
                               
                            </select>
                        </div>
                    </div>


                </div>


                <div class="row">
                    

                    <div class="col-md-6">
                        <div class="task-form">
                            <label for="description">Description</label>
                            <textarea name="description" id="description"  >{{ isset($task) ? $task->description : '' }}</textarea>
                        </div>

                    </div>
                    
                   
                </div>

                    @if(isset($task))
                    <div class="task-media">
                    <h5>Media</h5>
                        <div class="media-wrap">
                            <a href="{{ asset('storage/' . $task->image)  }}" data-lightbox="media-img">
                                <img src="{{ asset('storage/' . $task->image)  }}" alt="">
                            </a>                            
                        </div>
                    </div>

                    @endif

                    <div class="col-md-12">
                        <div class="task-form file-up">
                            <label for="image">Upload Image</label>

                               

                                <input type="file" id="files" name="image[]" multiple><br/>
                        
                                <div id="selectedFiles"></div>   

                                              

                            <button type="submit" class="btn-submit">  {{ isset($task) ? 'Update Task' : 'Add Task' }} </button>
                        </div>
                    
                    </form>
                    
                    </div>
       
                    

                </div>
    
                    
            </div>


        </div>

    </div>


    @endsection