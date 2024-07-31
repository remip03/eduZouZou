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
import { ClasseComponent } from './pages/classes/classe/classe.component';
import { UpdateEcoleComponent } from './pages/ecoles/update-ecole/update-ecole.component';
import { ClassesComponent } from './pages/classes/classes.component';
import { UpdateClasseComponent } from './pages/classes/update-classe/update-classe.component';
import { AddClasseComponent } from './pages/classes/add-classe/add-classe.component';
import { EnfantsComponent } from './pages/enfants/enfants.component';
import { EnfantComponent } from './pages/enfants/enfant/enfant.component';
import { UpdateEnfantComponent } from './pages/enfants/update-enfant/update-enfant.component';
import { AddEnfantComponent } from './pages/enfants/add-enfant/add-enfant.component';
import { CoursComponent } from './pages/cours/cours.component';
import { CreateActiviteComponent } from './pages/activites/create-activite/create-activite.component';
import { UpdateActiviteComponent } from './pages/activites/update-activite/update-activite.component';
import { CreateCoursComponent } from './pages/cours/create-cours/create-cours.component';
import { UpdateCoursComponent } from './pages/cours/update-cours/update-cours.component';
import { MessagesDetailComponent } from './pages/profil/messagerie/messages-detail/messages-detail.component';
import { MessageComponent } from './pages/message/message.component';
import { AddMessageComponent } from './pages/message/add-message/add-message.component';
import { UpdateMsgComponent } from './pages/message/update-msg/update-msg.component';

export const routes: Routes = [
  { path: '', redirectTo: 'Accueil', pathMatch: 'full' },
  { path: 'Accueil', component: AccueilComponent },

  { path: 'Accueil', component: AccueilComponent },

  { path: 'activites', component: ActivitesComponent },

  { path: 'createActivites', component: CreateActiviteComponent },

  { path: 'activites/:id', component: UpdateActiviteComponent },

  { path: 'cours', component: CoursComponent },

  { path: 'createCours', component: CreateCoursComponent },

  { path: 'cours/:id', component: UpdateCoursComponent },

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

  // Chemin pour les enfants
  { path: 'enfants', component: EnfantsComponent },

  { path: 'enfants/:id', component: EnfantComponent },

  { path: 'enfants/:id/edit', component: UpdateEnfantComponent },

  { path: 'newEnfant', component: AddEnfantComponent },

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
