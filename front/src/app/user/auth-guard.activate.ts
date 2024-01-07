import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
import { UserService } from './user-service.service';
import { CookieService } from 'ngx-cookie-service';

@Injectable({
  providedIn: 'root',
})
export class AuthGuard implements CanActivate {
  constructor(private authService: UserService, private router: Router, private cookieService: CookieService) {}

  canActivate(): Promise<boolean>|boolean {
    let token = this.cookieService.get('token');
    return token?true:false;
    
    // return this.authService.isAuthenticated((valid:any) => {
    //   if(!valid){
    //     this.router.navigate(['/auth/login']);
    //   }
    // });
  }
}