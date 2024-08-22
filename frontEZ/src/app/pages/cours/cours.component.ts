import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import Cours from '../../models/Cours.model';
import { CoursService } from '../../services/cours.service';
import { CommonModule } from '@angular/common';
import { VariablesGlobales } from '../../commons/variablesGlobales';

@Component({
  selector: 'app-cours',
  standalone: true,
  imports: [RouterLink, CommonModule],
  templateUrl: './cours.component.html',
  styleUrl: './cours.component.css',
})
export class CoursComponent implements OnInit {
  cours: Cours[] = [];
  classe!: string[];
  matiere!: string[];

  constructor(private coursService: CoursService) {
    this.classe = VariablesGlobales.niveauCl;
    this.matiere = VariablesGlobales.matieres;
  }

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
  // fonction pour modifier couleur suivant le tableau colors
  getColor(index: number): string {
    return this.colors[index % this.colors.length];
  }

  filteredCours = this.cours;

  // Méthode pour filtrer par classe
  filterByClasse(classe: string) {
    this.filteredCours = this.cours.filter((cours) => cours.typeR === classe);
  }
  // Méthode pour filtrer par matière
  filterByMatiere(matiere: string) {
    this.filteredCours = this.cours.filter((cours) =>
      cours.matiereR.includes(matiere)
    );
  }

  // Méthode pour reset le filtre
  resetFilter() {
    this.filteredCours = this.cours;
  }

  // Méthode pour trier par nom
  sortByType() {
    this.filteredCours = [...this.filteredCours].sort((a, b) =>
      a.nameR.localeCompare(b.dtype)
    );
  }
  // Méthode pour trier par matière
  sortByMatiere() {
    this.filteredCours = [...this.filteredCours].sort((a, b) =>
      a.matiereR.localeCompare(b.matiereR)
    );
  }
  // Méthode pour trier par classe
  sortByClasse() {
    this.filteredCours = [...this.filteredCours].sort((a, b) =>
      a.docC.localeCompare(b.typeR)
    );
  }
}
