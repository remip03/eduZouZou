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
import { CoursDetailComponent } from './pages/cours/cours-detail/cours-detail.component';
import { ActivitesDetailComponent } from './pages/activites/activites-detail/activites-detail.component';
import { ActivitesMenuComponent } from './pages/activites/activites-menu/activites-menu.component';
import { AuthGuard } from './auth.guard';
import { DevoirMenuComponent } from './pages/activites/activites-menu/devoir-menu/devoir-menu.component';
import { ProjetMenuComponent } from './pages/activites/activites-menu/projet-menu/projet-menu.component';
import { QuizMenuComponent } from './pages/activites/activites-menu/quiz-menu/quiz-menu.component';
import { EvenementMenuComponent } from './pages/activites/activites-menu/evenement-menu/evenement-menu.component';

export const routes: Routes = [
  { path: '', redirectTo: 'Accueil', pathMatch: 'full' },

  { path: 'Accueil', component: AccueilComponent },

  { path: 'ensavoirplus', component: EnSavoirPlusComponent },

  { path: 'conInsc', component: ConInscComponent },

  // Chemin page Informations
  { path: 'rgpd', component: RgpdComponent },

  { path: 'cgu', component: CguComponent },

  { path: 'supportassistance', component: SupportEtAssistanceComponent },

  // Chemin pour les utilisateurs
  { path: 'users', component: UsersComponent, canActivate: [AuthGuard] },

  { path: 'users/:id', component: UserComponent, canActivate: [AuthGuard] },

  {
    path: 'users/:id/edit',
    component: UpdateUserComponent,
    canActivate: [AuthGuard],
    data: { expectedRole: 'ROLE_ADMIN, ROLE_SUPERADMIN' },
  },

  // Chemin pour le register
  { path: 'register', component: RegisterComponent },

  // Chemin pour le profil
  { path: 'profil', component: ProfilComponent, canActivate: [AuthGuard] },

  {
    path: 'modifierProfil',
    component: ModifierProfilComponent,
    canActivate: [AuthGuard],
  },

  // Chemin pour les activités
  {
    path: 'activites',
    component: ActivitesComponent,
    canActivate: [AuthGuard],
  },

  {
    path: 'activitesMenu',
    component: ActivitesMenuComponent,
    canActivate: [AuthGuard],
  },

  {
    path: 'creerActivites',
    component: CreateActiviteComponent,
    canActivate: [AuthGuard],
    data: { expectedRole: 'ROLE_ADMIN, ROLE_SUPERADMIN, ROLE_PROF' },
  },

  {
    path: 'activites/:id',
    component: UpdateActiviteComponent,
    canActivate: [AuthGuard],
  },

  {
    path: 'activitesDetail/:id',
    component: ActivitesDetailComponent,
    canActivate: [AuthGuard],
  },

  {
    path: 'devoirMenu',
    component: DevoirMenuComponent,
    canActivate: [AuthGuard],
  },

  {
    path: 'projetMenu',
    component: ProjetMenuComponent,
    canActivate: [AuthGuard],
  },

  { path: 'quizMenu', component: QuizMenuComponent, canActivate: [AuthGuard] },

  {
    path: 'evenementMenu',
    component: EvenementMenuComponent,
    canActivate: [AuthGuard],
  },

  // Chemin pour les cours
  { path: 'cours', component: CoursComponent, canActivate: [AuthGuard] },

  {
    path: 'creerCours',
    component: CreateCoursComponent,
    canActivate: [AuthGuard],
    data: { expectedRole: 'ROLE_ADMIN, ROLE_SUPERADMIN, ROLE_PROF' },
  },

  {
    path: 'cours/:id',
    component: UpdateCoursComponent,
    canActivate: [AuthGuard],
  },

  {
    path: 'coursDetail/:id',
    component: CoursDetailComponent,
    canActivate: [AuthGuard],
  },

  // Chemin pour les écoles
  { path: 'ecoles', component: EcolesComponent, canActivate: [AuthGuard] },

  { path: 'ecoles/:id', component: EcoleComponent, canActivate: [AuthGuard] },

  {
    path: 'ecoles/:id/edit',
    component: UpdateEcoleComponent,
    canActivate: [AuthGuard],
    data: { expectedRole: 'ROLE_ADMIN, ROLE_SUPERADMIN' },
  },

  {
    path: 'newEcole',
    component: AddEcoleComponent,
    canActivate: [AuthGuard],
    data: { expectedRole: 'ROLE_ADMIN, ROLE_SUPERADMIN' },
  },

  { path: 'ecoleActualites/:id', component: EcoleActualitesComponent },

  { path: 'ecoleEtablissement/:id', component: EcoleEtablissementComponent },

  // Chemin pour les classes
  { path: 'classes', component: ClassesComponent, canActivate: [AuthGuard] },

  { path: 'classes/:id', component: ClasseComponent, canActivate: [AuthGuard] },

  {
    path: 'classes/:id/edit',
    component: UpdateClasseComponent,
    canActivate: [AuthGuard],
    data: { expectedRole: 'ROLE_ADMIN, ROLE_SUPERADMIN, ROLE_PROF' },
  },

  {
    path: 'newClasse',
    component: AddClasseComponent,
    canActivate: [AuthGuard],
    data: { expectedRole: 'ROLE_ADMIN, ROLE_SUPERADMIN, ROLE_PROF' },
  },

  // Chemin pour les enfants
  { path: 'enfants', component: EnfantsComponent, canActivate: [AuthGuard] },

  { path: 'enfants/:id', component: EnfantComponent, canActivate: [AuthGuard] },

  {
    path: 'enfants/:id/edit',
    component: UpdateEnfantComponent,
    canActivate: [AuthGuard],
    data: { expectedRole: 'ROLE_ADMIN, ROLE_SUPERADMIN' },
  },

  {
    path: 'newEnfant',
    component: AddEnfantComponent,
    canActivate: [AuthGuard],
    data: { expectedRole: 'ROLE_ADMIN, ROLE_SUPERADMIN' },
  },

  // Chemin pour le forum
  { path: 'forum', component: ForumComponent, canActivate: [AuthGuard] },

  // Chemin pour le login
  { path: 'login', component: LoginComponent },

  { path: 'accueilCo', component: AccueilCoComponent },

  // Chemin pour la messagerie
  {
    path: 'messagerie',
    component: MessagerieComponent,
    canActivate: [AuthGuard],
  },

  { path: 'messages', component: MessageComponent, canActivate: [AuthGuard] },

  {
    path: 'messageDetail/:id',
    component: MessagesDetailComponent,
    canActivate: [AuthGuard],
  },

  {
    path: 'messagesCreate',
    component: AddMessageComponent,
    canActivate: [AuthGuard],
  },

  {
    path: 'messagesUpdate/:id',
    component: UpdateMsgComponent,
    canActivate: [AuthGuard],
  },

  // Chemin pour le profil
  {
    path: 'decoProfil',
    component: DecoProfilComponent,
    canActivate: [AuthGuard],
  },

  { path: 'suivis', component: ProfilComponent, canActivate: [AuthGuard] },

  {
    path: 'modifProfil',
    component: ModifierProfilComponent,
    canActivate: [AuthGuard],
  },

  {
    path: 'modifMdp',
    component: ModifierMdpComponent,
    canActivate: [AuthGuard],
  },

  {
    path: 'suppCompte',
    component: SuppCompteComponent,
    canActivate: [AuthGuard],
  },

  { path: '**', component: NotFoundComponent },
];
