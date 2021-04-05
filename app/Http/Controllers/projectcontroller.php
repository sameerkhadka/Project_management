<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\company;

use App\Models\user;

use App\Models\task;

use Illuminate\Support\Facades\DB;

class projectcontroller extends Controller
{
    public function index()
    {  
        $search = request()->query('search');
        if($search){
            $completed = Task::select('*')
            ->where('title','LIKE', "%{$search}%")
            ->where('completed', '=', 0)
            ->get();

        } else{

            $completed = DB::select('select * from tasks where completed = ?', ['0']);

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
        ->get();
      

        return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }

    public function design()
    {
        $completed = Task::select('*')
        ->where('department', '=', ['design'])
        ->where('completed', '=', 0)
        ->get();

        return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }
    
    public function web()
    {   
        $completed = Task::select('*')
        ->where('department', '=', ['web'])
        ->where('completed', '=', 0)
        ->get();
        
        return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }
    
    public function print()
    {   
        $completed = Task::select('*')
        ->where('department', '=', ['print'])
        ->where('completed', '=', 0)
        ->get();
    
        return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }

    public function completed()
    {
        $completed = Task::select('*')
        ->where('completed', '=', 1)
        ->get();
        

        return view('project.index')->with('companies', Company::all())->with('users', User::all())->withTasks($completed);
    }

    
}
