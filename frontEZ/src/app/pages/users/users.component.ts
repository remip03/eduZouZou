import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import User from '../../models/user.models';
import { UserService } from '../../services/user.service';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-users',
  standalone: true,
  imports: [RouterLink, CommonModule],
  templateUrl: './users.component.html',
  styleUrl: './users.component.css'
})
export class UsersComponent implements OnInit{
  users: User[] = []; // Propriété pour stocker la liste des utilisateurs
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur

  // Constructeur du composant, injecte UserService
  constructor(private userService: UserService, private authService: AuthService) { }

  // Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void {
    this.loadUsers();
    this.role = this.authService.getRole();
  }

  // Méthode pour charger la liste des écoles
  loadUsers(): void {
    this.userService.getUsers().subscribe((data: User[]) => {
      this.users = data;
    });
  }
}
