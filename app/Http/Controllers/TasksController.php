<?php

namespace App\Http\Controllers;

use App\Models\company;

use App\Models\task;

use App\Models\user;

use Illuminate\Http\Request;

use App\Http\Requests\Tasks\CreateTasksRequest;

use App\Http\Requests\Tasks\UpdateTaskRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $completed = DB::select('select * from tasks where completed = ?', ['0']);
       return view('project.tasks')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTasksRequest $request)
    {
        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $image)
            {
                $name=$image->getClientOriginalName();
                $image = move(asset('storage/' . $name));
                $data[] = $name;
            }
        }
        //upload the image to the storage
       
         

       Task::create([

        'title' => $request->title ,
        'description' => $request->description,
        'department' => $request->department,
        'assigned_to' => json_encode($request->assigned_to),
        'contact_person' => $request->contact_person,
        'priority' => $request->priority,
        'image' => json_encode($image),
        'company' => $request->company
        
       ]);

       session()->flash('success', 'Task Created successfully'); 

       $completed = DB::select('select * from tasks where completed = ?', ['0']);
       
       return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Id)
    {   
        $task = Task::all()->where('id', $Id)->first();
        return view('project.viewtask')->with('companies', Company::all())->with('users', User::all())->with('task', $task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('project.tasks')->with('companies', Company::all())->with('users', User::all())->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = $request->all();
        //check if new image
        if($request->hasFile('image')){

        //upload it
        $image = $request->image->store('tasks'); 

        //delete old one

        Storage::delete($task->image);

        $data['image'] = $image;
        }   

        //update attributes

        $task->update($task);

        //flash message

        session()->flash('success', 'Task updated successfully');

        //redirect user
        $completed = DB::select('select * from tasks where completed = ?', ['0']);
       
        return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {                     
           Storage::delete($task->image);
            $task->delete();   
            session()->flash('success', 'Task deleted successfully');   
            $completed = DB::select('select * from tasks where completed = ?', [0]);        
          return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }

    public function completed(Task $task)
    {   
        $completed = DB::select('select * from tasks where completed = ?', ['true']);
 
        if($task->completed == false)
        {
            $task->completed = true;
            $task->update([
                'completed' => $task->completed
                ]);
         }

        else

        {
            $task->completed = false;
            $task->update([
                'completed' => $task->completed
                ]);
        }

        return back()->with('companies', Company::all())->with('users', User::all())->withTasks($completed);

        
    }

   
}
