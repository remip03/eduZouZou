import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Enfant from '../models/enfant.model';

@Injectable({
  providedIn: 'root'
})
export class EnfantService {

  private ezURL = 'http://localhost:8000/api'

  constructor(private httpClient: HttpClient) { }

  getEnfants() : Observable<Enfant[]>{
    return this.httpClient.get<Enfant[]>(`${this.ezURL}/enfants`)
  }

  getEnfant(id: number) : Observable<Enfant>{
    return this.httpClient.get<Enfant>(`${this.ezURL}/enfants/${id}`)
  }

  createEnfant(enfant: Enfant): Observable<Enfant>{
    return this.httpClient.post<Enfant>(`${this.ezURL}/enfants`, enfant)
  }

  updateEnfant(enfant: Enfant): Observable<Enfant>{
    return this.httpClient.put<Enfant>(`${this.ezURL}/enfants/${enfant.id}`, enfant)
  }

  deleteEnfant(id: number): Observable<Enfant>{
    return this.httpClient.delete<Enfant>(`${this.ezURL}/enfants/${id}`)
  }

}
