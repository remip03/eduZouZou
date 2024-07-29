import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Messagerie from '../models/messagerie.models';

@Injectable({
  providedIn: 'root'
})
export class MessagerieService {

  private ezURL = 'http://localhost:8000/api'

  constructor(private httpClient: HttpClient) { }

  getMessageries() : Observable<Messagerie[]>{
    return this.httpClient.get<Messagerie[]>(`${this.ezURL}/messagerie`)
  }

  getMessagerie(id: number) : Observable<Messagerie>{
    return this.httpClient.get<Messagerie>(`${this.ezURL}/messagerie/${id}`)
  }

  addMessagerie(messagerie: Messagerie): Observable<Messagerie>{
    return this.httpClient.post<Messagerie>(`${this.ezURL}/messagerie`, messagerie)
  }

  updateMessagerie(messagerie: Messagerie): Observable<Messagerie>{
    return this.httpClient.put<Messagerie>(`${this.ezURL}/messagerie/${messagerie.id}`, messagerie)
  }

  deleteMessagerie (id: number): Observable<Messagerie>{
    return this.httpClient.delete<Messagerie>(`${this.ezURL}/messagerie/${id}`)
  }

}
