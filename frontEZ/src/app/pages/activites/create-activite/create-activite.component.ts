import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { Router, RouterLink } from '@angular/router';
import { ActivitesService } from '../../../services/activites.service';
import { VariablesGlobales } from '../../../commons/variablesGlobales';
import { ReturnBtnComponent } from "../../../commons/return-btn/return-btn.component";
@Component({
  selector: 'app-create-activite',
  standalone: true,
  imports: [ReactiveFormsModule, RouterLink, CommonModule, ReturnBtnComponent],
  templateUrl: './create-activite.component.html',
  styleUrl: './create-activite.component.css'
})
export class CreateActiviteComponent{

  activiteCreate: FormGroup;
  valid: boolean = false;
  matieres!: string[];
  typeActivite!: string[];
  typeRA!: string[];

  constructor(
    private formbuild: FormBuilder,
    private activiteService: ActivitesService,
    private router: Router,
  ){
    this.matieres = VariablesGlobales.matieres
    this.typeActivite = VariablesGlobales.typeAct
    this.typeRA = VariablesGlobales.niveauCl
    this.activiteCreate = this.formbuild.group({
      nameR: ['', Validators.required],
      descriptionR: ['', Validators.required],
      matiereR: ['', Validators.required],
      typeR: ['', Validators.required],
      typeAct:  [''],
      dtype: ['activite']
    })
  }

  createActivite(): void {
    this.valid = true;
    if(this.activiteCreate.invalid){
      return ;
    }

    const newActivite = this.activiteCreate.value;
    this.activiteService.addActivite(newActivite).subscribe({
      next: () => {
        alert('L\'activité a bien été créée');
        this.router.navigate(['/activites'])
      },

      error: () =>{
        alert('L\'activité n\'a pas été ajoutée')
      }
    })
  }

  public get form(){
    return this.activiteCreate.controls
  }

}
