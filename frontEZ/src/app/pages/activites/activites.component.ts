import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { ActivitesService } from '../../services/activites.service';
import Activite from '../../models/activite.model';
import { VariablesGlobales } from '../../commons/variablesGlobales';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ReturnBtnComponent } from '../../commons/return-btn/return-btn.component';

@Component({
  selector: 'app-activites',
  standalone: true,
  imports: [RouterLink, CommonModule, FormsModule, ReturnBtnComponent],
  templateUrl: './activites.component.html',
  styleUrl: './activites.component.css',
})
export class ActivitesComponent implements OnInit {
  activites: Activite[] = [];
  classe!: string[];
  matiere!: string[];
  res: Activite[] = [];
  valueSearch: string = '';

  filterValue: string[] = ['matiere', 'classe'];

  isFilterVisible: boolean = false;
  isSearchable: boolean = false;
  hidden: boolean = true;

  valueChange: string = '';

  constructor(private activitesService: ActivitesService) {
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
    this.activitesService.getActivites().subscribe((res) => {
      this.activites = res;
      console.log(this.matiere);
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
    this.activitesService.getActivites().subscribe((res) => {
      this.activites = res;

      this.activites = this.activites.filter(
        (activites) =>
          activites.matiereR === result || activites.typeR === result
      );

      console.log(this.classe);
      console.log(this.activites);

      this.hidden = true;
      if (this.activites.length === 0) {
        alert('Aucun activités ne correspond à votre recherche');
      }
    });
  }
  showResultSearch(result: any) {
    this.activitesService.getActivites().subscribe((res) => {
      this.activites = res;

      this.activites = this.activites.filter(
        (activites) =>
          activites.matiereR === result || activites.typeR === result
      );

      console.log(this.classe);
      console.log(this.activites);

      this.hidden = true;
      if (this.activites.length === 0) {
        alert('Aucun activités ne correspond à votre recherche');
      }
    });
  }
}
