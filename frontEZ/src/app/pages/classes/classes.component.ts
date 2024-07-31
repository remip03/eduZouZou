import { Component, OnInit } from '@angular/core';
import Classe from '../../models/classe.model';
import { ClasseService } from '../../services/classe.service';
import { AuthService } from '../../services/auth.service';
import { RouterLink } from '@angular/router';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-classes',
  standalone: true,
  imports: [RouterLink, CommonModule],
  templateUrl: './classes.component.html',
  styleUrl: './classes.component.css'
})
export class ClassesComponent implements OnInit{
  classes: Classe[] = []; // Propriété pour stocker la liste des classes
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur

  // Constructeur du composant, injecte ClasseService
  constructor(private classeService: ClasseService, private authService: AuthService) { }

  // Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void {
    this.loadClasses();
    this.role = this.authService.getRole();
  }

  // Méthode pour charger la liste des classes
  loadClasses(): void {
    this.classeService.getClasses().subscribe((data: Classe[]) => {
      this.classes = data;
    });
  }
}
