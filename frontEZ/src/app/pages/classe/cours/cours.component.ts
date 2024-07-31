import { Component, OnInit } from '@angular/core';
import Cours from '../../../models/Cours.model';
import { CoursService } from '../../../services/cours.service';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-cours',
  standalone: true,
  imports: [RouterLink],
  templateUrl: './cours.component.html',
  styleUrl: './cours.component.css'
})
export class CoursComponent implements OnInit{
  cours: Cours[] = []

  constructor(
    private coursService: CoursService
  ){}

  ngOnInit(): void {
    this.coursService.getCours().subscribe((res) => {this.cours = res})
  }

}
