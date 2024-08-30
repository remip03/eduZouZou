import { Component, EventEmitter, Output } from '@angular/core';
import { ChargementDecoModalComponent } from '../chargement-deco-modal/chargement-deco-modal.component';
import { Router } from '@angular/router';
import { AuthService } from '../../../services/auth.service';
import { ABientotModalComponent } from "../a-bientot-modal/a-bientot-modal.component";

@Component({
  selector: 'app-comfirm-deco-modal',
  standalone: true,
  imports: [ChargementDecoModalComponent, ABientotModalComponent],
  templateUrl: './comfirm-deco-modal.component.html',
  styleUrl: './comfirm-deco-modal.component.css'
})
export class ComfirmDecoModalComponent {
  @Output() close = new EventEmitter<void>();

  constructor(private router: Router, private authService: AuthService) { }

  openModal() {
    const modal = document.getElementById('modalConfirmDeco');
    if (modal) {
      modal.classList.remove('hidden');
    }
    setTimeout(() => {
      this.openABientotModal();
    }, 3000); // 3 secondes de délai
  }

  openABientotModal() {
    const modal = document.getElementById('modalConfirmDeco');
    if (modal) {
      modal.classList.add('hidden');
    }
    const modalABientot = document.getElementById('modalAbientot');
    if (modalABientot) {
      modalABientot.classList.remove('hidden');
    }
    setTimeout(() => {
      this.logout();
    }, 3000); // 3 secondes de délai
  }

  closeModal() {
    const modal = document.getElementById('modalDeconnexion');
    if (modal) {
      modal.classList.add('hidden');
    }
  }

  // Méthode pour déconnecter l'utilisateur
  logout(): void {
    this.authService.logout(); // Appelle la méthode logout du service AuthService
    this.router.navigate(['/']); // Redirige l'utilisateur vers la page d'accueil
  }

}
