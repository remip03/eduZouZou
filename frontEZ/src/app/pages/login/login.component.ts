import { Component } from '@angular/core';
import {
  FormBuilder,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { AuthService } from '../../services/auth.service';
import { Router, RouterLink } from '@angular/router';

interface IToken {
  access_token: string;
}

interface Login {
  username: string;
  password: string;
}

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [ReactiveFormsModule, RouterLink],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css',
})
export class LoginComponent {
  private tokenKey = 'token'; // Clé pour stocker le token dans le localStorage

  loginForm: FormGroup = this.formB.group({
    username: [
      '',
      [
        Validators.required,
        Validators.email,
        Validators.pattern(/^[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$/g),
      ],
    ],
    password: ['', [Validators.required]],
  });

  submitted: boolean = false;

  constructor(
    private formB: FormBuilder,
    private authService: AuthService,

    private router: Router // Inject Router to navigate to home page after successful login
  ) {}

  onLogin(): any {
    console.log(this.loginForm.value);
    this.authService.login(this.loginForm.value).subscribe((data) => {
      console.log(data);
    });
    this.submitted = true; //retourne la valeur true pour valider les champs de login

    if (this.loginForm.invalid) {
      console.log('Form is invalid');
      return false; //retourne la valeur false pour invalider les champs login
    } else {
      this.router.navigate(['Accueil']); //
    }
  }

  getRole(): string | null {
    const token = localStorage.getItem(this.tokenKey);
    if (token) {
      try {
        const payload = JSON.parse(atob(token.split('.')[1])); // Décode le payload du token
        return payload.roles ? payload.roles[0] : null; // Retourne le premier rôle trouvé
      } catch (e) {
        console.error('Invalid token format', e); // Log une erreur si le format du token est invalide
        return null;
      }
    }
    this.loginForm.reset(); // reset the form after submission

    return null; // Retourne null si aucun token n'est trouvé
  }

  get form() {
    return this.loginForm.controls;
  } // getter to access form controls
}
