import { Component, OnInit } from '@angular/core';
import Ressource from '../../../models/ressource.models';
import { ActivitesService } from '../../../services/activites.service';
import Activite from '../../../models/activite.model';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-activites',
  standalone: true,
  imports: [RouterLink],
  templateUrl: './activites.component.html',
  styleUrl: './activites.component.css'
})
export class ActivitesComponent implements OnInit{

  activites: Activite[] = []

  constructor(
    private activiteService: ActivitesService
  ){}

  ngOnInit(): void {
    this.activiteService.getActivites().subscribe((res) => {this.activites = res})
  }

}
