import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Classe from '../models/classe.model';

@Injectable({
  providedIn: 'root'
})
export class ClasseService {


  private apiUrl = 'http://localhost:8000/api'

  constructor(private httpClient: HttpClient) { }

  getClasses(): Observable<Classe[]> {
    return this.httpClient.get<Classe[]>(`${this.apiUrl}/classes`)
  }

  getClasse(id: number): Observable<Classe> {
    return this.httpClient.get<Classe>(`${this.apiUrl}/classes/${id}`)
  }

  createClasse(classe: Classe): Observable<Classe> {
    return this.httpClient.post<Classe>(`${this.apiUrl}/classes`, classe)
  }

  updateClasse(classe: Classe): Observable<Classe> {
    return this.httpClient.put<Classe>(`${this.apiUrl}/classes/${classe.id}`, classe)
  }

  deleteClasse(id: number): Observable<Classe> {
    return this.httpClient.delete<Classe>(`${this.apiUrl}/classes/${id}`)
  }
}
