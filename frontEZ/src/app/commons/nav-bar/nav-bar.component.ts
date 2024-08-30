import { Component, HostListener } from '@angular/core';
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
  isClassesDropdownOpen = false;

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
    const modal = document.getElementById('navbarSupportedContent');
    if (modal) {
      modal.classList.remove('hiddenMenu');
    }
  }

  // Méthode pour fermer le menu déroulant
  closeModal() {
    const modal = document.getElementById('navbarSupportedContent');
    if (modal) {
      modal.classList.add('hiddenMenu');
    }
  }

  // Méthode pour basculer l'état du menu déroulant
  toggleClassesDropdown() {
    this.isClassesDropdownOpen = !this.isClassesDropdownOpen;
  }

  @HostListener('document:click', ['$event'])
  onDocumentClick(event: MouseEvent): void {
    const target = event.target as HTMLElement;
    const dropdown = document.querySelector('.dropdown');
    const navLink = document.querySelector('.navLink');

    if (dropdown && navLink && !navLink.contains(target) && !dropdown.contains(target)) {
      this.isClassesDropdownOpen = false;
    }
  }
}

