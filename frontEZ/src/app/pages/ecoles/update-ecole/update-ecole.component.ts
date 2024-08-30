import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { EcoleService } from '../../../services/ecole.service';
import Ecole from '../../../models/ecole.modelt';
import { ReturnBtnComponent } from "../../../commons/return-btn/return-btn.component";

@Component({
  selector: 'app-update-ecole',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule, RouterLink, ReturnBtnComponent],
  templateUrl: './update-ecole.component.html',
  styleUrl: './update-ecole.component.css'
})
export class UpdateEcoleComponent {
  ecole: FormGroup; // Déclare un formulaire réactif pour l'école
  submitted: boolean = false; // Indique si le formulaire a été soumis
  ecoleId?: number; // ID de l'école à modifier

  constructor(
    private formBuilder: FormBuilder, // Service pour construire le formulaire
    private route: ActivatedRoute, // Service pour accéder aux informations de la route active
    private router: Router, // Service pour la navigation
    private ecoleService: EcoleService // Service pour les opérations sur les écoles
  ) {
    // Initialise le formulaire avec des champs et des validateurs
    this.ecole = this.formBuilder.group({
      nameEc: ['', Validators.required],
      adresseEc: ['', Validators.required],
      telEc: ['', Validators.required],
      mailEc: ['', [Validators.required, Validators.email]],
    });
  }

  ngOnInit(): void {
    // Récupère l'ID de l'école à partir des paramètres de la route
    this.ecoleId = Number(this.route.snapshot.paramMap.get('id'));
    if (this.ecoleId) {
      // Si l'ID de l'école est valide, récupère les données de l'école
      this.ecoleService.getEcole(this.ecoleId).subscribe((data: Ecole) => {
        this.ecole.patchValue(data); // Met à jour le formulaire avec les données de l'école
      });
    }
  }

  onSubmit(): void {
    this.submitted = true; // Marque le formulaire comme soumis
    if (this.ecole.invalid) {
      return; // Si le formulaire est invalide, ne pas continuer
    }
    if (this.ecoleId) {
      // Si l'ID de l'école est valide, met à jour l'école
      const updatedEcole = { ...this.ecole.value, id: this.ecoleId };
      this.ecoleService.updateEcole(updatedEcole).subscribe({
        next: () => {
          alert('École mise à jour avec succès !'); // Affiche un message de succès
          this.router.navigate(['/ecoles']); // Redirige vers la liste des écoles
        },
        error: (error) => {
          console.log('Erreur lors de la mise à jour de l\'école', error); // Affiche une erreur en cas d'échec
        }
      });
    }
  }

  get form() {
    return this.ecole.controls; // Getter pour accéder aux contrôles du formulaire
  }
}
