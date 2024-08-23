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

  filterValue: string[] = ['matiere', 'classe'];

  isVisible: boolean = false;
  hidden: boolean = true;

  valueChange: string = '';

  constructor(private coursService: CoursService) {
    this.classe = VariablesGlobales.niveauCl;
    this.matiere = VariablesGlobales.matieres;
  }

  toogle() {
    this.isVisible = !this.isVisible;
    if (!this.isVisible) {
      location.reload();
    }
  }

  filterSelect(item: any) {
    this.valueChange = item;
  }

  ngOnInit(): void {
    this.coursService.getCours().subscribe((res) => {
      this.cours = res;
      console.log(this.matiere);
      this.isVisible = false;
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

  // fonction pour selectionner
  selectFilter(rep: any) {
    this.classe = [rep];

    this.isVisible = false;
    this.showResult(rep);
    console.log(this.classe);
  }

  // fonction pour afficher resultat selectionnée
  showResult(result: any) {
    this.coursService.getCours().subscribe((res) => {
      this.cours = res;

      this.cours = this.cours.filter(
        (cours) => cours.matiereR && cours.typeR === result
      );

      console.log(this.classe);
      console.log(this.cours);

      this.hidden = false;
    });
  }
}
