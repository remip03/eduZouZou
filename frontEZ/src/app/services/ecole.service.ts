import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Ecole from '../models/ecole.modelt';

@Injectable({
  providedIn: 'root'
})
export class EcoleService {

  // URL de base de l'API
  private apiUrl = 'https://localhost:8000/api';

  // Injection du service HttpClient
  constructor(private httpClient: HttpClient) { }

  // Récupération de la liste des écoles
  getEcoles(): Observable<Ecole[]> {
    return this.httpClient.get<Ecole[]>(`${this.apiUrl}/ecoles`);
  }

  // Récupérer un auteur par son ID
  getEcole(id: number): Observable<Ecole> {
    return this.httpClient.get<Ecole>(`${this.apiUrl}/ecoles/${id}`);
  }

  // Créer un nouvel auteur
  createEcole(ecole: Ecole): Observable<Ecole> {
    return this.httpClient.post<Ecole>(`${this.apiUrl}/ecoles`, ecole);
  }

  // Mettre à jour un auteur existant
  updateEcole(ecole: Ecole): Observable<Ecole> {
    return this.httpClient.put<Ecole>(`${this.apiUrl}/ecoles/${ecole.id}`, ecole);
  }

  // Supprimer un auteur par son ID
  deleteEcole(id: number): Observable<Ecole> {
    return this.httpClient.delete<Ecole>(`${this.apiUrl}/ecoles/${id}`);
  }
}
