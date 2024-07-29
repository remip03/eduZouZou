<<<<<<< HEAD
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class MessageService {
  constructor() {}
=======
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Message from '../models/message.models';

@Injectable({
  providedIn: 'root'
})
export class MessageService {

  private ezURL = 'http://localhost:8000/api'

  constructor(private httpClient: HttpClient) { }

  getMessages() : Observable<Message[]>{
    return this.httpClient.get<Message[]>(`${this.ezURL}/message`)
  }

  getMessage(id: number) : Observable<Message>{
    return this.httpClient.get<Message>(`${this.ezURL}/message/${id}`)
  }

  addMessage(message: Message): Observable<Message>{
    return this.httpClient.post<Message>(`${this.ezURL}/message`, message)
  }

  updateMessage(message: Message): Observable<Message>{
    return this.httpClient.put<Message>(`${this.ezURL}/message/${message.id}`, message)
  }

  deleteMessage (id: number): Observable<Message>{
    return this.httpClient.delete<Message>(`${this.ezURL}/message/${id}`)
  }

>>>>>>> 78131806d90e4d8f9cbb4e3782c460238712d194
}
