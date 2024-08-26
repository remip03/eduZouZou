import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, RouterLink } from '@angular/router';
import Ecole from '../../../models/ecole.modelt';
import { EcoleService } from '../../../services/ecole.service';
import { FormBuilder, FormGroup, ReactiveFormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { ReturnBtnComponent } from "../../../commons/return-btn/return-btn.component";

@Component({
  selector: 'app-ecole-actualites',
  standalone: true,
  imports: [RouterLink, CommonModule, ReturnBtnComponent],
  templateUrl: './ecole-actualites.component.html',
  styleUrl: './ecole-actualites.component.css'
})

export class EcoleActualitesComponent implements OnInit{

  ecoleID!: number;
  ecole!: Ecole;

  constructor(
    private route : ActivatedRoute,
    private ecoleService: EcoleService,
  ) { }

  ngOnInit(): void {
    this.ecoleID = Number(this.route.snapshot.paramMap.get('id'));
    if(this.ecoleID){
      this.ecoleService.getEcole(this.ecoleID).subscribe((response) => this.ecole = response)
    }
  }

}
