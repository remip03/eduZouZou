import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { EcoleService } from '../../../services/ecole.service';
import Ecole from '../../../models/ecole.modelt';
import { CommonModule } from '@angular/common';
import { AuthService } from '../../../services/auth.service';

@Component({
  selector: 'app-ecole',
  standalone: true,
  imports: [RouterLink, CommonModule],
  templateUrl: './ecole.component.html',
  styleUrl: './ecole.component.css'
})
export class EcoleComponent implements OnInit {
  detail!: Ecole; // Propriété pour stocker les détails de l'école
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur

  // Constructeur du composant, injecte Router, ActivatedRoute, EcoleService et AuthService
  constructor(private router: Router,
    private route: ActivatedRoute,
    private ecoleService: EcoleService,
    private authService: AuthService
  ) { }


  // Méthode pour s'abonner aux détails de l'école
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
    this.role = this.authService.getRole(); // Récupère le rôle de l'utilisateur depuis le AuthService
  }

  // Méthode pour confirmer la suppression de l'école
  confirmDelete(): void {
    // Affiche une boîte de dialogue de confirmation
    if (confirm('Êtes vous sûr de vouloir supprimer l\'école ??')) {
      // Si l'utilisateur confirme, appelle la méthode deleteEcole
      this.deleteEcole();
    }
  }

  // Méthode pour supprimer l'école
  deleteEcole(): void {
    // Vérifie si l'école est défini
    if (this.detail) {
      // Appelle le service pour supprimer l'école et s'abonne à la réponse
      this.ecoleService.deleteEcole(this.detail.id).subscribe(() => {
        // Redirige vers la liste des ecoles après la suppression
        this.router.navigate(['/ecoles']);
      });
    }
  }

}
