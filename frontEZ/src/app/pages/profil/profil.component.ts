import { Component } from '@angular/core';
import Ecole from '../../models/ecole.modelt';
import { FormBuilder, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Router, RouterLink } from '@angular/router';
import { AuthService } from '../../services/auth.service';
import { EcoleService } from '../../services/ecole.service';

@Component({
  selector: 'app-profil',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule, RouterLink, FormsModule],
  templateUrl: './profil.component.html',
  styleUrl: './profil.component.css'
})
export class ProfilComponent {
  user: FormGroup; // Déclaration du formulaire de type FormGroup
  submitted: boolean = false; // Indicateur de soumission du formulaire
  ecoles: Ecole[] = []; // Liste des écoles
  selectedEcoleId: number | null = null; // ID de l'école sélectionnée

  constructor(
    private formBuilder: FormBuilder,
    private router: Router,
    private authService: AuthService,
    private ecoleService: EcoleService
  ) {
    // Initialisation du formulaire avec les contrôles et leurs validateurs
    this.user = this.formBuilder.group(
      {
        username: [
          '',
          [
            Validators.required,
            Validators.email,
            // Validators.pattern(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/g),
          ],
        ], // Ajoutez Validators.email pour valider l'email
        lastName: [
          '',
          [
            Validators.required,
            // Validators.pattern(/^[a-zA-Z]+$/),
          ],
        ],

        firstName: [
          '',
          [
            Validators.required,
            // Validators.pattern(/^[a-zA-Z]+$/),
          ],
        ],

        tel: [
          '',
          [
            Validators.required,
            // Validators.pattern(/^[0-9]{10}$/),
          ],
        ],

        adresse: ['', [Validators.required]],
        ecoleId: ['', Validators.required],
      },
    );
  }

  // Méthode appelée lors du changement de sélection d'une école
  onEcoleChange(event: Event): void {
    const selectElement = event.target as HTMLSelectElement;
    this.selectedEcoleId = Number(selectElement.value);
    this.user.patchValue({ ecoleId: this.selectedEcoleId });
  }
}
