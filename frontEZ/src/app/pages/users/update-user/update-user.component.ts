import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { UserService } from '../../../services/user.service';
import { EcoleService } from '../../../services/ecole.service'; // Importez le service des écoles
import User from '../../../models/user.models';
import Ecole from '../../../models/ecole.modelt';

@Component({
  selector: 'app-update-user',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule, RouterLink],
  templateUrl: './update-user.component.html',
  styleUrl: './update-user.component.css'
})
export class UpdateUserComponent implements OnInit {
  user: FormGroup;
  submitted: boolean = false;
  userId?: number;
  ecoles: Ecole[] = []; // Ajoutez une variable pour stocker les écoles

  constructor(
    private formBuilder: FormBuilder,
    private route: ActivatedRoute,
    private router: Router,
    private userService: UserService,
    private ecoleService: EcoleService // Injectez le service des écoles
  ) {
    this.user = this.formBuilder.group({
      firstName: ['', Validators.required],
      lastName: ['', Validators.required],
      email: ['', [Validators.required, Validators.email]],
      adresse: ['', Validators.required],
      tel: ['', Validators.required],
      roles: ['', Validators.required],
      password: ['', Validators.required],
      ecoleId: ['', Validators.required] // Ajoutez le champ ecole
    });
  }

  ngOnInit(): void {
    this.userId = Number(this.route.snapshot.paramMap.get('id'));
    if (this.userId) {
      this.userService.getUser(this.userId).subscribe((data: User) => {

        const userData = { ...data, ecoleId: data.ecoleId }; // Préparez les données de l'utilisateur pour le formulaire
        console.log(userData); // Vérifiez les données reçues
        this.user.patchValue(userData);
      });
    }

    // Chargez la liste des écoles
    this.ecoleService.getEcoles().subscribe((data: Ecole[]) => {
      this.ecoles = data;
    });
  }

  onSubmit(): void {
    this.submitted = true;
    if (this.user.invalid) {
      return;
    }
    if (this.userId) {
      const updatedUser = { ...this.user.value, id: this.userId };
      this.userService.updateUser(updatedUser).subscribe({
        next: () => {
          alert('User mise à jour avec succès !');
          this.router.navigate(['/users']);
        },
        error: (error) => {
          console.log('Erreur lors de la mise à jour de l\'user', error);
        }
      });
    }
  }

  get form() {
    return this.user.controls;
  }
}
