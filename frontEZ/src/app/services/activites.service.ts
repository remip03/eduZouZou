import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Activite from '../models/activite.model';

@Injectable({
  providedIn: 'root'
})
export class ActivitesService {


  private ezURL = 'http://localhost:8000/api'

  constructor(private httpClient: HttpClient) { }

  getActivites() : Observable<Activite[]>{
    return this.httpClient.get<Activite[]>(`${this.ezURL}/activites`)
  }

  getActivite(id: number) : Observable<Activite>{
    return this.httpClient.get<Activite>(`${this.ezURL}/activites/${id}`)
  }

  addActivite(activite: Activite): Observable<Activite>{
    return this.httpClient.post<Activite>(`${this.ezURL}/activites`, activite)
  }

  updateActivite(activite: Activite): Observable<Activite>{
    return this.httpClient.put<Activite>(`${this.ezURL}/activites/${activite.id}`, activite)
  }

  deleteActivite (id: number): Observable<Activite>{
    return this.httpClient.delete<Activite>(`${this.ezURL}/activites/${id}`)
  }

}
