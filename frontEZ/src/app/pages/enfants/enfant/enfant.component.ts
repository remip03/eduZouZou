import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import Enfant from '../../../models/enfant.model';
import { AuthService } from '../../../services/auth.service';
import { EnfantService } from '../../../services/enfant.service';

@Component({
  selector: 'app-enfant',
  standalone: true,
  imports: [RouterLink, CommonModule],
  templateUrl: './enfant.component.html',
  styleUrl: './enfant.component.css'
})
export class EnfantComponent implements OnInit {
  detail!: Enfant; // Propriété pour stocker les détails de la Enfant
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur

  // Constructeur du composant, injecte Router, ActivatedRoute, EnfantService et AuthService
  constructor(private router: Router,
    private route: ActivatedRoute,
    private enfantService: EnfantService,
    private authService: AuthService
  ) { }


  // Mérgode pour s'abonner aux détails de l'enfant
  private subscribeEnfant(id: number) {
    this.enfantService.getEnfant(id).subscribe((response) => {
      this.detail = response; // Met à jour la propriété détail avec la réponse
    });
  }

  // Méthode pour vérifier et s'abonner à l'enfant en fonction de l'id
  private setSubscribe(id: string | null) {
    if (id && !isNaN(+id)) { // Vérifie si l'id est valide
      this.subscribeEnfant(+id); // Si l'id est valide, s'abonner aux détails de l'enfant
    } else if (!id) {
      this.router.navigate(['not-found']);
    }
  }

  // Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id') // Récupère l'id de l'enfant depuis les paramètres de la route
    this.setSubscribe(id); // Appel la méthode setSubscribe avec l'id récupéré
    this.role = this.authService.getRole(); // Récupère le rôle de l'utilisateur depuis le AuthService
  }

  // Méthode pour confirmer la suppression de l'enfant
  confirmDelete(): void {
    // Affiche une boîte de dialogue de confirmation
    if (confirm('Êtes vous sûr de vouloir supprimer l\'enfant ??')) {
      // Si l'utilisateur confirme, appelle la méthode deleteEnfant
      this.deleteEnfant();
    }
  }

  // Méthode pour supprimer l'enfant
  deleteEnfant(): void {
    // Vérifie si l'enfant est défini
    if (this.detail) {
      // Appelle le service pour supprimer l'enfant et s'abonne à la réponse
      this.enfantService.deleteEnfant(this.detail.id).subscribe(() => {
        // Redirige vers la liste des enfants après la suppression
        this.router.navigate(['/enfants']);
      });
    }
  }
}
