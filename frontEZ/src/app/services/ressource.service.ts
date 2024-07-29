import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Ressource from '../models/ressource.models';

@Injectable({
  providedIn: 'root'
})
export class RessourceService {

  private ezURL = 'http://localhost:8000/api'

  constructor(private httpClient: HttpClient) { }

  getRessources() : Observable<Ressource[]>{
    return this.httpClient.get<Ressource[]>(`${this.ezURL}/Ressources`)
  }

  getRessource(id: number) : Observable<Ressource>{
    return this.httpClient.get<Ressource>(`${this.ezURL}/Ressources/${id}`)
  }

  addRessource(ressource: Ressource): Observable<Ressource>{
    return this.httpClient.post<Ressource>(`${this.ezURL}/Ressources`, ressource)
  }

  updateRessource(ressource: Ressource): Observable<Ressource>{
    return this.httpClient.put<Ressource>(`${this.ezURL}/Ressources/${ressource.id}`, ressource)
  }

  deleteRessource (id: number): Observable<Ressource>{
    return this.httpClient.delete<Ressource>(`${this.ezURL}/Ressources/${id}`)
  }

}
