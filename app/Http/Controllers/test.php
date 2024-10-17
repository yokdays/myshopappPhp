<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class test extends Controller
{
    //
    public function index()
    {
        $user = User::find(Auth::id());
        // $role = Role::create(['name' => 'reader']);
        // $permission = Permission::create(['name' => 'can_read_articles']);
        // $permission2 = Permission::create(['name' => 'can_write_articles']);
        // $role->givePermissionTo($permission);
        // $user->assignRole("reader");


        if($user->hasRole('reader')){
            dd('Yes');
        }else{
            dd('No');
        }
    }
}
