import { Routes } from '@angular/router';
import { AccueilComponent } from './pages/accueil/accueil.component';
import { NotFoundComponent } from './pages/not-found/not-found.component';
import { ClasseComponent } from './pages/classe/classe.component';
import { EcoleComponent } from './pages/ecole/ecole.component';
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

export const routes: Routes = [

  {path: '', redirectTo: 'Accueil', pathMatch: 'full'},
  {path: 'Accueil', component: AccueilComponent},

  {path: 'Classe', component: ClasseComponent},

  {path: 'Activite', component: ActivitesComponent},

  {path: 'Cours', component: CoursComponent},

  {path: 'Ecole', component: EcoleComponent},

  {path: 'Forum', component: ForumComponent},

  {path: 'Login', component: LoginComponent},

  {path: 'Register', component: RegisterComponent},

  {path: 'Profil', component: ProfilComponent},

  {path: 'Competences', component: CompetencesComponent},

  {path: 'Messagerie', component: MessagerieComponent},

  {path: 'Modifier-Profil', component: ModifierProfilComponent},

  {path: 'Resultats', component: ResultatsComponent},

  {path: '**', component: NotFoundComponent}

];
