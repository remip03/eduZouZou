import { Component } from '@angular/core';
import { EcoleListComponent } from './ecole-list/ecole-list.component';
import Ecole from '../../models/ecole.modelt';
import { EcoleService } from '../../services/ecole.service';

@Component({
  selector: 'app-ecoles',
  standalone: true,
  imports: [EcoleListComponent],
  templateUrl: './ecoles.component.html',
  styleUrl: './ecoles.component.css'
})
export class EcolesComponent {
  ecoles: Ecole[] = []; // Propriété pour stocker la liste des écoles

  // Constructeur du composant, injecte EcoleService
  constructor(private ecoleService: EcoleService) { }

  // Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void {
    this.loadEcoles(); // Charge la liste des écoles
  }

  // Méthode pour charger la liste des écoles
  loadEcoles(): void {
    this.ecoleService.getEcoles().subscribe((data: Ecole[]) => {
      this.ecoles = data; // Met à jour la liste des écoles
    });
  }
}
