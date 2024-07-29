import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';
import { MessageComponent } from '../../components/message/message.component';

@Component({
  selector: 'app-nav-bar',
  standalone: true,
  imports: [RouterLink, MessageComponent],
  templateUrl: './nav-bar.component.html',
  styleUrl: './nav-bar.component.css',
})
export class NavBarComponent {}
