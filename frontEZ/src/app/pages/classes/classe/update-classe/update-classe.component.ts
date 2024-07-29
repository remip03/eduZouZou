import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import Ecole from '../../../../models/ecole.modelt';
import { ClasseService } from '../../../../services/classe.service';
import { EcoleService } from '../../../../services/ecole.service';
import Classe from '../../../../models/classe.model';

@Component({
  selector: 'app-update-classe',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule, RouterLink],
  templateUrl: './update-classe.component.html',
  styleUrl: './update-classe.component.css'
})
export class UpdateClasseComponent {
  classe: FormGroup;
  submitted: boolean = false;
  classeId?: number;
  ecoles: Ecole[] = [];

  constructor(
    private formBuilder: FormBuilder,
    private route: ActivatedRoute,
    private router: Router,
    private classeService: ClasseService,
    private ecoleService: EcoleService
  ) {
    // Initialise le formulaire avec des champs et des validateurs
    this.classe = this.formBuilder.group({
      nameCl: ['', Validators.required],
      niveauCl: ['', Validators.required],
      anneeCl: ['', Validators.required],
      ecoleId: ['', Validators.required],
    });
  }

  ngOnInit(): void {
     // Récupère l'ID d'une classe à partir des paramètres de la route
     this.classeId = Number(this.route.snapshot.paramMap.get('id'));
     if (this.classeId) {
       // Si l'ID de la classe est valide, récupère les données de la classe
       this.classeService.getClasse(this.classeId).subscribe((data: Classe) => {
         const classeData = { ...data, idEcole: data.ecole.id }; // Prépare les données de la classe pour le formulaire
         this.classe.patchValue(classeData); // Met à jour le formulaire avec les données de la classe
       });
     }

     // Récupère la liste des écoles
     this.ecoleService.getEcoles().subscribe((data: Ecole[]) => {
       this.ecoles = data; // Met à jour la liste des écoles
     });
   }

   onSubmit(): void {
     this.submitted = true; // Marque le formulaire comme soumis
     if (this.classe.invalid) {
       return; // Si le formulaire est invalide, ne pas continuer
     }

     if (this.classeId) {
       // Si l'ID de la classe est valide, met à jour la classe
       const updatedClasse = { ...this.classe.value, id: this.classeId };
       this.classeService.updateClasse(updatedClasse).subscribe({
         next: () => {
           alert('Classe mise à jour avec succès !'); // Affiche un message de succès
           this.router.navigate(['/classes']); // Redirige vers la liste des classes
         },
         error: (error) => {
           console.error('Erreur lors de la mise à jour de la classe', error); // Affiche une erreur en cas d'échec
         }
       });
     }
   }

   get form() {
     return this.classe.controls; // Getter pour accéder aux contrôles du formulaire
   }
}
