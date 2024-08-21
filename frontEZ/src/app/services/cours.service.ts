import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Cours from '../models/Cours.model';

@Injectable({
  providedIn: 'root'
})
export class CoursService {

  // private apiUrl = 'https://localhost:8000/api';
  private apiUrl = 'https://localhost:8000/api';

  constructor(private httpClient: HttpClient) { }

  getCours() : Observable<Cours[]>{
    return this.httpClient.get<Cours[]>(`${this.apiUrl}/cours`)
  }

  getCour(id: number) : Observable<Cours>{
    return this.httpClient.get<Cours>(`${this.apiUrl}/cours/${id}`)
  }

  addCours(cours: Cours): Observable<Cours>{
    return this.httpClient.post<Cours>(`${this.apiUrl}/cours`, cours)
  }

  updateCours(cours: Cours): Observable<Cours>{
    return this.httpClient.put<Cours>(`${this.apiUrl}/cours/${cours.id}`, cours)
  }

  deleteCours (id: number): Observable<Cours>{
    return this.httpClient.delete<Cours>(`${this.apiUrl}/cours/${id}`)
  }
}
