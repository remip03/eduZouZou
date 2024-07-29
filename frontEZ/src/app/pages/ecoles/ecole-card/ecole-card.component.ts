import { Component, Input } from '@angular/core';
import { AuthService } from '../../../services/auth.service';
import { RouterLink } from '@angular/router';
import { CommonModule, SlicePipe } from '@angular/common';

@Component({
  selector: 'app-ecole-card',
  standalone: true,
  imports: [RouterLink, SlicePipe, CommonModule],
  templateUrl: './ecole-card.component.html',
  styleUrl: './ecole-card.component.css'
})
export class EcoleCardComponent {
  @Input() ecole!: any; // Propriété d'entrée pour recevoir les détails de l'auteur

  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur

  // Constructeur du composant, injecte AuthService
  constructor(private authService: AuthService) { }

  // Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void {
    // Récupère le rôle de l'utilisateur depuis le AuthService
    this.role = this.authService.getRole();
  }
}
