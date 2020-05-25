<?php

namespace App\Http\Controllers;

use App\Originality;
use App\User;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Controllers\adminend\UserController as UserAdmin;
class AdminController extends Controller
{
    public function index(){
        return view('admin_pages.dashboard');
    }
    public function user($action, $id = null, $form_name=null, Request $request){
        $user_obj = new UserAdmin();
        switch ($action){
            case 'all':
                if($request->ajax()){
                    //datatable results
                    return $user_obj->allUsers();
                }
                return view('admin_pages.users.users');
            break;
            case 'create':
                if($request->isMethod('post')){
                   return $user_obj->createEditUser($request->all());
                }
                return view('admin_pages.users.user-create');
                break;
            case 'view':

                return $user_obj->viewUser($id);

                break;
            case 'edit':
                if($request->isMethod('post')){
                   return $user_obj->createEditUser($request->all(), $id, $form_name);
                }

                $user_details = User::with('role', 'originality', 'accountDetail', 'personalData', 'parcel')->find($id);
                return view('admin_pages.users.user-edit', [
                    'user_details'=>$user_details,
                    'originality'=>Originality::all()
                ]);
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


    }
}
