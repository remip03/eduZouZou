import { Component } from '@angular/core';
import { ReturnBtnComponent } from "../../commons/return-btn/return-btn.component";

@Component({
  selector: 'app-not-found',
  standalone: true,
  imports: [ReturnBtnComponent],
  templateUrl: './not-found.component.html',
  styleUrl: './not-found.component.css'
})
export class NotFoundComponent {

}
