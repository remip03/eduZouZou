import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { ActivitesService } from '../../services/activites.service';
import Activite from '../../models/activite.model';

@Component({
  selector: 'app-activites',
  standalone: true,
  imports: [RouterLink],
  templateUrl: './activites.component.html',
  styleUrl: './activites.component.css'
})
export class ActivitesComponent implements OnInit {

  activites: Activite[] = []

  constructor(
    private activiteService: ActivitesService
  ) { }

  ngOnInit(): void {
    this.activiteService.getActivites().subscribe((res) => { this.activites = res })
  }

}
