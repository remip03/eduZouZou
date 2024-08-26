import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { Router, RouterLink } from '@angular/router';
import Classe from '../../../models/classe.model';
import { EnfantService } from '../../../services/enfant.service';
import { ClasseService } from '../../../services/classe.service';
import { ReturnBtnComponent } from "../../../commons/return-btn/return-btn.component";

@Component({
  selector: 'app-add-enfant',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule, RouterLink, ReturnBtnComponent],
  templateUrl: './add-enfant.component.html',
  styleUrl: './add-enfant.component.css'
})
export class AddEnfantComponent {
  enfant: FormGroup; // Déclaration du formulaire de type FormGroup
  submitted: boolean = false; // Indicateur de soumission du formulaire
  classes: Classe[] = []; // Liste des écoles pour le menu déroulant

  // Constructeur avec injection des services nécessaires
  constructor(
    private formBuilder: FormBuilder,
    private router: Router,
    private enfantService: EnfantService,
    private classeService: ClasseService) {

    // Initialisation du formulaire avec des champs et des validateurs
    this.enfant = this.formBuilder.group({
      lastNameE: ['', Validators.required],
      firstNameE: ['', Validators.required],
      birthDateE: ['', Validators.required],
      classeId: ['', Validators.required],
    });
  }

  ngOnInit(): void {
    // Récupère la liste des enfants lors de l'initialisation du composant
    this.classeService.getClasses().subscribe((data: Classe[]) => {
      this.classes = data;
    });
  }

  // Méthode privée pour ajouter une écolé
  private addEnfant() {
    // Appel du service pour créer un enfant avec les valeurs du formulaire
    this.enfantService.createEnfant(this.enfant.value).subscribe({
      next: () => {
        // En cas de succès, afficher une alerte, réinitialiser le formulaire et rediriger
        alert("Enfant ajoutée avec succès !");
        this.enfant.reset();
        this.submitted = false;
        this.router.navigate(['/enfants']);
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
    if (this.enfant.invalid) {
      // Si le formulaire est invalide, ne pas continuer
      return false;
    } else {
      // Si le formulaire est valide, appeler la méthode pour ajouter une école
      this.addEnfant();
      return true;
    }
  }

  // Getter pour accéder facilement aux contrôles du formulaire dans le template
  get form() {
    return this.enfant.controls;
  }
}
