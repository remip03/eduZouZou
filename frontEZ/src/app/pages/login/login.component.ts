import { Component } from '@angular/core';
import {
  FormBuilder,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { AuthService } from '../../services/auth.service';
import { Router, RouterLink } from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [ReactiveFormsModule, RouterLink],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css',
})
export class LoginComponent {
  loginForm: FormGroup = this.formB.group({
    username: ['', [Validators.required]],
    password: ['', [Validators.required]],
  });

  constructor(
    private formB: FormBuilder,
    private authService: AuthService,

    private router: Router // Inject Router to navigate to home page after successful login
  ) {}

  onLogin(): void {
    console.log(this.loginForm.value);
    this.authService.login(this.loginForm.value).subscribe((data) => {});
  }

  get form() {
    return this.loginForm.controls;
  } // getter to access form controls
}
