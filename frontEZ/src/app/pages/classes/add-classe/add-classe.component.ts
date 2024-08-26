import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { Router, RouterLink } from '@angular/router';
import Ecole from '../../../models/ecole.modelt';
import { ClasseService } from '../../../services/classe.service';
import { EcoleService } from '../../../services/ecole.service';
import { VariablesGlobales } from '../../../commons/variablesGlobales';
import { ReturnBtnComponent } from "../../../commons/return-btn/return-btn.component";


@Component({
  selector: 'app-add-classe',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule, RouterLink, ReturnBtnComponent],
  templateUrl: './add-classe.component.html',
  styleUrl: './add-classe.component.css'
})
export class AddClasseComponent {
  classe: FormGroup; // Déclaration du formulaire de type FormGroup
  submitted: boolean = false; // Indicateur de soumission du formulaire
  ecoles: Ecole[] = []; // Liste des écoles pour le menu déroulant
  niveauCl!: string[]; // Niveaux de classe pour le menu déroulant

  // Constructeur avec injection des services nécessaires
  constructor(
    private formBuilder: FormBuilder,
    private router: Router,
    private classeService: ClasseService,
    private ecoleService: EcoleService) {

    this.niveauCl = VariablesGlobales.niveauCl; // Récupération des niveaux de classe
    // Initialisation du formulaire avec des champs et des validateurs
    this.classe = this.formBuilder.group({
      nameCl: ['', Validators.required],
      niveauCl: ['', Validators.required],
      anneeCl: ['', Validators.required],
      ecoleId: ['', Validators.required],
    });
  }

  ngOnInit(): void {
    // Récupère la liste des ecoles lors de l'initialisation du composant
    this.ecoleService.getEcoles().subscribe((data: Ecole[]) => {
      this.ecoles = data;
    });
  }

  // Méthode privée pour ajouter une écolé
  private addClasse() {
    // Appel du service pour créer une classe avec les valeurs du formulaire
    this.classeService.createClasse(this.classe.value).subscribe({
      next: () => {
        // En cas de succès, afficher une alerte, réinitialiser le formulaire et rediriger
        alert("Classe ajoutée avec succès !");
        this.classe.reset();
        this.submitted = false;
        this.router.navigate(['/classes']);
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
    if (this.classe.invalid) {
      // Si le formulaire est invalide, ne pas continuer
      return false;
    } else {
      // Si le formulaire est valide, appeler la méthode pour ajouter une école
      this.addClasse();
      return true;
    }
  }

  // Getter pour accéder facilement aux contrôles du formulaire dans le template
  get form() {
    return this.classe.controls;
  }
}
