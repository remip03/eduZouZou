import { Component } from '@angular/core';
import { ReturnBtnComponent } from '../../commons/return-btn/return-btn.component';
import { SliderProfilComponent } from "../../commons/slider-profil/slider-profil.component";

@Component({
  selector: 'app-profil',
  standalone: true,
  imports: [ReturnBtnComponent, SliderProfilComponent],
  templateUrl: './profil.component.html',
  styleUrl: './profil.component.css'
})
export class ProfilComponent {

}
