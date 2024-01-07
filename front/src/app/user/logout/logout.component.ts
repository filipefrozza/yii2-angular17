import { Component} from '@angular/core';
import { Router } from '@angular/router';
import { CookieService } from 'ngx-cookie-service';

@Component({
  selector: 'app-logout',
  template: '',
})
export class LogoutComponent {
  constructor(private router: Router, private cookieService: CookieService) {}
  
  ngOnInit() {
    this.cookieService.delete('token');
    
    this.router.navigate(['/auth/login']);
  }
  
}