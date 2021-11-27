<?php

namespace App\Imports;

use App\Models\Vendor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class Vendors implements ToCollection
{
    public $params;
    /**
    * @param Collection $collection
      
    */
    public function collection(Collection $rows)
    {
        $data =[];
        foreach($rows as $key=> $row){
            if($key!==0)
                $data[]=array(
                    '0'=>$row[0],
                    '1'=>$row[1],
                    '2'=>$row[2],
                );
        }
        $this->params = $data; 
      
    }
    public function getData()
    {
        return $this->params;
    }
}
