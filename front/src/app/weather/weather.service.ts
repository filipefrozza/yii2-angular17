import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class WeatherService {
  private apiUrl = 'http://localhost:4300/api/auth/weather';
  
  constructor(private http: HttpClient) { }
  
  checkWeather(): Observable<any>{
    return this.http.get(`${this.apiUrl}?user_ip=remote`);
  }
}
