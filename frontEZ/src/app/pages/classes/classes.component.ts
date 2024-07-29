import { Component } from '@angular/core';
import { EcoleDetailsComponent } from "../ecoles/ecole/ecole-details/ecole-details.component";

@Component({
  selector: 'app-classes',
  standalone: true,
  imports: [EcoleDetailsComponent],
  templateUrl: './classes.component.html',
  styleUrl: './classes.component.css'
})
export class ClassesComponent {

}
