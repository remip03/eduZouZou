import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';
import { ReturnBtnComponent } from '../../commons/return-btn/return-btn.component';

@Component({
  selector: 'app-con-insc',
  standalone: true,
  imports: [RouterLink, ReturnBtnComponent],
  templateUrl: './con-insc.component.html',
  styleUrl: './con-insc.component.css'
})
export class ConInscComponent {

}
