import { Component } from '@angular/core';
import { AuthService } from '../../services/auth.service';
import { Observable } from 'rxjs';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-deco-profil',
  standalone: true,
  imports: [RouterLink],
  templateUrl: './deco-profil.component.html',
  styleUrl: './deco-profil.component.css'
})
export class DecoProfilComponent {
  isLoggedIn$: Observable<boolean>; // Observable pour suivre l'état de connexion de l'utilisateur

  constructor(private authService: AuthService) {
    this.isLoggedIn$ = this.authService.isLoggedIn$; // Initialise l'Observable avec celui du service
  }

  //Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void { }

  // Méthode pour déconnecter l'utilisateur
  logout(): void {
    this.authService.logout(); // Appelle la méthode logout du service AuthService
  }

}
