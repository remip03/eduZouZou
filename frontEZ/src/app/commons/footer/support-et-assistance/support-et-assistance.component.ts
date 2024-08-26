import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';
import { ReturnBtnComponent } from "../../return-btn/return-btn.component";

@Component({
  selector: 'app-support-et-assistance',
  standalone: true,
  imports: [RouterLink, ReturnBtnComponent],
  templateUrl: './support-et-assistance.component.html',
  styleUrl: './support-et-assistance.component.css'
})
export class SupportEtAssistanceComponent {

}
