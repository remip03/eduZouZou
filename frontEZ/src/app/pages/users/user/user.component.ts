import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import User from '../../../models/user.models';
import { AuthService } from '../../../services/auth.service';
import { UserService } from '../../../services/user.service';
import { ReturnBtnComponent } from "../../../commons/return-btn/return-btn.component";

@Component({
  selector: 'app-user',
  standalone: true,
  imports: [RouterLink, CommonModule, ReturnBtnComponent],
  templateUrl: './user.component.html',
  styleUrl: './user.component.css'
})
export class UserComponent implements OnInit {
  detail!: User; // Propriété pour stocker les détails de l'utilisateur
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur

  // Constructeur du composant, injecte Router, ActivatedRoute, UserService et AuthService
  constructor(private router: Router,
    private route: ActivatedRoute,
    private userService: UserService,
    private authService: AuthService
  ) { }


  // Méthode pour s'abonner aux détails de l'user
  private subscribeUser(id: number) {
    this.userService.getUser(id).subscribe((response) => {
      this.detail = response; // Met à jour la propriété détail avec la réponse
    });
  }

  // Méthode pour vérifier et s'abonner à l'user en fonction de l'id
  private setSubscribe(id: string | null) {
    if (id && !isNaN(+id)) { // Vérifie si l'id est valide
      this.subscribeUser(+id); // Si l'id est valide, s'abonner aux détails de l'user
    } else if (!id) {
      this.router.navigate(['not-found']);
    }
  }

  // Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id') // Récupère l'id de l'user depuis les paramètres de la route
    this.setSubscribe(id); // Appel la méthode setSubscribe avec l'id récupéré
    this.role = this.authService.getRole(); // Récupère le rôle de l'utilisateur depuis le AuthService
  }

  // Méthode pour confirmer la suppression de l'user
  confirmDelete(): void {
    // Affiche une boîte de dialogue de confirmation
    if (confirm('Êtes vous sûr de vouloir supprimer l\'user ??')) {
      // Si l'utilisateur confirme, appelle la méthode deleteUser
      this.deleteUser();
    }
  }

  // Méthode pour supprimer l'user
  deleteUser(): void {
    // Vérifie si l'user est défini
    if (this.detail) {
      // Appelle le service pour supprimer l'user et s'abonne à la réponse
      this.userService.deleteUser(this.detail.id).subscribe(() => {
        // Redirige vers la liste des users après la suppression
        this.router.navigate(['/users']);
      });
    }
  }
}
