import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Ressource from '../models/ressource.models';

@Injectable({
  providedIn: 'root'
})
export class RessourceService {

  // private apiUrl = 'https://localhost:8000/api';
  private apiUrl = 'http://localhost:8000/api';

  constructor(private httpClient: HttpClient) { }

  getRessources() : Observable<Ressource[]>{
    return this.httpClient.get<Ressource[]>(`${this.apiUrl}/Ressources`)
  }

  getRessource(id: number) : Observable<Ressource>{
    return this.httpClient.get<Ressource>(`${this.apiUrl}/Ressources/${id}`)
  }

  addRessource(ressource: Ressource): Observable<Ressource>{
    return this.httpClient.post<Ressource>(`${this.apiUrl}/Ressources`, ressource)
  }

  updateRessource(ressource: Ressource): Observable<Ressource>{
    return this.httpClient.put<Ressource>(`${this.apiUrl}/Ressources/${ressource.id}`, ressource)
  }

  deleteRessource (id: number): Observable<Ressource>{
    return this.httpClient.delete<Ressource>(`${this.apiUrl}/Ressources/${id}`)
  }

}
