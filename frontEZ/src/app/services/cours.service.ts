import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Cours from '../models/Cours.model';

@Injectable({
  providedIn: 'root'
})
export class CoursService {

  private ezURL = 'http://localhost:8000/api'

  constructor(private httpClient: HttpClient) { }

  getCours() : Observable<Cours[]>{
    return this.httpClient.get<Cours[]>(`${this.ezURL}/cours`)
  }

  getCour(id: number) : Observable<Cours>{
    return this.httpClient.get<Cours>(`${this.ezURL}/cours/${id}`)
  }

  addCours(cours: Cours): Observable<Cours>{
    return this.httpClient.post<Cours>(`${this.ezURL}/cours`, cours)
  }

  updateCours(cours: Cours): Observable<Cours>{
    return this.httpClient.put<Cours>(`${this.ezURL}/cours/${cours.id}`, cours)
  }

  deleteCours (id: number): Observable<Cours>{
    return this.httpClient.delete<Cours>(`${this.ezURL}/cours/${id}`)
  }
}
