import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { ActivitesService } from '../../../../services/activites.service';
import Activite from '../../../../models/activite.model';
import { VariablesGlobales } from '../../../../commons/variablesGlobales';

@Component({
  selector: 'app-update-activite',
  standalone: true,
  imports: [ReactiveFormsModule, RouterLink, CommonModule],
  templateUrl: './update-activite.component.html',
  styleUrl: './update-activite.component.css'
})
export class UpdateActiviteComponent implements OnInit {

  activiteUpdate: FormGroup;
  activiteID!: number;
  valid: boolean = false;
  matieres!: string[];
  typeActivite!: string[];
  typeRA!: string[];

  constructor(
    private formbuild: FormBuilder,
    private activiteService: ActivitesService,
    private route: ActivatedRoute,
    private router: Router,
  ) {
    this.matieres = VariablesGlobales.matieres
    this.typeActivite = VariablesGlobales.typeAct
    this.typeRA = VariablesGlobales.typeRA
    this.activiteUpdate = this.formbuild.group({
      nameR: ['', Validators.required],
      descriptionR: ['', Validators.required],
      matiereR: ['', Validators.required],
      typeR: ['', Validators.required],
      typeAct:  [''],
      dtype: ['activite']
    })
  }

  updateActivite(): void {
    this.valid = true;
    if(this.activiteUpdate.invalid){
      return;
    }

    if(this.activiteID){
      const updatedActivite = {...this.activiteUpdate.value, id: this.activiteID};
      this.activiteService.updateActivite(updatedActivite).subscribe({
        next: () => {
          alert('Cette activité a bien été modifiée.');
          this.router.navigate(['/activites'])
        },
        error:() =>{
          alert('L\'activité n\'a pas été modifiée.');
        }
      });
    }
  }

  public get form(){
    return this.activiteUpdate.controls
  }

  deleteActivite(){
    this.activiteService.deleteActivite(this.activiteID).subscribe({
      next: () =>{
        alert('Cette activité a été effacée.');
        this.router.navigate(['/activites'])
      },
      error:() =>{
        alert('Une erreur est survenue.');
      }
    });
  }

  ngOnInit(): void {
    this.activiteID = Number(this.route.snapshot.paramMap.get('id'));
    if(this.activiteID){
      this.activiteService.getActivite(this.activiteID).subscribe((data: Activite) => this.activiteUpdate.patchValue(data))
    }
  }

}
