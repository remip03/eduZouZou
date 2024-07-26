import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Ecole from '../models/ecole.models';

@Injectable({
  providedIn: 'root'
})
export class EcoleService {

  private ezURL = 'http://localhost:8000/api'

  constructor(private httpClient: HttpClient) { }

  getEcoles() : Observable<Ecole[]>{
    return this.httpClient.get<Ecole[]>(`${this.ezURL}/ecole`)
  }

  getEcole(id: number) : Observable<Ecole>{
    return this.httpClient.get<Ecole>(`${this.ezURL}/ecole/${id}`)
  }

  addEcole(ecole: Ecole): Observable<Ecole>{
    return this.httpClient.post<Ecole>(`${this.ezURL}/ecole`, ecole)
  }

  updateEcole(ecole: Ecole): Observable<Ecole>{
    return this.httpClient.put<Ecole>(`${this.ezURL}/ecole/${ecole.id}`, ecole)
  }

  deleteEcole (id: number): Observable<Ecole>{
    return this.httpClient.delete<Ecole>(`${this.ezURL}/ecole/${id}`)
  }

}
