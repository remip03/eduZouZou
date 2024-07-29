import { Component } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import Ressource from '../../../../models/ressource.models';
import { RessourceService } from '../../../../services/ressource.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-create-cours',
  standalone: true,
  imports: [ReactiveFormsModule],
  templateUrl: './create-cours.component.html',
  styleUrl: './create-cours.component.css'
})
export class CreateCoursComponent {

  coursCreate: FormGroup;
  valid: boolean = false;
  cours: Ressource[] = []

  constructor(
    private formbuild: FormBuilder,
    private ressourceService: RessourceService,
    private router: Router
  ){
    this.coursCreate = this.formbuild.group({
      typeR: ['cours'],
      nameR: ['', Validators.required],
      descriptionR: [''],
      matiereR: ['', Validators.required],
      docC: [''],
      videoC: [''],
      ressourceSupC: ['']
    })
  }

  createCours(): void{
    this.valid = true;
    if(this.coursCreate.invalid){
      return ;
    }

    const newCours: Ressource = this.coursCreate.value

    this.ressourceService.addRessource(newCours).subscribe({
      next: () => {
        alert('Le cours a bien été ajouté à la liste.')
        this.router.navigate(['/Cours'])
      },
      error: () =>
        alert("Ce cours n'a pas été ajouté à la liste.")
    })
  }

  public get form(){
    return this.coursCreate.controls
  }

}
