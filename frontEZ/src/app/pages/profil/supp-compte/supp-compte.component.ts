import { Component } from '@angular/core';
import { ReturnBtnComponent } from '../../../commons/return-btn/return-btn.component';
import { SliderProfilComponent } from '../../../commons/slider-profil/slider-profil.component';

@Component({
  selector: 'app-supp-compte',
  standalone: true,
  imports: [ReturnBtnComponent, SliderProfilComponent],
  templateUrl: './supp-compte.component.html',
  styleUrl: './supp-compte.component.css'
})
export class SuppCompteComponent {

}
