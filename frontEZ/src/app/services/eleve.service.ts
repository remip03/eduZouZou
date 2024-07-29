import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Eleve from '../models/eleve.models';

@Injectable({
  providedIn: 'root'
})
export class EleveService {

  private ezURL = 'http://localhost:8000/api'

  constructor(private httpClient: HttpClient) { }

  getEleves() : Observable<Eleve[]>{
    return this.httpClient.get<Eleve[]>(`${this.ezURL}/eleve`)
  }

  getEleve(id: number) : Observable<Eleve>{
    return this.httpClient.get<Eleve>(`${this.ezURL}/eleve/${id}`)
  }

  addEleve(eleve: Eleve): Observable<Eleve>{
    return this.httpClient.post<Eleve>(`${this.ezURL}/eleve`, eleve)
  }

  updateEleve(eleve: Eleve): Observable<Eleve>{
    return this.httpClient.put<Eleve>(`${this.ezURL}/eleve/${eleve.id}`, eleve)
  }

  deleteEleve (id: number): Observable<Eleve>{
    return this.httpClient.delete<Eleve>(`${this.ezURL}/eleve/${id}`)
  }

}
