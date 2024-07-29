import { MessageComponent } from './../../message/message.component';
import { RouterLink } from '@angular/router';
import { Component } from '@angular/core';

@Component({
  selector: 'app-messagerie',
  standalone: true,
  imports: [RouterLink, MessageComponent],
  templateUrl: './messagerie.component.html',
  styleUrl: './messagerie.component.css',
})
export class MessagerieComponent {}
