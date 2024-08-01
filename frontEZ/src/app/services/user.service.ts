import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import User from '../models/user.models';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  private apiUrl = 'http://localhost:8000/api';
  // private apiUrl = 'https://localhost:8000/api';

  constructor(private httpClient: HttpClient) { }

  getUsers(): Observable<User[]> {
    return this.httpClient.get<User[]>(`${this.apiUrl}/user`)
  }

  getUser(id: number): Observable<User> {
    return this.httpClient.get<User>(`${this.apiUrl}/user/${id}`)
  }

  addUser(user: User): Observable<User> {
    return this.httpClient.post<User>(`${this.apiUrl}/user`, user)
  }

  updateUser(user: User): Observable<User> {
    return this.httpClient.put<User>(`${this.apiUrl}/user/${user.id}`, user)
  }

  deleteUser(id: number): Observable<User> {
    return this.httpClient.delete<User>(`${this.apiUrl}/user/${id}`)
  }

}
