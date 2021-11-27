<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\File;
use App\Imports\Vendors;
use App\Models\Vendor;
use Illuminate\Validation\ValidationException;
class VendorController extends Controller
{
    public function importVendors(Request $request)
    {
      try{
        
        if(empty($request['aux'])){
          
          $file = $request->file('vendor');
          $nameFile = $file->getClientOriginalName();
          $info = new \SplFileInfo($nameFile);
          $ext = $info->getExtension();
          
          if($ext=='txt'){ // Si el archivo es un txt
          
            $path="public/documents";
            $file->storeAs($path,$nameFile);
            $txt = File::get(storage_path().'/app/public/documents/'.$nameFile);
            $data = array_chunk(explode(',', $txt),3);
     
          }else{ // si el archivo es csv o xls 

            $Vendors = new Vendors();
            Excel::import($Vendors,$file);
            $data= $Vendors->getData();
   
          }
          return view('vendors.confirm-vendors',compact('data'));
        }else{

          foreach($request['params'] as $key=> $item ) Vendor::create(array('name'=>$item[0],'email'=>$item[1],'rfc'=>$item[2]));
          session()->flash('success', 'Los proveedores se cargaron correctamente');
        }

      }catch(\Exception $e){
        //dd($e);
        session()->flash('danger', 'Error al procesar los datos , no cumplen con los parametros solicitados..!!');
      
      }
      return redirect()->route('home');  
    }

    public function addPassword(Request $request)
    {
      $id = decrypt($request->id);
      $pwd = $request->password;
      Vendor::where(['id'=>$id])->update(['password' => Hash::make($pwd)]);
      session()->flash('success', 'Contraseña actualizada');
      return redirect()->route('home');  
    }

    public function getVendor($email,$pass)
    {

      $status = 0 ;
      $name ="";
      $data = Vendor::where('email',$email)->first();
  
      if(!empty($data))
        if(Hash::check($pass, $data->password)){ 
          $status = 1;
          $name = $data->name; 
         }else{ 
           $status=2;
        }

      return response()->json(['status'=>$status,'name'=>$name ]);
    
    }
}
