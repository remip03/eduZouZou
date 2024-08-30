import { Component } from '@angular/core';
import { ReturnBtnComponent } from '../../../commons/return-btn/return-btn.component';
import { SliderProfilComponent } from '../../../commons/slider-profil/slider-profil.component';
import { FormBuilder, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { AuthService } from '../../../services/auth.service';
import { CommonModule } from '@angular/common';
import { catchError, map, Observable, of } from 'rxjs';
import { UserService } from '../../../services/user.service';

@Component({
  selector: 'app-modifier-mdp',
  standalone: true,
  imports: [ReturnBtnComponent, SliderProfilComponent, FormsModule, ReactiveFormsModule, CommonModule],
  templateUrl: './modifier-mdp.component.html',
  styleUrl: './modifier-mdp.component.css'
})
export class ModifierMdpComponent {
  passwordForm: FormGroup; // Formulaire pour la modification du mot de passe
  submitted: boolean = false; // Indicateur de soumission du formulaire

  constructor(private formBuilder: FormBuilder, private authService: AuthService, private userService: UserService) {
    // Initialisation du formulaire avec les champs et les validateurs
    this.passwordForm = this.formBuilder.group({
      currentPassword: ['', Validators.required], // Champ pour le mot de passe actuel
      newPassword: ['', Validators.required,
        // Validators.pattern(
        //   /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/g
        // ),
      ],
      confirmPassword: ['', Validators.required] // Champ pour la confirmation du nouveau mot de passe
    }, {
      validator: this.mustMatch('newPassword', 'confirmPassword') // Validateur personnalisé pour vérifier que les mots de passe correspondent
    });
  }

  // Validateur personnalisé pour vérifier que deux champs correspondent
  mustMatch(controlName: string, matchingControlName: string) {
    return (formGroup: FormGroup) => {
      const control = formGroup.controls[controlName];
      const matchingControl = formGroup.controls[matchingControlName];

      if (matchingControl.errors && !matchingControl.errors['mustMatch']) {
        return;
      }

      if (control.value !== matchingControl.value) {
        matchingControl.setErrors({ mustMatch: true }); // Définit une erreur si les valeurs ne correspondent pas
      } else {
        matchingControl.setErrors(null); // Supprime l'erreur si les valeurs correspondent
      }
    };
  }

  // Méthode pour récupérer l'email de l'utilisateur à partir du token
  getUserEmailFromToken(): Observable<string> {
    const token = localStorage.getItem('token'); // Récupère le token depuis le localStorage
    if (token) {
      try {
        const payload = JSON.parse(atob(token.split('.')[1])); // Décode le payload du token
        if (payload && payload.username) {
          return of(payload.username); // Retourne l'email de l'utilisateur
        } else {
          console.error('Email non trouvé ou invalide dans le payload');
          return of(''); // Retourne une chaîne vide si l'email est invalide
        }
      } catch (e) {
        console.error('Erreur lors du décodage du token:', e);
        return of(''); // Retourne une chaîne vide en cas d'erreur de décodage
      }
    }
    return of(''); // Retourne une chaîne vide si le token n'est pas présent
  }

  // Méthode pour soumettre le formulaire de modification de mot de passe
  onSubmit() {
    this.submitted = true; // Indique que le formulaire a été soumis

    if (this.passwordForm.invalid) {
      return; // Arrête l'exécution si le formulaire est invalide
    }

    const currentPassword = this.passwordForm.controls['currentPassword'].value; // Récupère la valeur du mot de passe actuel
    const newPassword = this.passwordForm.controls['newPassword'].value; // Récupère la valeur du nouveau mot de passe
    const confirmPassword = this.passwordForm.controls['confirmPassword'].value; // Récupère la valeur de confirmation du nouveau mot de passe

    // Récupère l'email de l'utilisateur à partir du token et tente de changer le mot de passe
    this.getUserEmailFromToken().subscribe(email => {
      if (email) {
        this.authService.changePassword(email, currentPassword, newPassword, confirmPassword).subscribe({
          next: () => {
            window.location.reload(); // Recharge la page en cas de succès
            alert('Mot de passe modifié avec succès'); // Affiche une alerte de succès
          },
          error: (err) => {
            console.error('Erreur lors de la modification du mot de passe:', err); // Affiche une erreur en cas d'échec
          }
        });
      } else {
        console.error('Email utilisateur invalide'); // Affiche une erreur si l'email est invalide
      }
    });
  }
}
