import { Component,OnInit,Input } from '@angular/core';
import { Router,ActivatedRoute,Params } from '@angular/router';
import { ToastrService } from 'ngx-toastr'; //toast
import { VendorModel } from './models/VendorModel';
import { VendorService } from './services/vendor.services';
@Component({

  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
  providers:[VendorService]

})
export class AppComponent implements OnInit
{
  
  public vendor : VendorModel;
  public name : any;
  @Input() auth:any;

  constructor(
    
    private _vendorService:VendorService,
    private toastrService:ToastrService
  
  ){
    
    this.vendor=new VendorModel('','');
  }
  
  ngOnInit(){
    
    let info = JSON.parse(localStorage.getItem('data')as string);
    if(info !=null){
      const {status,name} = info;
      this.auth =status;
      this.name =name;
    }
    
  }
  public authenticationVendor(){

    localStorage.clear(); 
    if(this.vendor.email!="" && this.vendor.password!=""){
          
      const regEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      let val = regEmail.test(String(this.vendor.email).trim().toLocaleLowerCase());
      let items =this._vendorService.vendorAuth(this.vendor).subscribe(resp=>{
          
          let info = JSON.parse(resp);
          const {status,name} = info;
          
          if(status==1){

            localStorage.setItem('data',JSON.stringify(info) );    
            this.auth=1;
       
          }else if(status==2){

            localStorage.setItem('session',"0");
            this.auth=0;
            this.toastrService.error('La contraseña es incorrecta!');
        
          }else{

            localStorage.setItem('session',"0");
            this.auth=0;
            this.toastrService.error('El correo no existe!');
          }
      });
    }else{
      this.toastrService.error('Los datos están vacíos!');
   
    }
  }
  public cerrarSesion(){

    localStorage.clear();
    location.reload();
  
  }
}
