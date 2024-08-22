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

  result: Cours[] = [];

  constructor(private coursService: CoursService) {
    this.classe = VariablesGlobales.niveauCl;
    this.matiere = VariablesGlobales.matieres;

    // Ajouter un écouteur d'événement sur la balise <select>
    const selectElement = document.getElementById(
      'classeSelect'
    ) as HTMLSelectElement;
    // selectElement.addEventListener('change', () =>
    //   this.filterByClasse(selectElement.value)
    // );
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

  // Fonction pour filtrer et afficher les étudiants par classe
  filterAndDisplayByClasse(classeCible: string) {
    const filteredresults = this.cours.filter(
      (result) => result.matiereR === classeCible
    );

    // Sélectionner l'élément div où les résultats seront affichés
    const resultatsDiv = document.getElementById('resultats') as HTMLDivElement;

    // Effacer les résultats précédents
    resultatsDiv.innerHTML = '';

    // Afficher les étudiants filtrés
    if (filteredresults.length > 0) {
      filteredresults.forEach((result) => {
        const p = document.createElement('p');
        p.textContent = `matiere: ${result.matiereR}, description: ${result.descriptionR}`;
        resultatsDiv.appendChild(p);
      });
    } else {
      resultatsDiv.textContent = 'Aucun étudiant trouvé pour cette classe.';
    }
  }
}

// // Instanciation de la classe pour lancer le script
// const manager = new resultManager();

//   // Méthode pour filtrer par matière
//   filterByMatiere(matiere: string) {
//     this.filteredCours = this.cours.filter(
//       (cours) => cours.matiereR === matiere
//     );
//   }

//   // Méthode pour reset le filtre
//   resetFilter() {
//     this.filteredCours = this.cours;
//   }

//   // Méthode pour trier par nom
//   sortByType() {
//     this.filteredCours = [...this.filteredCours].sort((a, b) =>
//       a.nameR.localeCompare(b.dtype)
//     );
//   }
//   // Méthode pour trier par matière
//   sortByMatiere() {
//     this.filteredCours = [...this.filteredCours].sort((a, b) =>
//       a.matiereR.localeCompare(b.matiereR)
//     );
//   }
//   // Méthode pour trier par classe
//   sortByClasse() {
//     this.filteredCours = [...this.filteredCours].sort((a, b) =>
//       a.docC.localeCompare(b.typeR)
//     );
//   }
// }
