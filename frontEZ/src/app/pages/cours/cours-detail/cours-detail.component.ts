import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
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

@Component({
  selector: 'app-cours-detail',
  standalone: true,
  imports: [ReactiveFormsModule, RouterLink, CommonModule, ReturnBtnComponent],
  templateUrl: './cours-detail.component.html',
  styleUrl: './cours-detail.component.css',
})
export class CoursDetailComponent {
  coursDetail: FormGroup;
  coursID!: number;
  valid: boolean = false;
  matieres!: string[];
  typeRC!: string[];
  // file!: File;

  constructor(
    private formbuild: FormBuilder,
    private coursService: CoursService,
    private route: ActivatedRoute,
    private router: Router // private upServ: UploadService
  ) {
    this.matieres = VariablesGlobales.matieres;
    this.typeRC = VariablesGlobales.niveauCl;
    this.coursDetail = this.formbuild.group({
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
    if (this.coursDetail.invalid) {
      return;
    }

    if (this.coursID) {
      const detailsCours = { ...this.coursDetail.value, id: this.coursID };
      this.coursService.getCour(detailsCours).subscribe();
    }
  }

  public get form() {
    return this.coursDetail.controls;
  }

  ngOnInit(): void {
    this.coursID = Number(this.route.snapshot.paramMap.get('id'));
    if (this.coursID) {
      this.coursService
        .getCour(this.coursID)
        .subscribe((data: Cours) => this.coursDetail.patchValue(data));
    }
  }
}
