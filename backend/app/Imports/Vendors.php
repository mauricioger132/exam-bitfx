<?php

namespace App\Imports;

use App\Models\Vendor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class Vendors implements ToCollection
{
    public $aux;
    public $params;
    /**
    * @param Collection $collection
      
    */
    public function __construct($aux)
    {
        $this->$aux = $aux;
    }
    public function collection(Collection $rows)
    {
        //dd($this->aux);
        $data =[];
        foreach($rows as $key=> $row){
            if($key!==0)
                $data[]=array(
                    'nombre_completo'=>$row[0],
                    'email'=>$row[1],
                    'rfc'=>$row[2],
                );
        }
        $this->params = $data; 
      
    }
    public function getData()
    {
        return $this->params;
    }
}
