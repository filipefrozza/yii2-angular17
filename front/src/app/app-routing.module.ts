import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BooksListComponent } from './books/list/list.component';
import { BooksDetailComponent } from './books/detail/detail.component';
import { BooksRegisterComponent } from './books/register/register.component';
import { AuthGuard } from './user/auth-guard.activate';
import { LoginComponent } from './user/login/login.component';
import { LogoutComponent } from './user/logout/logout.component';

const routes: Routes = [
  { path: '', redirectTo: '/auth/login', pathMatch: 'full' },
  { path: 'auth/login', component: LoginComponent},
  { path: 'auth/logout', component: LogoutComponent},
  { path: 'books', component: BooksListComponent, canActivate: [AuthGuard]},
  { path: 'books/create', component: BooksRegisterComponent, canActivate: [AuthGuard] },
  { path: 'books/edit/:id', component: BooksRegisterComponent, canActivate: [AuthGuard] },
  { path: 'books/:id', component: BooksDetailComponent, canActivate: [AuthGuard] },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
