import { Component, EventEmitter, Output } from '@angular/core';

@Component({
  selector: 'app-chargement-deco-modal',
  standalone: true,
  imports: [],
  templateUrl: './chargement-deco-modal.component.html',
  styleUrl: './chargement-deco-modal.component.css'
})
export class ChargementDecoModalComponent {
  @Output() close = new EventEmitter<void>();

}
