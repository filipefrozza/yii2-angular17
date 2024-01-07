import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { CookieService } from 'ngx-cookie-service';

@Injectable({
  providedIn: 'root',
})
export class BooksService {
  private apiUrl = 'http://localhost:4300/api';
  private token = '';
  private headers = new HttpHeaders();
  
  constructor(private http: HttpClient, private cookieService: CookieService) {
    this.token = this.getToken();
    if (this.token) {
      this.headers = this.headers.append('Authorization', `Bearer ${this.token}`);
    }
  }
  
  getToken(): any{
    return this.cookieService.get('token');
  }

  getBooks(): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/book`, {headers: this.headers});
  }
  
  getBook(id: any): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/book/${id}`, {headers: this.headers});
  }

  createBook(book: any): Observable<any> {
    return this.http.post<any>(`${this.apiUrl}/book`, book, {observe: 'response', headers: this.headers});
  }

  updateBook(book: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/book/${book.id}`, book, {observe: 'response', headers: this.headers});
  }
  
  removeBook(book: any): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/book/${book.id}`, {observe: 'response', headers: this.headers});
  }

}