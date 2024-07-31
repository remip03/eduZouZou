import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { CoursService } from '../../../../services/cours.service';
import { VariablesGlobales } from '../../../../commons/variablesGlobales';
import Cours from '../../../../models/Cours.model';

@Component({
  selector: 'app-update-cours',
  standalone: true,
  imports: [ReactiveFormsModule, RouterLink, CommonModule],
  templateUrl: './update-cours.component.html',
  styleUrl: './update-cours.component.css'
})
export class UpdateCoursComponent implements OnInit{

  coursUpdate: FormGroup;
  coursID!: number;
  valid: boolean = false;
  matieres!: string[];
  typeRC!: string[];

  constructor(
    private formbuild: FormBuilder,
    private coursService: CoursService,
    private route: ActivatedRoute,
    private router: Router,
  ) {
    this.matieres = VariablesGlobales.matieres
    this.typeRC = VariablesGlobales.typeRC
    this.coursUpdate = this.formbuild.group({
      nameR: ['', Validators.required],
      descriptionR: ['', Validators.required],
      matiereR: ['', Validators.required],
      typeR: ['', Validators.required],
      docC: [''],
      videoC: [''],
      ressourceSupC: [''],
      dtype: ['cours']
    })
  }

  updateCours(): void {
    this.valid = true;
    if(this.coursUpdate.invalid){
      return;
    }

    if(this.coursID){
      const updatedCours = {...this.coursUpdate.value, id: this.coursID};
      this.coursService.updateCours(updatedCours).subscribe({
        next: () => {
          alert('Ce cours a bien été modifié.');
          this.router.navigate(['/cours'])
        },
        error:() =>{
          alert('Le cours n\'a pas été modifié.');
        }
      })
    }
  }

  public get form(){
    return this.coursUpdate.controls
  }

  deleteCours(){
    this.coursService.deleteCours(this.coursID).subscribe({
      next: () => {
        alert('Ce cours a été effacé.');
        this.router.navigate(['/cours'])
      },
      error:() =>{
        alert('Une erreur est survenue.');
      }
    });
  }

  ngOnInit(): void {
    this.coursID = Number(this.route.snapshot.paramMap.get('id'));
    if(this.coursID){
      this.coursService.getCour(this.coursID).subscribe((data: Cours) => this.coursUpdate.patchValue(data))
    }
  }

}
