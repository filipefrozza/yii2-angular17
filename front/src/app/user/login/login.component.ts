import { Component, Input } from '@angular/core';
import { UserService } from '../user-service.service';
import { Router } from '@angular/router';
import { CookieService } from 'ngx-cookie-service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  @Input() user = {
    username: '',
    password: ''
  };

  constructor(private authService: UserService, private router: Router, private cookieService: CookieService) {}

  login() {
    this.authService.login(this.user).subscribe(
      response => {
        if (response.body.error){
          alert(response.body.error)
        } else {
          const token = response.body.token;
          this.cookieService.set('token', token);
          this.router.navigate(['/books']);
        }
      },
      error => {
        console.error('Login error:', error);
      }
    );
  }
}