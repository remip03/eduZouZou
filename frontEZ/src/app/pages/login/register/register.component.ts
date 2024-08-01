import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import {
  FormBuilder,
  FormGroup,
  FormsModule,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { Router, RouterLink } from '@angular/router';
import { AuthService } from '../../../services/auth.service';
import Ecole from '../../../models/ecole.modelt';
import { EcoleService } from '../../../services/ecole.service';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule, RouterLink, FormsModule],
  templateUrl: './register.component.html',
  styleUrl: './register.component.css',
})
export class RegisterComponent {
  user: FormGroup; // Déclaration du formulaire de type FormGroup
  submitted: boolean = false; // Indicateur de soumission du formulaire
  ecoles: Ecole[] = [];
  selectedEcoleId: number | null = null;

  // Constructeur avec injection des services nécessaires
  constructor(
    private formBuilder: FormBuilder,
    private router: Router,
    private authService: AuthService,
    private ecoleService: EcoleService
  ) {
    this.user = this.formBuilder.group({
      username: [
        '',
        [
          Validators.required,
          Validators.email,
          // Validators.pattern(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/g),
        ],
      ], // Ajoutez Validators.email pour valider l'email
      password: [
        '',
        [
          Validators.required,
          // Validators.pattern(
          //   /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/g
          // ),
        ],
      ],

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
      ecoleId: [null, Validators.required],
    });
  }

  ngOnInit(): void {
    this.loadEcoles();
  }

  loadEcoles(): void {
    this.ecoleService.getEcoles().subscribe((ecoles) => {
      this.ecoles = ecoles;
    });
  }

  onEcoleChange(event: Event): void {
    const selectElement = event.target as HTMLSelectElement;
    this.selectedEcoleId = Number(selectElement.value);
    this.user.patchValue({ ecoleId: this.selectedEcoleId });
  }

  // Méthode appelée lors de la soumission du formulaire
  onSubmit() {
    this.submitted = true; // Indique que le formulaire a été soumis
    if (this.user.invalid) {
      return false;
    } else {
      this.addUser();
      return true;
    }
  }

  // Méthode privée pour ajouter un utilisateur
  private addUser() {
    const userData = {
      email: this.user.value.username,
      password: this.user.value.password,
      lastName: this.user.value.lastName,
      firstName: this.user.value.firstName,
      tel: this.user.value.tel,
      adresse: this.user.value.adresse,
      ecoleId: this.user.value.ecoleId,
    };
    this.authService.register(userData).subscribe({
      next: () => {
        alert('Inscription effectuée avec succès !');
        this.user.reset();
        this.submitted = false;
        this.router.navigate(['/login']);
      },
      error: (error) => {
        console.error("Erreur lors de l'inscription.", error);
        console.error("Détails de l'erreur:", error.error);
        if (error.error) {
          console.error("Détails de l'erreur:", error.error);
        }
      },
    });
  }

  // Getter pour accéder facilement aux contrôles du formulaire dans le template
  get form() {
    return this.user.controls;
  }
}
