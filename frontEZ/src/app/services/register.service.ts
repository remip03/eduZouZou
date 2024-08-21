import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class RegisterService {
  private apiUrl = 'https://localhost:8000/api';
  // private apiUrl = 'https://localhost:8000/api';

  constructor(private httpClient: HttpClient) {}
}
