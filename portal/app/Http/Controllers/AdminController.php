<?php

namespace App\Http\Controllers;

use App\Originality;
use App\Parcel;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Controllers\adminend\UserController as UserAdmin;
use App\Http\Controllers\adminend\ParcelController as ParcelAdmin;
use Illuminate\Support\Facades\File;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\Statement;

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
                if($request->ajax()){
                   return $user_obj->deleteUser($id);
                }
                break;
            default:
                dd('not found');
                break;
        }


    }


    public function parcel($action, $id = null, $form_name=null, Request $request){
        $parcel_obj = new ParcelAdmin();
        switch ($action){
            case 'all':
                if($request->ajax()){
                    //datatable results
                    return $parcel_obj->allParcels();
                }
                return view('admin_pages.parcels.parcels');
                break;
            case 'create':
                if($request->isMethod('post')){
                    return $parcel_obj->createEditParcel($request->all());
                }
                return view('admin_pages.users.user-create');
                break;
            case 'view':

                return $parcel_obj->viewParcel($id);

                break;
            case 'edit':
                if($request->isMethod('post')){
                    return $parcel_obj->createEditParcel($request->all(), $id, $form_name);
                }

//                $user_details = User::with('role', 'originality', 'accountDetail', 'personalData', 'parcel')->find($id);
//                return view('admin_pages.users.user-edit', [
//                    'user_details'=>$user_details,
//                    'originality'=>Originality::all()
//                ]);
                break;
            case 'delete':
                if($request->ajax()){
                    return $parcel_obj->deleteParcel($id);
                }
                break;
            default:
                dd('not found');
                break;
        }


    }

    public function csv(Request $request){
        if($request->isMethod('post')){
            $file = $request->file('file');

            File::cleanDirectory(storage_path('app/public/parcels_csv'));

            $fileName = Carbon::now()->format('d-F-Y*H:i:s') .'-'.$file->getClientOriginalName();
            $file->move(storage_path('app/public/parcels_csv'),$fileName);

            $csv = Reader::createFromPath(storage_path('app/public/parcels_csv/' . $fileName));
            try {
                $csv->setHeaderOffset(0);
            } catch (Exception $e) {

                return $e->getMessage();
            }
            try {
                $records = Statement::create()->process($csv);
            } catch (Exception $e) {
                return $e->getMessage();
            }
            foreach ($records as $record){
                Parcel::where('assigned_parcel_number', $record['refno'])
                ->update([
                    'assigned_tracking_number'=> $record['cnno']
                ]);
            }
           // return $csv->getContent();
        }

        return view('admin_pages.parcels.parcel-import-csv');
    }

}
