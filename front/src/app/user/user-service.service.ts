import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private apiUrl = 'http://localhost:4300/api';
  private token:any = '';
  
  constructor(private http: HttpClient) {
    
  }

  login(user: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/auth/login`, user, {observe: 'response'});
  }
  
  isAuthenticated(token: any): boolean{
    return token!=''?true:false;
    
    // return new Promise((resolve, reject) => {
    //   let token = localStorage.getItem('token');
    //   this.http.get(`${this.apiUrl}/auth/check`, {observe: 'response', headers: {'Authorization': `Bearer ${token}`}})
    //   .subscribe(response => {
    //     if (response.status == 401) {
    //       callback(false);
    //       resolve(false);
    //     } else {
    //       callback(true);
    //       resolve(true);
    //     }
    //   },
    //   error => {
    //     callback(false);
    //     resolve(false);
    //   });
    // });
  }
}
