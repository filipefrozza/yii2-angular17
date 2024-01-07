import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private apiUrl = 'http://localhost:4300/api';
  
  constructor(private http: HttpClient) {}

  login(user: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/auth/login`, user, {observe: 'response'});
  }
  
  isAuthenticated(token: any): boolean{
    return token!=''?true:false;
  }
}
