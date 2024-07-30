import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import Message from '../models/message.models';

@Injectable({
  providedIn: 'root',
})
export class MessageService {
  private ezURL = 'http://localhost:8000/api';

  constructor(private httpClient: HttpClient) {}

  getAllMessages(): Observable<Message[]> {
    return this.httpClient.get<Message[]>(`${this.ezURL}/messages`);
  }

  getMessage(id: number): Observable<Message> {
    return this.httpClient.get<Message>(`${this.ezURL}/messages/${id}`);
  }

  addMessage(message: Message): Observable<Message> {
    return this.httpClient.post<Message>(`${this.ezURL}/messages`, message);
  }

  updateMessage(id: number, message: Message): Observable<Message> {
    return this.httpClient.put<Message>(
      `${this.ezURL}/messages/${id}`,
      message
    );
  }

  deleteMessage(id: number): Observable<Message> {
    return this.httpClient.delete<Message>(`${this.ezURL}/messages/${id}`);
  }
}
