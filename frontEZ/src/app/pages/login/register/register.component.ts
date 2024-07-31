import { UserService } from './../../../services/user.service';
import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import {
  FormBuilder,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { Router, RouterLink } from '@angular/router';
import User from '../../../models/user.models';
import { AuthService } from '../../../services/auth.service';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule, RouterLink],
  templateUrl: './register.component.html',
  styleUrl: './register.component.css',
})
export class RegisterComponent {
  userDetail: User[] = [];
  user: FormGroup; // Déclaration du formulaire de type FormGroup
  submitted: boolean = false; // Indicateur de soumission du formulaire

  // Constructeur avec injection des services nécessaires
  constructor(
    private formBuilder: FormBuilder,
    private router: Router,
    private authService: AuthService,
    private UserService: UserService
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

          // Validators.pattern(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/g),
        ],
      ],

      firstName: [
        '',
        [
          Validators.required,

          // Validators.pattern(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/g),
        ],
      ],

      tel: [
        '',
        [
          Validators.required,

          // Validators.pattern(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/g),
        ],
      ],

      adresse: [
        '',
        [
          Validators.required,

          // Validators.pattern(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/g),
        ],
      ],

      ecoleId: ['', [Validators.required]],
    });
  }

  // Méthode privée pour ajouter un utilisateur
  private addUser() {
    const userData = {
      email: this.user.value.username, // Changez 'username' en 'email'
      password: this.user.value.password,
    };
    this.authService.register(userData).subscribe({
      next: () => {
        alert('Inscription effectuée avec succès !');
        this.submitted = false;
        this.router.navigate(['/login']);
        this.user.reset();
      },
      error: (error) => {
        console.error("Erreur lors de l'inscription.", error);
        if (error.error) {
          console.error("Détails de l'erreur:", error.error);
        }
      },
    });
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

  //méthode appelée lors du chargement du composant
  // ngOnInit(): void {
  //   //recupère le role
  //   this.role = this.authService.getRole();
  //   // Récupère la liste des messages
  //   this.userService
  //     .getUsers()
  //     .subscribe((responseMsg) => (this.userDetail = responseMsg));
  // }

  // Getter pour accéder facilement aux contrôles du formulaire dans le template
  get form() {
    return this.user.controls;
  }
}
