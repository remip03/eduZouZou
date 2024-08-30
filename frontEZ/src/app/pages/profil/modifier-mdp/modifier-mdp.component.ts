import { Component } from '@angular/core';
import { ReturnBtnComponent } from '../../../commons/return-btn/return-btn.component';
import { SliderProfilComponent } from '../../../commons/slider-profil/slider-profil.component';

@Component({
  selector: 'app-modifier-mdp',
  standalone: true,
  imports: [ReturnBtnComponent, SliderProfilComponent],
  templateUrl: './modifier-mdp.component.html',
  styleUrl: './modifier-mdp.component.css'
})
export class ModifierMdpComponent {

}
