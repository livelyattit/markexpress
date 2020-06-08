<?php

namespace App\Http\Controllers;

use App\City;
use App\Customer;
use App\Originality;
use App\Parcel;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Controllers\adminend\UserController as UserAdmin;
use App\Http\Controllers\adminend\ParcelController as ParcelAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
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
        //the id param in this method is used for two purposes
        // 1 - to create the parcel we pass user id from user to directly select that user, from user section to create parcel
        //2 - to edit the parcel we pass the parcel id from parcel section to edit parcel
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

                // id belongs to the user
                $user_details = '';
                if(isset($id)){
                    try {
                        $user_details = User::findOrFail($id);
                    }
                    catch (ModelNotFoundException $e){
                        //if we dont write findOrFail in try catch it will through 404 if model not found.
                    }

                }
                $cities = City::orderBy('city_name')->get();
                return view('admin_pages.parcels.parcel-create',[
                    'cities'=>$cities,
                    'user_details'=>$user_details,
                ]);
                break;
            case 'view':

                return $parcel_obj->viewParcel($id);

                break;
            case 'edit':
                if($request->isMethod('post')){
                    return $parcel_obj->createEditParcel($request->all(), $id, $form_name);
                }

                $parcel_details = Parcel::with('user', 'status', 'addressLog')->find($id);
                $cities = City::orderBy('city_name')->get();
                return view('admin_pages.parcels.parcel-edit', [
                    'parcel_details'=>$parcel_details,
                    'cities'=>$cities,
                ]);
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

    public function ajaxUsersList(Request $request){
       // if($request->wantsJson()){
            $users = Customer::where('name', 'LIKE', '%'.$request->input('q', '').'%')
                ->orWhere('email', 'LIKE', '%'.$request->input('q', '').'%')
                ->orWhere('account_code', 'LIKE', '%'.$request->input('q', '').'%')
                //->select(DB::raw("id, CONCAT(account_code, '-', name, '-', email) AS text"))
        ->get(['id', 'name','email', 'account_code']);
            return response()->json($users);
       // }

    }

    public static function callCourierTrackingByCn($cn){

        $response = Http::get('https://cod.callcourier.com.pk/api/CallCourier/GetTackingHistory?cn=03032-01-010607575');

    }

}
