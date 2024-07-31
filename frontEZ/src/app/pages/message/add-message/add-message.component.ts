import { MessageComponent } from './../message.component';
import { Component } from '@angular/core';
import Message from '../../../models/message.models';
import {
  FormBuilder,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { MessageService } from '../../../services/message.service';
import { AuthService } from '../../../services/auth.service';

@Component({
  selector: 'app-add-message',
  standalone: true,
  imports: [ReactiveFormsModule, MessageComponent],
  templateUrl: './add-message.component.html',
  styleUrl: './add-message.component.css',
})
export class AddMessageComponent {
  messages: Message[] = []; // variable pour stocker la liste des messages
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur
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
    private formBuilder: FormBuilder
  ) {}

  createMessage(): void {
    // crée le message
    this.messageService.addMessage(this.createMsg.value).subscribe();
    // Actualise la liste des messages
    this.messageService
      .getAllMessages()
      .subscribe((responseMsg) => (this.messages = responseMsg));
    // Réinitialise le formulaire
    this.createMsg.reset();
    // Récupère le rôle de l'utilisateur
    this.role = this.authService.getRole();
    // Affiche une notification si le message est créé avec succès
    alert('Message créé avec succès!');
  }
  //
  get form() {
    return this.createMsg.controls;
  }
}
