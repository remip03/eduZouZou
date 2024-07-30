import { Routes } from '@angular/router';
import { AccueilComponent } from './pages/accueil/accueil.component';
import { NotFoundComponent } from './pages/not-found/not-found.component';
import { ClasseComponent } from './pages/classe/classe.component';
import { ForumComponent } from './pages/forum/forum.component';
import { LoginComponent } from './pages/login/login.component';
import { RegisterComponent } from './pages/login/register/register.component';
import { ActivitesComponent } from './pages/classe/activites/activites.component';
import { CoursComponent } from './pages/classe/cours/cours.component';
import { ProfilComponent } from './pages/profil/profil.component';
import { CompetencesComponent } from './pages/profil/competences/competences.component';
import { MessagerieComponent } from './pages/profil/messagerie/messagerie.component';
import { ModifierProfilComponent } from './pages/profil/modifier-profil/modifier-profil.component';
import { ResultatsComponent } from './pages/profil/resultats/resultats.component';
import { AddEcoleComponent } from './pages/ecoles/add-ecole/add-ecole.component';
import { EcolesComponent } from './pages/ecoles/ecoles.component';
import { EcoleComponent } from './pages/ecoles/ecole/ecole.component';
import { MessageComponent } from './pages/message/message.component';
import { AddMessageComponent } from './pages/message/add-message/add-message.component';
import { UpdateMsgComponent } from './pages/message/update-msg/update-msg.component';
import { MessagesDetailComponent } from './pages/profil/messagerie/messages-detail/messages-detail.component';

export const routes: Routes = [
  { path: '', redirectTo: 'Accueil', pathMatch: 'full' },
  { path: 'Accueil', component: AccueilComponent },

  { path: 'classes', component: ClasseComponent },

  { path: 'activites', component: ActivitesComponent },

  { path: 'cours', component: CoursComponent },

  { path: 'ecoles', component: EcolesComponent },

  { path: 'ecoles/:id', component: EcoleComponent },

  { path: 'newEcole', component: AddEcoleComponent },

  { path: 'forum', component: ForumComponent },

  { path: 'login', component: LoginComponent },

  { path: 'register', component: RegisterComponent },

  { path: 'profil', component: ProfilComponent },

  { path: 'competences', component: CompetencesComponent },

  { path: 'messagerie', component: MessagerieComponent },

  { path: 'messageDetail/:id', component: MessagesDetailComponent },

  { path: 'messages', component: MessageComponent },

  { path: 'messagesCreate', component: AddMessageComponent },

  { path: 'messagesUpdate/:id', component: UpdateMsgComponent },

  { path: 'modifierProfil', component: ModifierProfilComponent },

  { path: 'resultats', component: ResultatsComponent },

  { path: '**', component: NotFoundComponent },
];
