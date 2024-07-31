import { Component } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import Ressource from '../../../../models/ressource.models';
import { Router } from '@angular/router';
import { CoursService } from '../../../../services/cours.service';
import { VariablesGlobales } from '../../../../commons/variablesGlobales';
import Cours from '../../../../models/Cours.model';

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
  matieres!: string[];
  typeRC!: string[];

  constructor(
    private formbuild: FormBuilder,
    private coursService: CoursService,
    private router: Router
  ){
    this.matieres = VariablesGlobales.matieres
    this.typeRC = VariablesGlobales.typeRC
    this.coursCreate = this.formbuild.group({
      typeR: [''],
      nameR: ['', Validators.required],
      descriptionR: [''],
      matiereR: ['', Validators.required],
      docC: [''],
      videoC: [''],
      ressourceSupC: [''],
      dtype: ['cours']
    })
  }

  createCours(): void{
    this.valid = true;
    if(this.coursCreate.invalid){
      return ;
    }

    const newCours: Cours = this.coursCreate.value

    this.coursService.addCours(newCours).subscribe({
      next: () => {
        alert('Le cours a bien été ajouté à la liste.')
        this.router.navigate(['/cours'])
      },
      error: () =>
        alert("Ce cours n'a pas été ajouté à la liste.")
    })
  }

  public get form(){
    return this.coursCreate.controls
  }

}
