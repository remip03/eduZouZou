import { Component } from '@angular/core';
import { ReturnBtnComponent } from '../../../commons/return-btn/return-btn.component';
import { SliderProfilComponent } from '../../../commons/slider-profil/slider-profil.component';
import { AuthService } from '../../../services/auth.service';
import { Observable } from 'rxjs';
import { Router } from '@angular/router';
import { CommonModule } from '@angular/common';
import { ConfirmDeleteModalComponent } from './confirm-delete-modal/confirm-delete-modal.component';

@Component({
  selector: 'app-supp-compte',
  standalone: true,
  imports: [ReturnBtnComponent, SliderProfilComponent, CommonModule, ConfirmDeleteModalComponent],
  templateUrl: './supp-compte.component.html',
  styleUrl: './supp-compte.component.css'
})
export class SuppCompteComponent {
  isLoggedIn$: Observable<boolean>; // Observable pour suivre l'état de connexion de l'utilisateur

  constructor(private authService: AuthService, private router: Router) {
    this.isLoggedIn$ = this.authService.isLoggedIn$; // Initialise l'Observable avec celui du service
  }

  // Méthode pour déconnecter l'utilisateur
  logout(): void {
    this.authService.logout(); // Appelle la méthode logout du service AuthService
    this.router.navigate(['/']); // Redirige l'utilisateur vers la page d'accueil
  }

  // Méthode pour confirmer la déconnexion
  confirmLogout(): void {
    const confirmed = window.confirm('Êtes-vous sûr de vouloir vous déconnecter ?'); // Affiche une fenêtre de confirmation
    if (confirmed) {
      this.logout(); // Déconnecte l'utilisateur si la confirmation est positive
    }
  }

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
}
