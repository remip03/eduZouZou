import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Classe from '../models/classe.models';

@Injectable({
  providedIn: 'root'
})
export class ClasseService {


  private ezURL = 'http://localhost:8000/api'

  constructor(private httpClient: HttpClient) { }

  getClasses() : Observable<Classe[]>{
    return this.httpClient.get<Classe[]>(`${this.ezURL}/classe`)
  }

  getClasse(id: number) : Observable<Classe>{
    return this.httpClient.get<Classe>(`${this.ezURL}/classe/${id}`)
  }

  addClasse(classe: Classe): Observable<Classe>{
    return this.httpClient.post<Classe>(`${this.ezURL}/classe`, classe)
  }

  updateClasse(classe: Classe): Observable<Classe>{
    return this.httpClient.put<Classe>(`${this.ezURL}/classe/${classe.id}`, classe)
  }

  deleteClasse (id: number): Observable<Classe>{
    return this.httpClient.delete<Classe>(`${this.ezURL}/classe/${id}`)
  }

}
