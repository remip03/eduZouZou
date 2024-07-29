import { Routes } from '@angular/router';
import { AccueilComponent } from './pages/accueil/accueil.component';
import { NotFoundComponent } from './pages/not-found/not-found.component';
import { ForumComponent } from './pages/forum/forum.component';
import { LoginComponent } from './pages/login/login.component';
import { RegisterComponent } from './pages/login/register/register.component';
import { ActivitesComponent } from './pages/activites/activites.component';
import { ProfilComponent } from './pages/profil/profil.component';
import { CompetencesComponent } from './pages/profil/competences/competences.component';
import { MessagerieComponent } from './pages/profil/messagerie/messagerie.component';
import { ModifierProfilComponent } from './pages/profil/modifier-profil/modifier-profil.component';
import { ResultatsComponent } from './pages/profil/resultats/resultats.component';
import { AddEcoleComponent } from './pages/ecoles/add-ecole/add-ecole.component';
import { EcolesComponent } from './pages/ecoles/ecoles.component';
import { EcoleComponent } from './pages/ecoles/ecole/ecole.component';
import { UpdateEcoleComponent } from './pages/ecoles/update-ecole/update-ecole.component';
import { CoursComponent } from './pages/cours/cours.component';
import { ClassesComponent } from './pages/classes/classes.component';
import { ClasseComponent } from './pages/classes/classe/classe.component';
import { UpdateClasseComponent } from './pages/classes/classe/update-classe/update-classe.component';
import { AddClasseComponent } from './pages/classes/classe/add-classe/add-classe.component';

export const routes: Routes = [

  { path: '', redirectTo: 'Accueil', pathMatch: 'full' },

  { path: 'Accueil', component: AccueilComponent },

  // Chemin pour les écoles
  { path: 'ecoles', component: EcolesComponent },

  { path: 'ecoles/:id', component: EcoleComponent },

  { path: 'ecoles/:id/edit', component: UpdateEcoleComponent },

  { path: 'newEcole', component: AddEcoleComponent },

  // Chemin pour les classes
  { path: 'classes', component: ClassesComponent },

  { path: 'classes/:id', component: ClasseComponent },

  { path: 'classes/:id/edit', component: UpdateClasseComponent },

  { path: 'newClasse', component: AddClasseComponent },

  { path: 'activites', component: ActivitesComponent },

  { path: 'cours', component: CoursComponent },

  { path: 'forum', component: ForumComponent },

  { path: 'login', component: LoginComponent },

  { path: 'register', component: RegisterComponent },

  { path: 'profil', component: ProfilComponent },

  { path: 'competences', component: CompetencesComponent },

  { path: 'messagerie', component: MessagerieComponent },

  { path: 'modifierProfil', component: ModifierProfilComponent },

  { path: 'resultats', component: ResultatsComponent },

  { path: '**', component: NotFoundComponent }

];
