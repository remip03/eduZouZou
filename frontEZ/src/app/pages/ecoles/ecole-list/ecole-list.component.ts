import { Component, Input } from '@angular/core';
import { RouterLink } from '@angular/router';
import { CommonModule } from '@angular/common';
import { AuthService } from '../../../services/auth.service';
import { EcoleCardComponent } from '../ecole-card/ecole-card.component';

@Component({
  selector: 'app-ecole-list',
  standalone: true,
  imports: [RouterLink, EcoleCardComponent, CommonModule],
  templateUrl: './ecole-list.component.html',
  styleUrl: './ecole-list.component.css'
})
export class EcoleListComponent {
  @Input() ecoles: any[] = []; // Propriété d'entrée pour recevoir la liste des écoles

  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur

  // Constructeur du composant, injecte AuthService
  constructor(private authService: AuthService) { }

  // Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void {
    // Récupère le rôle de l'utilisateur depuis le AuthService
    this.role = this.authService.getRole();
  }
}
