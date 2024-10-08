import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import Message from '../../models/message.models';
import { MessageService } from '../../services/message.service';
import { AuthService } from '../../services/auth.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AddMessageComponent } from './add-message/add-message.component';

@Component({
  selector: 'app-message',
  standalone: true,
  imports: [RouterLink, CommonModule, AddMessageComponent],
  templateUrl: './message.component.html',
  styleUrl: './message.component.css',
})
export class MessageComponent implements OnInit {
  messages: Message[] = []; // variable pour stocker la liste des messages
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur
  msgId?: number;

  // variable pour créer un message
  createMsg: FormGroup = this.formBuilder.group({
    content: [
      '',
      [Validators.required, Validators.minLength(5), Validators.maxLength(500)],
    ],
    destinataire: ['', [Validators.required, Validators.minLength(2)]],
    expediteur: ['', [Validators.required, Validators.minLength(2)]],
    msgDate: ['', [Validators.required]],
  });

  //constructeur appel du Message Service
  constructor(
    private messageService: MessageService,
    private authService: AuthService,
    private formBuilder: FormBuilder,
    private route: ActivatedRoute,
    private router: Router
  ) {}

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

  //methode pour creer un message
  createMessage(): void {
    this.messageService.addMessage(this.createMsg.value).subscribe(() => {
      // Réinitialise le formulaire
      this.createMsg.reset();
      // Actualise la liste des messages
      this.messageService
        .getAllMessages()
        .subscribe((responseMsg) => (this.messages = responseMsg));
    });
  }

  //méthode pour afficher le message à la réception
  showMessage(message: Message): void {
    alert(`Expéditeur : ${message.expediteur}\nContenu : ${message.content}`);
  }

  //méthode pour filtrer les messages par destinataire
  filterMessages(destinataire: string): void {
    // Récupère la liste des messages
    this.messageService.getAllMessages().subscribe((responseMsg) => {
      // Filtrer les messages par destinataire
      this.messages = responseMsg.filter(
        (msg) => msg.destinataire === destinataire
      );
    });
  }

  //méthode pour trier les messages par expéditeur
  sortMessagesByExpediteur(): void {
    // Récupère la liste des messages
    this.messageService.getAllMessages().subscribe((responseMsg) => {
      // Trie les messages par expéditeur
      this.messages = responseMsg.sort((a, b) =>
        a.expediteur.localeCompare(b.expediteur)
      );
    });
  }

  //méthode pour trier les messages par contenu
  sortMessagesByContent(): void {
    // Récupère la liste des messages
    this.messageService.getAllMessages().subscribe((responseMsg) => {
      // Trie les messages par contenu
      this.messages = responseMsg.sort((a, b) =>
        a.content.localeCompare(b.content)
      );
    });
  }

  //méthode pour trier les messages par date de création
  sortMessagesByDate(): void {
    // Récupère la liste des messages
    this.messageService.getAllMessages().subscribe((responseMsg) => {
      // Trie les messages par date de création
      this.messages = responseMsg.sort(
        (a, b) => new Date(a.msgDate).getTime() - new Date(b.msgDate).getTime()
      );
    });
  }
}
