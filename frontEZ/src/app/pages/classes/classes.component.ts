import { Component, OnInit } from '@angular/core';
import Classe from '../../models/classe.model';
import { ClasseService } from '../../services/classe.service';
import { AuthService } from '../../services/auth.service';
import { RouterLink } from '@angular/router';
import { CommonModule } from '@angular/common';
import { ReturnBtnComponent } from "../../commons/return-btn/return-btn.component";
import { VariablesGlobales } from '../../commons/variablesGlobales';

@Component({
  selector: 'app-classes',
  standalone: true,
  imports: [RouterLink, CommonModule, ReturnBtnComponent],
  templateUrl: './classes.component.html',
  styleUrl: './classes.component.css'
})
export class ClassesComponent implements OnInit{
  classes: Classe[] = []; // Propriété pour stocker la liste des classes
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur
  couleurs!: string[]; // variable pour stocker les codes couleurs

  // Constructeur du composant, injecte ClasseService
  constructor(private classeService: ClasseService, private authService: AuthService) {
    this.couleurs = VariablesGlobales.colorList //importe la liste des couleurs du composant variables globales (dans les commons)
  }

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
