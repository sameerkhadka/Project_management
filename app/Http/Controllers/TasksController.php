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
        $completed = Task::select('*')
        ->where('completed', '=', 0)
        ->orderBy('priority', 'asc')
        ->orderBy('updated_at', 'DESC')
        ->get();
 
       
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
    public function store(Request $request)
    {   
        $this->validate($request, [
            'company' => 'required', 
            'title' => 'required',
            'assigned_to' => 'required',
            'priority' => 'required',
            'image.*' => 'mimes:jpg,jpeg,png|max:2000'
          ],[
            'image.*.mimes' => 'Only jpeg, png, jpg images are allowed',
            'image.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->department = $request->department;
        $task->assigned_to = json_encode($request->assigned_to);
        $task->contact_person = $request->contact_person;
        $task->priority = $request->priority;        
        $task->company = $request->company;
        //upload the image to the storage
        if($request->hasFile('image'))
        {

            foreach($request->file('image') as $image) 
            {

                $filename = $image->getClientOriginalName();

                $image->storeAs('tasks', $filename);

                $imgData[] = $filename;

            }

            $task->image = json_encode($imgData);
        }
        $task->save();

       session()->flash('success', 'Task Created successfully'); 

       $completed = Task::select('*')
       ->where('completed', '=', 0)
       ->orderBy('priority', 'asc')
       ->orderBy('updated_at', 'DESC')
       ->get();
       
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
    public function update(Request $request)
    {
        $this->validate($request, [
            'company' => 'required', 
            'title' => 'required',
            'assigned_to' => 'required',
            'priority' => 'required',
            'image.*' => 'mimes:jpg,jpeg,png|max:2000'
          ],[
            'image.*.mimes' => 'Only jpeg, png, jpg images are allowed',
            'image.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',
        ]);


        if($request->hasFile('image'))
        {   
            $data = Task::find($request->task);

            // if(!$data->image == '')
            // {

            //     foreach (json_decode($data->image) as $images) 
            //     { 
            //         Storage::delete("tasks/{$images}");   
        
            //     }   

            // }

            foreach($request->file('image') as $image) 
            {

                $filename = $image->getClientOriginalName();

                $image->storeAs('tasks', $filename);
               
                $imgData = json_decode($data->image);

                array_push($imgData,$filename);
                                           
                $data->image = json_encode($imgData);

                $data->save();
            }
            
              
           
        }
        
        $data = Task::find($request->task);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->department = $request->department;
        $data->assigned_to = json_encode($request->assigned_to);
        $data->contact_person = $request->contact_person;
        $data->priority = $request->priority;
        $data->company = $request->company;

        $data->save();
       
        //flash message

        session()->flash('success', 'Task updated successfully');

        //redirect user
        $completed = Task::select('*')
            ->where('completed', '=', 0)
            ->orderBy('priority', 'asc')
            ->orderBy('updated_at', 'DESC')
            ->get();    
       
            return redirect()->route('tasks.show', $data->id)->with('companies', Company::all())->with('users', User::all())->withTasks($completed);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {   
        if(!$task->image == '')
        {
            foreach (json_decode($task->image) as $images) {
   
                Storage::delete("tasks/{$images}");             
            } 
        }  
            $task->delete();   
            session()->flash('success', 'Task deleted successfully');   
            $completed = Task::select('*')
            ->where('completed', '=', 0)
            ->orderBy('priority', 'asc')
            ->orderBy('updated_at', 'DESC')
            ->get();    
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

    public function deleteimg($images, Request $req)
    {
        $task = Task::find($req['task_id']);
        dd($task);
        $images=json_decode($task->image);
        dd($images);
        unset($images[$image]);
        $task->image=json_encode(array_values(images));
        $task->save();
        return redirect()->back();
       
        
    }
   
}
