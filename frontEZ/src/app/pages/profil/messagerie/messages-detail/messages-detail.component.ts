import { Component } from '@angular/core';
import Message from '../../../../models/message.models';
import { MessageService } from '../../../../services/message.service';
import { AuthService } from '../../../../services/auth.service';
import {
  FormBuilder,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';

@Component({
  selector: 'app-messages-detail',
  standalone: true,
  imports: [ReactiveFormsModule, RouterLink],
  templateUrl: './messages-detail.component.html',
  styleUrl: './messages-detail.component.css',
})
export class MessagesDetailComponent {
  messages: Message[] = []; // variable pour stocker la liste des messages
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur
  msgId?: number;

  msg: any;

  constructor(
    private messageService: MessageService,
    private authService: AuthService,
    private formBuilder: FormBuilder,
    private route: ActivatedRoute,
    private router: Router
  ) {
    this.msg = this.formBuilder.group({
      content: ['', Validators.required],
      expediteur: ['', Validators.required],
      destinataire: ['', Validators.required],
      msgDate: [''],
    });
  }

  ngOnInit(): void {
    this.msgId = Number(this.route.snapshot.paramMap.get('id'));
    if (this.msgId) {
      this.messageService.getMessage(this.msgId).subscribe((data: Message) => {
        console.log(data);
      });
    }
    this.msg = this.messageService.getMessage(this.msgId).subscribe();
    console.log(this.msg);
  }

  //méthode pour récupérer un message par son id
  getMessage(id: number): void {
    this.messageService.getMessage(id).subscribe(
      (data) => {
        this.msg = data;
      },
      (error) => {
        console.error('Erreur lors de la récupération du message:', error);
      }
    );
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

  editMessage(): void {
    this.msgId = Number(this.route.snapshot.paramMap.get('id'));
    if (this.msg.valid) {
      this.messageService
        .updateMessage(this.msgId, this.msg.value)
        .subscribe(() => this.router.navigate(['/messages']));
    } else {
      console.log('Form is invalid');
    }
    // Récupère le rôle de l'utilisateur
    this.role = this.authService.getRole();
    // Affiche une notification si le message est créé avec succès
    alert('Message modifié avec succès!');
  }

  get form() {
    return this.msg.controls;
  }
}
