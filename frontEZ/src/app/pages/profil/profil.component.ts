import { Component } from '@angular/core';
import Ecole from '../../models/ecole.modelt';
import { FormBuilder, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { AuthService } from '../../services/auth.service';
import { EcoleService } from '../../services/ecole.service';
import { UserService } from '../../services/user.service';
import User from '../../models/user.models';

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
  userId?: number;
  ecoles: Ecole[] = []; // Liste des écoles
  selectedEcoleId: number | null = null; // ID de l'école sélectionnée

  constructor(
    private formBuilder: FormBuilder,
    private route: ActivatedRoute,
    private router: Router,
    private userService: UserService,
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

  ngOnInit(): void {
    // Récupère l'ID d'une classe à partir des paramètres de la route
    this.userId = Number(this.route.snapshot.paramMap.get('id'));
    if (this.userId) {
      // Si l'ID de l'utilisateur est valide, récuprère les données de la classe
      this.userService.getUser(this.userId).subscribe((data: User) => {
        // Prépare les données de l'utilisateur pour le formulaire
        const userData = { ...data, ecoleId: data.ecole.id };
        console.log('User Data:', userData); // Ajoutez un log pour vérifier les données
        this.user.patchValue(userData); // Met à jour le formulaire avec les données de l'utilisateur
      });
    }

    // Récupère la liste des écoles
    this.ecoleService.getEcoles().subscribe((data: Ecole[]) => {
      this.ecoles = data; // Met à jour la liste des écoles
    });
  }

  onSubmit(): void {
    this.submitted = true; // Marque le formulaire comme soumis
    if (this.user.invalid) {
      return; // Si le formulaire est invalide, ne pas continuer
    }

    if (this.userId) {
      // Si l'ID de l'utilisateur est valide, met à jour l'utilisateur
      const updatedUser = { ...this.user.value, id: this.userId };
      this.userService.updateUser(updatedUser).subscribe({
        next: () => {
          alert('Utilisateur mis à jour avec succès !'); // Affiche un message de succès
          this.router.navigate(['/profil']); // Redirige vers la liste des utilisateurs
        },
        error: (error) => {
          console.error('Erreur lors de la mise à jour de l\'utilisateur', error); // Affiche une erreur en cas d'échec
        },
      });
    }
  }
  get form() {
    return this.user.controls; // Récupère les contrôles du formulaire
  }
}
