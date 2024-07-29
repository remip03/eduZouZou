import { RouterModule, Routes } from '@angular/router';
import { NgModule } from '@angular/core';
import { HomeComponent } from './pages/home/home.component';
import { EcolesComponent } from './pages/ecoles/ecoles.component';
import { AuthGuard } from './auth.guard';
import { EcoleComponent } from './pages/ecoles/ecole/ecole.component';
import { AddEcoleComponent } from './pages/ecoles/add-ecole/add-ecole.component';

export const routes: Routes = [

  { path: '', redirectTo: 'home', pathMatch: 'full' },

  { path: 'home', component: HomeComponent },

  { path: 'ecoles', component: EcolesComponent },

  { path: 'ecoles/:id', component: EcoleComponent },

  { path: 'newEcole', component: AddEcoleComponent },

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
