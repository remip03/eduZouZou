import { MessageComponent } from './../../message/message.component';
import { RouterLink } from '@angular/router';
import { Component } from '@angular/core';
import { MessagesTablesComponent } from './messages-tables/messages-tables.component';

@Component({
  selector: 'app-messagerie',
  standalone: true,
  imports: [RouterLink, MessageComponent, MessagesTablesComponent],
  templateUrl: './messagerie.component.html',
  styleUrl: './messagerie.component.css',
})
export class MessagerieComponent {}
