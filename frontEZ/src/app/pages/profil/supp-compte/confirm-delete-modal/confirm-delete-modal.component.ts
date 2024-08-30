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

  openModal() {
    const modal = document.getElementById('modalDelete');
    if (modal) {
      modal.classList.remove('hidden');
    }
  }

  closeModal() {
    const modal = document.getElementById('modalDelete');
    if (modal) {
      modal.classList.add('hidden');
    }
  }

  // Méthode pour récupérer l'ID de l'utilisateur à partir du token
  getUserIdFromToken(): Observable<number> {
    const token = localStorage.getItem('token');
    if (token) {
      try {
        const payload = JSON.parse(atob(token.split('.')[1]));
        console.log('Payload:', payload); // Ajoutez ce log pour inspecter le payload
        if (payload && payload.username) {
          return this.userService.getUserByEmail(payload.username).pipe(
            map(user => user.id),
            catchError(error => {
              console.error('Erreur lors de la récupération de l\'utilisateur:', error);
              return of(0);
            })
          );
        } else {
          console.error('Email non trouvé ou invalide dans le payload');
          return of(0);
        }
      } catch (e) {
        console.error('Erreur lors du décodage du token:', e);
        return of(0);
      }
    }
    return of(0);
  }

  // Méthode pour confirmer la suppression du compte
  confirmDelete(): void {
    this.getUserIdFromToken().subscribe(userId => {
      if (userId !== 0) {
        this.userService.deleteUser(userId).subscribe({
          next: () => {
            console.log('Utilisateur supprimé avec succès');
            this.closeModal();
            // Déconnecter l'utilisateur
            localStorage.removeItem('token');
            // Rediriger vers la page d'accueil
            this.router.navigate(['/']).then(() => {
              // Rafraîchir la page pour appliquer les changements;
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
