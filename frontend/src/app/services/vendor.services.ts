import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable } from 'rxjs';
import {map } from 'rxjs/operators';
import { of } from 'rxjs';
//import { URLAPI } from '../services/global.services';
@Injectable()

export class VendorService{
    public url :string;
    constructor(private _http:HttpClient){
        this.url ="http://localhost:8000/api/";
    }
  
    vendorAuth(data:any){
        
        const {email,password } = data;
        const header = new HttpHeaders().set('Content-Type','application/json');
        let result =this._http.get(this.url+'getVendor/'+email+'/'+password,{headers:header});
        return result.pipe(map((res : any)=>JSON.stringify(res)));
    }
}
