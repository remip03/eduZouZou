import { MessageService } from './../../../services/message.service';
import { Component } from '@angular/core';
import {
  FormBuilder,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import Message from '../../../models/message.models';

@Component({
  selector: 'app-update-msg',
  standalone: true,
  imports: [RouterLink, ReactiveFormsModule],
  templateUrl: './update-msg.component.html',
  styleUrl: './update-msg.component.css',
})
export class UpdateMsgComponent {
  msgId?: number;

  msg: FormGroup;

  constructor(
    private formBuilder: FormBuilder,
    private route: ActivatedRoute,
    private router: Router,
    private messageService: MessageService
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

        this.msg.patchValue(data);
      });
    }
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
  }
}
