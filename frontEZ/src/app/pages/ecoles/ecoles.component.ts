import { Component, OnInit } from '@angular/core';
import Ecole from '../../models/ecole.modelt';
import { EcoleService } from '../../services/ecole.service';
import { RouterLink } from '@angular/router';
import { CommonModule } from '@angular/common';
import { AuthService } from '../../services/auth.service';
import { ReturnBtnComponent } from "../../commons/return-btn/return-btn.component";

@Component({
  selector: 'app-ecoles',
  standalone: true,
  imports: [RouterLink, CommonModule, ReturnBtnComponent],
  templateUrl: './ecoles.component.html',
  styleUrl: './ecoles.component.css'
})
export class EcolesComponent implements OnInit {
  ecoles: Ecole[] = []; // Propriété pour stocker la liste des écoles
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur

  // Constructeur du composant, injecte EcoleService
  constructor(private ecoleService: EcoleService, private authService: AuthService) { }

  // Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void {
    this.loadEcoles();
    this.role = this.authService.getRole();
  }

  // Méthode pour charger la liste des écoles
  loadEcoles(): void {
    this.ecoleService.getEcoles().subscribe((data: Ecole[]) => {
      this.ecoles = data;
    });
  }
}
