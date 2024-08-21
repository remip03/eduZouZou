import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import Cours from '../../models/Cours.model';
import { CoursService } from '../../services/cours.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-cours',
  standalone: true,
  imports: [RouterLink, CommonModule],
  templateUrl: './cours.component.html',
  styleUrl: './cours.component.css',
})
export class CoursComponent implements OnInit {
  cours: Cours[] = [];

  constructor(private coursService: CoursService) {}

  ngOnInit(): void {
    this.coursService.getCours().subscribe((res) => {
      this.cours = res;
    });
  }

  colors: any[] = [
    '#F9DBA0',
    '#BBE2EA',
    '#A7B2FB',
    '#FBB0A7',
    '#F9AAB8',
    '#F2A6FD',
  ];

  getColor(index: number): string {
    return this.colors[index % this.colors.length];
  }
}
