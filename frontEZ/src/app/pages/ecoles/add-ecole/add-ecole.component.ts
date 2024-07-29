import { Component } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { Router, RouterLink } from '@angular/router';
import { EcoleService } from '../../../services/ecole.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-add-ecole',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule, RouterLink],
  templateUrl: './add-ecole.component.html',
  styleUrl: './add-ecole.component.css'
})
export class AddEcoleComponent {
  ecole: FormGroup; // Déclaration du formulaire de type FormGroup
  submitted: boolean = false; // Indicateur de soumission du formulaire

  // Constructeur avec injection des services nécessaires
  constructor(private formBuilder: FormBuilder, private router: Router, private ecoleService: EcoleService) {
    // Initialisation du formulaire avec des champs et des validateurs
    this.ecole = this.formBuilder.group({
      nameEc: ['', Validators.required],
      addressEc: ['', Validators.required],
      phoneEc: ['', Validators.required],
      emailEc: ['', [Validators.required, Validators.email]],
    });
  }

  // Méthode privée pour ajouter une écolé
  private addEcole() {
    // Appel du service pour créer une école avec les valeurs du formulaire
    this.ecoleService.createEcole(this.ecole.value).subscribe({
      next: () => {
        // En cas de succès, afficher une alerte, réinitialiser le formulaire et rediriger
        alert("Ecole ajoutée avec succès !");
        this.ecole.reset();
        this.submitted = false;
        this.router.navigate(['/ecoles']);
      },
      error: (error) => {
        // En cas d'erreur, afficher un message d'erreur dans la console
        console.error("Erreur lors de l'ajout de l'école", error);
      }
    });
  }

  // Méthode appelée lors de la soumission du formulaire
  onSubmit() {
    this.submitted = true; // Indique que le formulaire a été soumis
    if (this.ecole.invalid) {
      // Si le formulaire est invalide, ne pas continuer
      return false;
    } else {
      // Si le formulaire est valide, appeler la méthode pour ajouter une école
      this.addEcole();
      return true;
    }
  }

  // Getter pour accéder facilement aux contrôles du formulaire dans le template
  get form() {
    return this.ecole.controls;
  }

}
