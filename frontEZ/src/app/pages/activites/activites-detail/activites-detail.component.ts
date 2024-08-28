import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

import {
  FormBuilder,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { CoursService } from '../../../services/cours.service';
import { VariablesGlobales } from '../../../commons/variablesGlobales';
import Cours from '../../../models/Cours.model';
import { ReturnBtnComponent } from '../../../commons/return-btn/return-btn.component';
import { ActivitesService } from '../../../services/activites.service';
import Activite from '../../../models/activite.model';

@Component({
  selector: 'app-activites-detail',
  standalone: true,
  imports: [ReactiveFormsModule, RouterLink, CommonModule, ReturnBtnComponent],
  templateUrl: './activites-detail.component.html',
  styleUrl: './activites-detail.component.css',
})
export class ActivitesDetailComponent {
  activiteDetail: FormGroup;
  activiteID!: number;
  valid: boolean = false;
  matieres!: string[];
  typeRC!: string[];
  // file!: File;

  constructor(
    private formbuild: FormBuilder,
    private activitesService: ActivitesService,
    private route: ActivatedRoute,
    private router: Router // private upServ: UploadService
  ) {
    this.matieres = VariablesGlobales.matieres;
    this.typeRC = VariablesGlobales.niveauCl;
    this.activiteDetail = this.formbuild.group({
      nameR: ['', Validators.required],
      descriptionR: ['', Validators.required],
      matiereR: ['', Validators.required],
      typeR: ['', Validators.required],
      docC: [''],
      videoC: [''],
      imageFile: [''],
      dtype: ['cours'],
    });
  }

  detailCours(): void {
    this.valid = true;
    if (this.activiteDetail.invalid) {
      return;
    }

    if (this.activiteID) {
      const detailsCours = {
        ...this.activiteDetail.value,
        id: this.activiteID,
      };
      this.activitesService.getActivite(detailsCours).subscribe();
    }
  }

  public get form() {
    return this.activiteDetail.controls;
  }

  ngOnInit(): void {
    this.activiteID = Number(this.route.snapshot.paramMap.get('id'));
    if (this.activiteID) {
      this.activitesService
        .getActivite(this.activiteID)
        .subscribe((data: Activite) => this.activiteDetail.patchValue(data));
    }
  }
}
