import { CommonModule } from '@angular/common';
import { Component, Input } from '@angular/core';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import Ecole from '../../../../models/ecole.modelt';
import { EcoleService } from '../../../../services/ecole.service';
import { AuthService } from '../../../../services/auth.service';

@Component({
  selector: 'app-ecole-details',
  standalone: true,
  imports: [RouterLink, CommonModule],
  templateUrl: './ecole-details.component.html',
  styleUrl: './ecole-details.component.css'
})
export class EcoleDetailsComponent {
  ecoleId: number; // Propriété pour stocker l'id de l'école
  @Input() ecole: Ecole | undefined; // Propriété d'entrée pour recevoir les détails de l'école'

  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur

  // Constructeur du composant, injecte Router, ActivatedRoute, EcoleService et AuthService
  constructor(private router: Router,
    private route: ActivatedRoute,
    private ecoleService: EcoleService,
    private authService: AuthService) {
    // Récupère l'ID de l'école depuis les paramètres de la route et le convertit en nombre
    this.ecoleId = +this.route.snapshot.paramMap.get('id')!;
  }

  // Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void {
    // Récupère le rôle de l'utilisateur depuis le AuthService
    this.role = this.authService.getRole();
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
    if (this.ecole) {
      // Appelle le service pour supprimer l'école et s'abonne à la réponse
      this.ecoleService.deleteEcole(this.ecole.id).subscribe(() => {
        // Redirige vers la liste des ecoles après la suppression
        this.router.navigate(['/ecoles']);
      });
    }
  }
}
