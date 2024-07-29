import { Routes } from '@angular/router';
import { NotFoundComponent } from './commons/not-found/not-found.component';
import { NavBarComponent } from './commons/nav-bar/nav-bar.component';
import { MessageComponent } from './components/message/message.component';

export const routes: Routes = [
  { path: '', redirectTo: 'accueil', pathMatch: 'full' },

  { path: 'accueil', component: NavBarComponent },

  { path: 'message', component: MessageComponent },

  { path: '**', component: NotFoundComponent },
];
