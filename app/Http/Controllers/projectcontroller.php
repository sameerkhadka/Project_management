<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\company;

use App\Models\user;

use App\Models\task;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class projectcontroller extends Controller
{
    public function index()
    
    {  if(auth()->user()->isAdmin()){

            $search = request()->query('search');
            if($search){
                $completed = Task::select('*')
                ->where('title','LIKE', "%{$search}%")
                ->where('completed', '=', 0)
                ->orderBy('priority', 'asc')
                ->orderBy('updated_at', 'DESC')
                ->get();

            } 
            else{
                $completed = Task::select('*')
                ->where('completed', '=', 0)
                ->orderBy('priority', 'asc')
                ->orderBy('updated_at', 'DESC')
                ->get();
            }
        }

        else{
                 $user_id = Auth::id();
                 $completed = Task::select('*')
                ->where('assigned_to','like', "%\"{$user_id}\"%")
                ->where('completed', '=', 0)
                ->orderBy('priority', 'asc')
                ->orderBy('updated_at', 'DESC')
                ->get();  
        }

        return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    } 

    public function login()
    {
        return view('project.new-login');
    }

    public function companytask($company_name)
    {   
        $completed = Task::select('*')
        ->where('Company', '=', [$company_name])
        ->where('completed', '=', 0)
        ->orderBy('priority', 'asc')
        ->orderBy('updated_at', 'DESC')
        ->get();
      

        return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }

    public function design()
    {
        $completed = Task::select('*')
        ->where('department', '=', ['design'])
        ->where('completed', '=', 0)
        ->orderBy('priority', 'asc')
        ->orderBy('updated_at', 'DESC')
        ->get();

        return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }
    
    public function web()
    {   
        $completed = Task::select('*')
        ->where('department', '=', ['web'])
        ->where('completed', '=', 0)
        ->orderBy('priority', 'asc')
        ->orderBy('updated_at', 'DESC')
        ->get();
        
        return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }
    
    public function print()
    {   
        $completed = Task::select('*')
        ->where('department', '=', ['print'])
        ->where('completed', '=', 0)
        ->orderBy('priority', 'asc')
        ->orderBy('updated_at', 'DESC')
        ->get();
    
        return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }

    public function user_task($user_id)
    {   
       
        $completed = Task::select('*')
        ->where('assigned_to','like', "%\"{$user_id}\"%")
        ->where('completed', '=', 0)
        ->orderBy('priority', 'asc')
        ->orderBy('updated_at', 'DESC')
        ->get();       

        return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }

    public function completed()
    {
        $completed = Task::select('*')
        ->where('completed', '=', 1)
        ->orderBy('priority', 'asc')
        ->orderBy('updated_at', 'DESC')
        ->get();
        

        return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }

    
}
