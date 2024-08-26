import { ProtectionDesDonneesComponent } from './commons/footer/protection-des-donnees/protection-des-donnees.component';
import { ConditionsGeneralesDutilisationComponent } from './commons/footer/conditions-generales-dutilisation/conditions-generales-dutilisation.component';
import { Routes } from '@angular/router';
import { AccueilComponent } from './pages/accueil/accueil.component';
import { NotFoundComponent } from './pages/not-found/not-found.component';
import { ForumComponent } from './pages/forum/forum.component';
import { LoginComponent } from './pages/login/login.component';
import { RegisterComponent } from './pages/login/register/register.component';
import { ActivitesComponent } from './pages/activites/activites.component';
import { ProfilComponent } from './pages/profil/profil.component';
import { ModifierProfilComponent } from './pages/profil/modifier-profil/modifier-profil.component';
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
import { MessageComponent } from './pages/message/message.component';
import { AddMessageComponent } from './pages/message/add-message/add-message.component';
import { UpdateMsgComponent } from './pages/message/update-msg/update-msg.component';
import { UsersComponent } from './pages/users/users.component';
import { UserComponent } from './pages/users/user/user.component';
import { UpdateUserComponent } from './pages/users/update-user/update-user.component';
import { RgpdComponent } from './pages/rgpd/rgpd.component';
import { CguComponent } from './pages/cgu/cgu.component';
import { AccueilCoComponent } from './pages/accueil-co/accueil-co.component';
import { ConInscComponent } from './pages/con-insc/con-insc.component';
import { DecoProfilComponent } from './pages/deco-profil/deco-profil.component';
import { ModifierMdpComponent } from './pages/profil/modifier-mdp/modifier-mdp.component';
import { SuppCompteComponent } from './pages/profil/supp-compte/supp-compte.component';
import { EnSavoirPlusComponent } from './pages/en-savoir-plus/en-savoir-plus.component';
import { EcoleEtablissementComponent } from './pages/ecoles/ecole-etablissement/ecole-etablissement.component';
import { EcoleActualitesComponent } from './pages/ecoles/ecole-actualites/ecole-actualites.component';
import { SupportEtAssistanceComponent } from './commons/footer/support-et-assistance/support-et-assistance.component';
import { MessagerieComponent } from './pages/messagerie/messagerie.component';
import { MessagesDetailComponent } from './pages/messagerie/messages-detail/messages-detail.component';

export const routes: Routes = [
  { path: '', redirectTo: 'Accueil', pathMatch: 'full' },

  { path: 'Accueil', component: AccueilComponent },

  { path: 'rgpd', component: RgpdComponent },

  { path: 'cgu', component: CguComponent },

  { path: 'accueilCo', component: AccueilCoComponent },

  { path: 'conInsc', component: ConInscComponent },

  { path: 'decoProfil', component: DecoProfilComponent },

  { path: 'suivis', component: ProfilComponent },

  { path: 'modifProfil', component: ModifierProfilComponent },

  { path: 'modifMdp', component: ModifierMdpComponent },

  { path: 'suppCompte', component: SuppCompteComponent },

  { path: 'ensavoirplus', component: EnSavoirPlusComponent },

  { path: 'supportassistance', component: SupportEtAssistanceComponent },

  // Chemin pour les utilisateurs
  { path: 'users', component: UsersComponent },

  { path: 'users/:id', component: UserComponent },

  { path: 'users/:id/edit', component: UpdateUserComponent },

  // Chemin pour le register
  { path: 'register', component: RegisterComponent },

  // Chemin pour le profil
  { path: 'profil', component: ProfilComponent },

  { path: 'modifierProfil', component: ModifierProfilComponent },

  // Chemin pour les activités
  { path: 'activites', component: ActivitesComponent },

  { path: 'creerActivites', component: CreateActiviteComponent },

  { path: 'activites/:id', component: UpdateActiviteComponent },

  // Chemin pour les cours
  { path: 'cours', component: CoursComponent },

  { path: 'creerCours', component: CreateCoursComponent },

  { path: 'cours/:id', component: UpdateCoursComponent },

  // Chemin pour les écoles
  { path: 'ecoles', component: EcolesComponent },

  { path: 'ecoles/:id', component: EcoleComponent },

  { path: 'ecoles/:id/edit', component: UpdateEcoleComponent },

  { path: 'newEcole', component: AddEcoleComponent },

  { path: 'ecoleActualites/:id', component: EcoleActualitesComponent },

  { path: 'ecoleEtablissement/:id', component: EcoleEtablissementComponent },

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

  // Chemin pour le forum
  { path: 'forum', component: ForumComponent },

  // Chemin pour le login
  { path: 'login', component: LoginComponent },

  // Chemin pour la messagerie
  { path: 'messagerie', component: MessagerieComponent },

  { path: 'messages', component: MessageComponent },

  { path: 'messageDetail/:id', component: MessagesDetailComponent },

  { path: 'messagesCreate', component: AddMessageComponent },

  { path: 'messagesUpdate/:id', component: UpdateMsgComponent },

  { path: '**', component: NotFoundComponent },
];
