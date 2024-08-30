import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../../../../services/auth.service';
import { UserService } from '../../../../services/user.service';
import { catchError, map, Observable, of } from 'rxjs';

@Component({
  selector: 'app-confirm-delete-modal',
  standalone: true,
  imports: [],
  templateUrl: './confirm-delete-modal.component.html',
  styleUrl: './confirm-delete-modal.component.css'
})
export class ConfirmDeleteModalComponent {
  constructor(private router: Router, private authService: AuthService, private userService: UserService) { }

  // Méthode pour ouvrir la modal de confirmation de suppression
  openModal() {
    const modal = document.getElementById('modalDelete');
    if (modal) {
      modal.classList.remove('hidden'); // Affiche la modal en supprimant la classe 'hidden'
    }
  }

  // Méthode pour fermer la modal de confirmation de suppression
  closeModal() {
    const modal = document.getElementById('modalDelete');
    if (modal) {
      modal.classList.add('hidden'); // Cache la modal en ajoutant la classe 'hidden'
    }
  }

  // Méthode pour récupérer l'ID de l'utilisateur à partir du token
  getUserIdFromToken(): Observable<number> {
    const token = localStorage.getItem('token'); // Récupère le token depuis le localStorage
    if (token) {
      try {
        const payload = JSON.parse(atob(token.split('.')[1])); // Décode le payload du token
        console.log('Payload:', payload); // Ajoute un log pour inspecter le payload
        if (payload && payload.username) {
          // Récupère l'utilisateur par email et retourne son ID
          return this.userService.getUserByEmail(payload.username).pipe(
            map(user => user.id),
            catchError(error => {
              console.error('Erreur lors de la récupération de l\'utilisateur:', error);
              return of(0); // Retourne 0 en cas d'erreur
            })
          );
        } else {
          console.error('Email non trouvé ou invalide dans le payload');
          return of(0); // Retourne 0 si l'email est invalide
        }
      } catch (e) {
        console.error('Erreur lors du décodage du token:', e);
        return of(0); // Retourne 0 en cas d'erreur de décodage
      }
    }
    return of(0); // Retourne 0 si le token n'est pas présent
  }

  // Méthode pour confirmer la suppression du compte
  confirmDelete(): void {
    this.getUserIdFromToken().subscribe(userId => {
      if (userId !== 0) {
        // Supprime l'utilisateur par ID
        this.userService.deleteUser(userId).subscribe({
          next: () => {
            console.log('Utilisateur supprimé avec succès');
            this.closeModal(); // Ferme la modal
            // Déconnecte l'utilisateur
            localStorage.removeItem('token');
            // Redirige vers la page d'accueil
            this.router.navigate(['/']).then(() => {
              // Rafraîchit la page pour appliquer les changements
              window.location.reload();
            });
          },
          error: (err) => {
            console.error('Erreur lors de la suppression de l\'utilisateur:', err);
          }
        });
      } else {
        console.error('ID utilisateur invalide');
      }
    });
  }
}
