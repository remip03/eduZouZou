import { Component } from '@angular/core';
import {
  FormBuilder,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import Message from '../../../models/message.models';
import { MessageService } from '../../../services/message.service';
import { AuthService } from '../../../services/auth.service';
import { ReturnBtnComponent } from '../../../commons/return-btn/return-btn.component';
import { DatePipe } from '@angular/common';

@Component({
  selector: 'app-messages-detail',
  standalone: true,
  imports: [ReactiveFormsModule, RouterLink, ReturnBtnComponent],
  templateUrl: './messages-detail.component.html',
  styleUrl: './messages-detail.component.css',
})
export class MessagesDetailComponent {
  messages: Message[] = [];
  msgDetail!: Message;
  role: string | null = null; // Propriété pour stocker le rôle de l'utilisateur
  msgId?: number;

  // datetime pour message
  public date = new Date();
  public formattedDate = this.datePipe.transform(
    this.date,
    "yyyy-MM-dd'T'HH:mm:ssZZZZZ"
  );

  msg: any;

  constructor(
    private datePipe: DatePipe,
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
      msgDate: ['', [Validators.required]],
    });
  }

  // Méthode pour s'abonner aux détails du msg
  private subscribeMessage(id: number) {
    this.messageService.getMessage(id).subscribe((response) => {
      this.msgDetail = response; // Met à jour la propriété détail avec la réponse
      console.log(this.msgDetail);
    });
  }

  // Méthode pour vérifier et s'abonner au msg en fonction de l'id
  private setSubscribe(id: string | null) {
    if (id && !isNaN(+id)) {
      // Vérifie si l'id est valide
      this.subscribeMessage(+id); // Si l'id est valide, s'abonner aux détails du msg
    } else if (!id) {
      this.router.navigate(['not-found']);
    }
  }

  // Méthode appelée lors de l'initialisation du composant
  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id'); // Récupère l'id de l'msg depuis les paramètres de la route
    this.setSubscribe(id); // Appel la méthode setSubscribe avec l'id récupéré
    this.role = this.authService.getRole(); // Récupère le rôle de l'utilisateur depuis le AuthService
    console.log(this.msgDetail);
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
      this.msg.patchValue({ msgDate: this.formattedDate });
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

  sendMessage(): void {
    // crée le message
    this.msg.patchValue({ msgDate: this.formattedDate });
    this.msg.patchValue({ expediteur: this.msgDetail.destinataire });
    this.msg.patchValue({ destinataire: this.msgDetail.expediteur });
    this.messageService.addMessage(this.msg.value).subscribe();
    console.log(this.msg.value.msgDate); // to test the value in console

    // Réinitialise le formulaire
    this.msg.reset();
    // Récupère le rôle de l'utilisateur
    this.role = this.authService.getRole();
    // Affiche une notification si le message est créé avec succès
    alert('Message envoyé avec succès!');
  }

  //

  get form() {
    return this.msg.controls;
  }
}
