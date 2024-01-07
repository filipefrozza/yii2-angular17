import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { UserService } from './user/user-service.service';
import { CookieService } from 'ngx-cookie-service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  public logged:any = false;
  
  constructor(public router: Router, private authService: UserService, private cookieService: CookieService) {
    
  }
  
  ngOnInit(){
    let token = this.cookieService.get('token');
    this.logged = this.authService.isAuthenticated(token);
  }
  
  title = 'angularmodules';
}
