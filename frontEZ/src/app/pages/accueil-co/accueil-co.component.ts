import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';
import { ReturnBtnComponent } from "../../commons/return-btn/return-btn.component";

@Component({
  selector: 'app-accueil-co',
  standalone: true,
  imports: [RouterLink, ReturnBtnComponent],
  templateUrl: './accueil-co.component.html',
  styleUrl: './accueil-co.component.css'
})
export class AccueilCoComponent {

}
