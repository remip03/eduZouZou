import { Component } from '@angular/core';
import { MessageService } from '../../../../services/message.service';
import { AuthService } from '../../../../services/auth.service';
import { FormBuilder } from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { MessageType } from '../../../../models/messageType.model';
import Message from '../../../../models/message.models';

@Component({
  selector: 'app-messages-tables',
  standalone: true,
  imports: [RouterLink],
  templateUrl: './messages-tables.component.html',
  styleUrl: './messages-tables.component.css',
})
export class MessagesTablesComponent {
  messages: Message[] = []; // variable pour stocker la liste des messages
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur
  msgType: MessageType[] = []; //

  //constructeur appel du Message Service
  constructor(
    private messageService: MessageService,
    private authService: AuthService,
    private formBuilder: FormBuilder,
    private route: ActivatedRoute,
    private router: Router
  ) {}

  hasVisibleMsg(): boolean {
    return this.msgType.some((msg) => msg.isVisible);
  }

  //méthode appelée lors du chargement du composant
  ngOnInit(): void {
    //recupère le role
    this.role = this.authService.getRole();
    // Récupère la liste des messages
    this.messageService
      .getAllMessages()
      .subscribe((responseMsg) => (this.messages = responseMsg));
  }

  //méthode pour supprimer un message
  deleteMessage(id: number): void {
    // Supprime le message avec son id
    this.messageService.deleteMessage(id).subscribe(() => {
      // Actualise la liste des messages
      this.messageService
        .getAllMessages()
        .subscribe((responseMsg) => (this.messages = responseMsg));
    });
  }
  messageDetail(): void {}
}
