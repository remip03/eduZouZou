import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class RegisterService {
  private ezURL = 'http://localhost:8000/api';

  constructor(private httpClient: HttpClient) {}
}
