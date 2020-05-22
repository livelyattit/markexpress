<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Controllers\adminend\UserController as UserAdmin;
class AdminController extends Controller
{
    public function index(){
        return view('admin_pages.dashboard');
    }
    public function user($action, $id = null, Request $request){
        $user_obj = new UserAdmin();
        switch ($action){
            case 'all':
                if($request->ajax()){
                    return $user_obj->allUsers();
                }
                return view('admin_pages.users.users');
            break;
            case 'create':
                if($request->isMethod('post')){
                    return $user_obj->createUser($request->all());
                }
                return view('admin_pages.users.user-create');
                break;
            case 'view':
                return view('admin_pages.users.user-view');
                break;
            case 'edit':
                if($request->isMethod('post')){
                   return $user_obj->editUser($id, $request->all());
                }
                return view('admin_pages.users.user-create');
                break;
            case 'delete':
                if($id){
                    return $user_obj->deleteUser($id);
                }
                dd('here deleted');
                break;
            default:
                dd('not found');
                break;
        }


        if($request->ajax()) {

        }


    }

    public function createUser(Request $request){
        if($request->isMethod('post')){
            dd($request->all());
        }
        return view('admin_pages.users.user-create');
    }
}
