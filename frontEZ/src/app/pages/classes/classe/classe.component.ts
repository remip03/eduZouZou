import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import Classe from '../../../models/classe.model';
import { ClasseService } from '../../../services/classe.service';
import { AuthService } from '../../../services/auth.service';
import { ReturnBtnComponent } from "../../../commons/return-btn/return-btn.component";


@Component({
  selector: 'app-classe',
  standalone: true,
  imports: [RouterLink, CommonModule, ReturnBtnComponent],
  templateUrl: './classe.component.html',
  styleUrl: './classe.component.css'
})
export class ClasseComponent implements OnInit {
  detail!: Classe; // Propriété pour stocker les détails de la classe
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur

  // Constructeur du composant, injecte Router, ActivatedRoute, ClasseService et AuthService
  constructor(private router: Router,
    private route: ActivatedRoute,
    private classeService: ClasseService,
    private authService: AuthService
  ) { }


  // Mérgode pour s'abonner aux détails de la classe
  private subscribeClasse(id: number) {
    this.classeService.getClasse(id).subscribe((response) => {
      this.detail = response; // Met à jour la propriété détail avec la réponse
    });
  }

  // Méthode pour vérifier et s'abonner à la classe en fonction de l'id
  private setSubscribe(id: string | null) {
    if (id && !isNaN(+id)) { // Vérifie si l'id est valide
      this.subscribeClasse(+id); // Si l'id est valide, s'abonner aux détails de la classe
    } else if (!id) {
      this.router.navigate(['not-found']);
    }
  }

  // Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id') // Récupère l'id de la classe depuis les paramètres de la route
    this.setSubscribe(id); // Appel la méthode setSubscribe avec l'id récupéré
    this.role = this.authService.getRole(); // Récupère le rôle de l'utilisateur depuis le AuthService
  }

  // Méthode pour confirmer la suppression de la classe
  confirmDelete(): void {
    // Affiche une boîte de dialogue de confirmation
    if (confirm('Êtes vous sûr de vouloir supprimer la classe ??')) {
      // Si l'utilisateur confirme, appelle la méthode deleteClasse
      this.deleteEcole();
    }
  }

  // Méthode pour supprimer la classe
  deleteEcole(): void {
    // Vérifie si la classe est défini
    if (this.detail) {
      // Appelle le service pour supprimer la classe et s'abonne à la réponse
      this.classeService.deleteClasse(this.detail.id).subscribe(() => {
        // Redirige vers la liste des classes après la suppression
        this.router.navigate(['/classes']);
      });
    }
  }

}

