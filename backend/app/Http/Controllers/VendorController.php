<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Vendors;
use App\Models\Vendor;

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
          
          if($ext=='txt'){
          
            $path="public/documents";
            $file->storeAs($path,$nameFile);
            $url = asset('storage/documents/'.$nameFile);
            $openFile=fopen($url,'r');
            fclose($openFile);
            echo $url;
            dd();
          }else{

            $Vendors = new Vendors($request->aux);
            Excel::import($Vendors,$file);
            $data= $Vendors->getData();
          
            return view('vendors.confirm-vendors',compact('data'));
          }
        
        }else{

          foreach($request['params'] as $key=> $item ) Vendor::create(array('name'=>$item['nombre_completo'],'email'=>$item['email'],'rfc'=>$item['rfc']));
          session()->flash('success', 'Los proveedores se cargaron correctamente');
        }

      }catch(\Exception $e){

        session()->flash('danger', 'Error al procesar los datos intentelo nuevamente..!!');
      
      }
      return redirect()->route('home');  
    }
}
