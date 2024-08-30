import { Component } from '@angular/core';
import { ReturnBtnComponent } from '../../../commons/return-btn/return-btn.component';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-activites-menu',
  standalone: true,
  imports: [ReturnBtnComponent, RouterLink],
  templateUrl: './activites-menu.component.html',
  styleUrl: './activites-menu.component.css',
})
export class ActivitesMenuComponent {}
