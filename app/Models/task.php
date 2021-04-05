<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{

    use HasFactory;

    protected $fillable = [

        'title' , 'description' , 'department' , 'assigned_to' , 'contact_person' , 'priority' , 'image' , 'company'

    ];

public static function user($id){
    return User::find($id)->first()->name;
}

public static function company($id){
    return Company::find($id)->first()->name;
}


}
