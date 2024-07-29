import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { EcoleService } from '../../../services/ecole.service';
import Ecole from '../../../models/ecole.modelt';
import { EcoleDetailsComponent } from './ecole-details/ecole-details.component';

@Component({
  selector: 'app-ecole',
  standalone: true,
  imports: [EcoleDetailsComponent],
  templateUrl: './ecole.component.html',
  styleUrl: './ecole.component.css'
})
export class EcoleComponent implements OnInit {
  detail!: Ecole; // Propriété pour stocker les détails de l'école

  // Constructeur du composant, injecte Router, ActivatedRoute et EcoleService
  constructor(private router: Router,
    private route: ActivatedRoute,
    private ecoleService: EcoleService
  ) { }


  // Mérgode pour s'abonner aux détails de l'école
  private subscribeEcole(id: number) {
    this.ecoleService.getEcole(id).subscribe((response) => {
      this.detail = response; // Met à jour la propriété détail avec la réponse
    });
  }

  // Méthode pour vérifier et s'abonner à l'école en fonction de l'id
  private setSubscribe(id: string | null) {
    if (id && !isNaN(+id)) { // Vérifie si l'id est valide
      this.subscribeEcole(+id); // Si l'id est valide, s'abonner aux détails de l'école
    } else if (!id) {
      this.router.navigate(['not-found']);
    }
  }

  // Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id') // Récupère l'id de l'ecole depuis les paramètres de la route
    this.setSubscribe(id); // Appel la méthode setSubscribe avec l'id récupéré
  }

}
