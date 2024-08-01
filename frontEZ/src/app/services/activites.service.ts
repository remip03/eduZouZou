import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Activite from '../models/activite.model';

@Injectable({
  providedIn: 'root'
})
export class ActivitesService {


  // private apiUrl = 'https://localhost:8000/api';
  private apiUrl = 'http://localhost:8000/api';

  constructor(private httpClient: HttpClient) { }

  getActivites() : Observable<Activite[]>{
    return this.httpClient.get<Activite[]>(`${this.apiUrl}/activites`)
  }

  getActivite(id: number) : Observable<Activite>{
    return this.httpClient.get<Activite>(`${this.apiUrl}/activites/${id}`)
  }

  addActivite(activite: Activite): Observable<Activite>{
    return this.httpClient.post<Activite>(`${this.apiUrl}/activites`, activite)
  }

  updateActivite(activite: Activite): Observable<Activite>{
    return this.httpClient.put<Activite>(`${this.apiUrl}/activites/${activite.id}`, activite)
  }

  deleteActivite (id: number): Observable<Activite>{
    return this.httpClient.delete<Activite>(`${this.apiUrl}/activites/${id}`)
  }

}
