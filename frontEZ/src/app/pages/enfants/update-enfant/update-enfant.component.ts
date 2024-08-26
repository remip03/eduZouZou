import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { ClasseService } from '../../../services/classe.service';
import { EnfantService } from '../../../services/enfant.service';
import Classe from '../../../models/classe.model';
import Enfant from '../../../models/enfant.model';
import { ReturnBtnComponent } from "../../../commons/return-btn/return-btn.component";

@Component({
  selector: 'app-update-enfant',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule, RouterLink, ReturnBtnComponent],
  templateUrl: './update-enfant.component.html',
  styleUrl: './update-enfant.component.css'
})
export class UpdateEnfantComponent {
  enfant: FormGroup;
  submitted: boolean = false;
  enfantId?: number;
  classes: Classe[] = [];

  constructor(
    private formBuilder: FormBuilder,
    private route: ActivatedRoute,
    private router: Router,
    private enfantService: EnfantService,
    private classeService: ClasseService
  ) {
    // Initialise le formulaire avec des champs et des validateurs
    this.enfant = this.formBuilder.group({
      lastNameE: ['', Validators.required],
      firstNameE: ['', Validators.required],
      birthDateE: ['', Validators.required],
      classeId: ['', Validators.required],
    });
  }

  ngOnInit(): void {
    // Récupère l'ID d'un enfant à partir des paramètres de la route
    this.enfantId = Number(this.route.snapshot.paramMap.get('id'));
    if (this.enfantId) {
      // Si l'ID de l'enfant est valide, récupère les données de l'enfant
      this.enfantService.getEnfant(this.enfantId).subscribe((data: Enfant) => {
        // Vérifiez le format de la date
        const formattedDate = new Date(data.birthDateE).toISOString().split('T')[0];
        const enfantData = { ...data, birthDateE: formattedDate, classeId: data.classe.id }; // Prépare les données de l'enfant pour le formulaire
        this.enfant.patchValue(enfantData); // Met à jour le formulaire avec les données de l'enfant
      });
    }

    // Récupère la liste des classes
    this.classeService.getClasses().subscribe((data: Classe[]) => {
      this.classes = data; // Met à jour la liste des classes
    });
  }

  onSubmit(): void {
    this.submitted = true; // Marque le formulaire comme soumis
    if (this.enfant.invalid) {
      return; // Si le formulaire est invalide, ne pas continuer
    }

    if (this.enfantId) {
      // Si l'ID de l'enfant est valide, met à jour l'enfant
      const updatedEnfant = { ...this.enfant.value, id: this.enfantId };
      this.enfantService.updateEnfant(updatedEnfant).subscribe({
        next: () => {
          alert('Enfant mis à jour avec succès !'); // Affiche un message de succès
          this.router.navigate(['/enfants']); // Redirige vers la liste des enfants
        },
        error: (error) => {
          console.error('Erreur lors de la mise à jour de l\'enfant', error); // Affiche une erreur en cas d'échec
        }
      });
    }
  }

  get form() {
    return this.enfant.controls; // Getter pour accéder aux contrôles du formulaire
  }
}
