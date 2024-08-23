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
  hidden: boolean = false;

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

  // // Fonction pour filtrer et afficher les resultats par classe
  // filterByClasse(rep: any) {
  //   this.classe = this.classe.filter((classe) => this.classe.values === rep);
  //   console.log(this.cours);
  //   console.log(this.classe);

  //   this.isVisible = false;
  // }
  // // Fonction pour filtrer et afficher les resultats par matière
  // filterByMatiere(rep: any) {
  //   this.matiere = this.matiere.filter(
  //     (matiere) => this.matiere.values === rep
  //   );
  //   console.log(this.cours);
  //   console.log(this.matiere);
  // }
  // fonction pour selectionner classe
  selectFilter(rep: any) {
    this.classe = [rep];

    console.log(this.classe);
  }

  // fonction pour afficher classe selectionnée
  showClasse() {
    this.coursService.getCours().subscribe((res) => {
      this.cours = res;
      console.log(this.classe);
    });
  }
}
