import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Enfant from '../models/enfant.model';

@Injectable({
  providedIn: 'root'
})
export class EnfantService {

  // private apiUrl = 'https://localhost:8000/api';
  private apiUrl = 'http://localhost:8000/api';

  constructor(private httpClient: HttpClient) { }

  getEnfants() : Observable<Enfant[]>{
    return this.httpClient.get<Enfant[]>(`${this.apiUrl}/enfants`)
  }

  getEnfant(id: number) : Observable<Enfant>{
    return this.httpClient.get<Enfant>(`${this.apiUrl}/enfants/${id}`)
  }

  createEnfant(enfant: Enfant): Observable<Enfant>{
    return this.httpClient.post<Enfant>(`${this.apiUrl}/enfants`, enfant)
  }

  updateEnfant(enfant: Enfant): Observable<Enfant>{
    return this.httpClient.put<Enfant>(`${this.apiUrl}/enfants/${enfant.id}`, enfant)
  }

  deleteEnfant(id: number): Observable<Enfant>{
    return this.httpClient.delete<Enfant>(`${this.apiUrl}/enfants/${id}`)
  }

}
