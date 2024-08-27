import { Component } from '@angular/core';
import { DatePipe } from '@angular/common';
import {
  FormBuilder,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { MessageService } from '../../../services/message.service';
import { AuthService } from '../../../services/auth.service';
import { MessageComponent } from '../message.component';
import Message from '../../../models/message.models';

@Component({
  selector: 'app-add-message',
  standalone: true,
  imports: [ReactiveFormsModule, MessageComponent],
  templateUrl: './add-message.component.html',
  styleUrl: './add-message.component.css',
  providers: [DatePipe],
})
export class AddMessageComponent {
  messages: Message[] = []; // variable pour stocker la liste des messages
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur

  // datetime pour message
  public date = new Date();
  public formattedDate = this.datePipe.transform(
    this.date,
    'yyyy-MM-dd HH:mm:ss'
  );

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
    private datePipe: DatePipe,
    private messageService: MessageService,
    private authService: AuthService,
    private formBuilder: FormBuilder
  ) {}

  createMessage(): void {
    console.log(this.formattedDate);

    // crée le message
    this.messageService.addMessage(this.createMsg.value).subscribe();
    this.createMsg.patchValue({ msgDate: this.formattedDate });
    console.log(this.createMsg.value.msgDate); // to test the value in console
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
  // dateAuto() {
  //   this.date = new Date();
  //   this.formattedDate = this.date.toLocaleDateString();
  //   this.createMsg.patchValue({ msgDate: this.formattedDate });
  //   //console.log(this.createMsg.value.msgDate); // to test the value in console
  // }
  formatDateTime(date: Date): string {
    const day = date.getDate().toString().padStart(2, '0');
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    const seconds = date.getSeconds().toString().padStart(2, '0');
    return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
    const formattedDate = date.toISOString().split('T')[0];
    return formattedDate;
    const formattedTime = date.toISOString().split('T')[1].split('.')[0];
    return `${formattedDate} ${formattedTime}`;
    const formattedDateTime = `${formattedDate} ${formattedTime}`;
    return formattedDateTime;
    const formattedDateTime = `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
    return formattedDateTime;
    return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
  }

  //
  get form() {
    return this.createMsg.controls;
  }
}
