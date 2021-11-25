<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Vendors;

class VendorController extends Controller
{
    public function importVendors(Request $request)
    {
      //$request->aux
      $Vendors = new Vendors($request->aux);
      Excel::import($Vendors,$request->file('vendor'));
      $data= $Vendors->getData();
      return response()->json($data);
    }
}
