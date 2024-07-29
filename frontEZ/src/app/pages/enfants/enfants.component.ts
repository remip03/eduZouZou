import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import Enfant from '../../models/enfant.model';
import { EnfantService } from '../../services/enfant.service';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-enfants',
  standalone: true,
  imports: [RouterLink, CommonModule],
  templateUrl: './enfants.component.html',
  styleUrl: './enfants.component.css'
})
export class EnfantsComponent implements OnInit {
  enfants: Enfant[] = []; // Propriété pour stocker la liste des enfants
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur

  // Constructeur du composant, injecte EnfantService
  constructor(private enfantService: EnfantService, private authService: AuthService) { }

  // Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void {
    this.loadClasses();
    this.role = this.authService.getRole();
  }

  // Méthode pour charger la liste des enfants
  loadClasses(): void {
    this.enfantService.getEnfants().subscribe((data: Enfant[]) => {
      this.enfants = data;
    });
  }
}
