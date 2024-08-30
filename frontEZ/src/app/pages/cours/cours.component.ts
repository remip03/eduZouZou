import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import Cours from '../../models/Cours.model';
import { CoursService } from '../../services/cours.service';
import { CommonModule } from '@angular/common';
import { VariablesGlobales } from '../../commons/variablesGlobales';
import { FormsModule } from '@angular/forms';
import { ReturnBtnComponent } from '../../commons/return-btn/return-btn.component';

@Component({
  selector: 'app-cours',
  standalone: true,
  imports: [RouterLink, CommonModule, FormsModule, ReturnBtnComponent],
  templateUrl: './cours.component.html',
  styleUrl: './cours.component.css',
})
export class CoursComponent implements OnInit {
  cours: Cours[] = [];
  classe!: string[];
  matiere!: string[];
  res: Cours[] = [];
  valueSearch: string = '';

  filterValue: string[] = ['matiere', 'classe'];

  isFilterVisible: boolean = false;
  isSearchable: boolean = false;
  hidden: boolean = true;

  valueChange: string = '';

  constructor(private coursService: CoursService) {
    this.classe = VariablesGlobales.niveauCl;
    this.matiere = VariablesGlobales.matieres;
  }

  toogleFilter() {
    this.isSearchable = false;
    this.isFilterVisible = !this.isFilterVisible;
    if (!this.isFilterVisible) {
      location.reload();
    }
  }
  toogleSearch() {
    this.isFilterVisible = false;
    this.isSearchable = !this.isSearchable;
    if (!this.isSearchable) {
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
      this.isFilterVisible = false;
    });
  }

  colors: any[] = [
    '#F9DBA0',
    '#FBB0A7',
    '#BBE2EA',
    '#F2A6FD',
    '#A7B2FB',
    '#F9AAB8',
  ];
  // fonction pour modifier couleur suivant le tableau colors
  getColor(index: number): string {
    return this.colors[index % this.colors.length];
  }

  // fonction pour selectionner le filtre
  selectFilter(rep: any) {
    this.isFilterVisible = false;
    this.showResult(rep);
    console.log(this.classe);
  }

  // fonction pour afficher resultat selectionnée
  showResult(result: any) {
    this.coursService.getCours().subscribe((res) => {
      this.cours = res;

      this.cours = this.cours.filter(
        (cours) => cours.matiereR === result || cours.typeR === result
      );

      console.log(this.classe);
      console.log(this.cours);

      this.hidden = true;
      if (this.cours.length === 0) {
        alert('Aucun cours ne correspond à votre recherche');
      }
    });
  }
  showResultSearch(result: any) {
    this.coursService.getCours().subscribe((res) => {
      this.cours = res;

      this.cours = this.cours.filter(
        (cours) => cours.matiereR === result || cours.typeR === result
      );

      console.log(this.classe);
      console.log(this.cours);

      this.hidden = true;
      if (this.cours.length === 0) {
        alert('Aucun cours ne correspond à votre recherche');
      }
    });
  }
}
