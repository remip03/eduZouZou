import { Component } from '@angular/core';
import { ReturnBtnComponent } from '../../../commons/return-btn/return-btn.component';
import { SliderProfilComponent } from '../../../commons/slider-profil/slider-profil.component';

@Component({
  selector: 'app-modifier-profil',
  standalone: true,
  imports: [ReturnBtnComponent, SliderProfilComponent],
  templateUrl: './modifier-profil.component.html',
  styleUrl: './modifier-profil.component.css'
})
export class ModifierProfilComponent {

}
