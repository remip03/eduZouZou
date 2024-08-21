import { Component, OnInit } from '@angular/core';
import Ecole from '../../../models/ecole.modelt';
import { ActivatedRoute, RouterLink } from '@angular/router';
import { CommonModule } from '@angular/common';
import { EcoleService } from '../../../services/ecole.service';

@Component({
  selector: 'app-ecole-etablissement',
  standalone: true,
  imports: [RouterLink, CommonModule],
  templateUrl: './ecole-etablissement.component.html',
  styleUrl: './ecole-etablissement.component.css'
})
export class EcoleEtablissementComponent implements OnInit {

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
