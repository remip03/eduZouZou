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
import { UploadService } from '../../../services/upload.service';
import { ReturnBtnComponent } from '../../../commons/return-btn/return-btn.component';

@Component({
  selector: 'app-update-cours',
  standalone: true,
  imports: [ReactiveFormsModule, RouterLink, CommonModule, ReturnBtnComponent],
  templateUrl: './update-cours.component.html',
  styleUrl: './update-cours.component.css',
})
export class UpdateCoursComponent implements OnInit {
  coursUpdate: FormGroup;
  coursID!: number;
  valid: boolean = false;
  matieres!: string[];
  typeRC!: string[];
  upload!: File;
  uploadName!: string;
  public uploadedAt = new Date('yyyy-MM-dd HH:mm:ss');

  constructor(
    private formbuild: FormBuilder,
    private coursService: CoursService,
    private route: ActivatedRoute,
    private router: Router,
    private upServ: UploadService,
  ){
    this.matieres = VariablesGlobales.matieres;
    this.typeRC = VariablesGlobales.niveauCl;
    this.coursUpdate = this.formbuild.group({
      nameR: ['', Validators.required],
      descriptionR: ['', Validators.required],
      matiereR: ['', Validators.required],
      typeR: ['', Validators.required],
      docC: [''],
      videoC: [''],
      ressourceSupC: [''],
      updatedAt: [''],
      imageFile: [''],
      dtype: ['cours'],
    });
  }

  updateCours(): void {
    this.valid = true;
    if (this.coursUpdate.invalid) {
      return;
    }

    if (this.coursID) {
      const formParams = new FormData();
      formParams.append('upload', this.coursUpdate.get('imageFile')?.value);
      formParams.append('uploadName', this.coursUpdate.get('ressourceSupC')?.value);
      formParams.append('uploadedAt', this.coursUpdate.get('updatedAt')?.value);

      const updatedCours = { ...this.coursUpdate.value, id: this.coursID };

      // if(this.upload){
      //   this.httpClient.post('http://localhost:8000/apiEZ/public/cours/images', this.upload)
      // }

      this.coursService.updateCours(updatedCours).subscribe({
        next: () => {
          alert('Ce cours a bien été modifié.');
          console.log(this.coursUpdate.value);

          // this.router.navigate(['/cours']);
        },
        error: () => {
          alert("Le cours n'a pas été modifié.");
        },
      });
    }
  }

  onFilechange(event: any){
    this.upload = event.target.files ? event.target.files[0] : null;
    this.uploadName = this.upload.name;

    this.coursUpdate.get('imageFile')?.setValue(this.upload);
    this.coursUpdate.get('ressourceSupC')?.setValue(this.uploadName);
    this.coursUpdate.get('updatedAt')?.setValue(this.uploadedAt);
    console.log(this.uploadedAt);
    
    console.log(this.upload);
  }

  // uploadImage(){
  //   if(this.upload){
  //     this.upServ.uploadfile(this.upload).subscribe(res => {alert('image téléchargée')})
  //   }
  //   else{
  //     alert('Ce fichier n\'est pas compatible.')
  //   }
  // }

  public get form() {
    return this.coursUpdate.controls;
  }

  deleteCours() {
    this.coursService.deleteCours(this.coursID).subscribe({
      next: () => {
        alert('Ce cours a été effacé.');
        this.router.navigate(['/cours']);
      },
      error: () => {
        alert('Une erreur est survenue.');
      },
    });
  }

  ngOnInit(): void {
    this.coursID = Number(this.route.snapshot.paramMap.get('id'));
    if (this.coursID) {
      this.coursService
        .getCour(this.coursID)
        .subscribe((data: Cours) => this.coursUpdate.patchValue(data));
    }
  }
}
