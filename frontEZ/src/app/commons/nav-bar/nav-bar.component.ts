import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';

import { MessageComponent } from '../../pages/message/message.component';

import { CommonModule } from '@angular/common';
import { Observable } from 'rxjs';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-nav-bar',
  standalone: true,

  imports: [RouterLink, CommonModule],
  templateUrl: './nav-bar.component.html',
  styleUrl: './nav-bar.component.css',
})
export class NavBarComponent {
  isLoggedIn$: Observable<boolean>; // Observable pour suivre l'état de connexion de l'utilisateur

  // Constructeur du composant, injecte le service AuthService
  constructor(private authService: AuthService) {
    this.isLoggedIn$ = this.authService.isLoggedIn$; // Initialise l'Observable avec celui du service
  }

  //Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void { }

  // Méthode pour déconnecter l'utilisateur
  logout(): void {
    this.authService.logout(); // Appelle la méthode logout du service AuthService
  }

  // Méthode pour ouvrir le menu déroulant
  openModal() {
    console.log('openModal called');
    const modal = document.getElementById('navbarSupportedContent');
    if (modal) {
      modal.classList.remove('hiddenMenu');
      console.log('Classes after removing hiddenMenu:', modal.className);
    }
  }

  // Méthode pour fermer le menu déroulant
  closeModal() {
    console.log('closeModal called');
    const modal = document.getElementById('navbarSupportedContent');
    if (modal) {
      modal.classList.add('hiddenMenu');
      console.log('Classes after adding hiddenMenu:', modal.className);
    }
  }
}
