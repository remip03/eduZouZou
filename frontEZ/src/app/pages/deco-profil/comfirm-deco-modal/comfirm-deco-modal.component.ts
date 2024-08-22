import { Component, EventEmitter, Output } from '@angular/core';
import { ChargementDecoModalComponent } from '../chargement-deco-modal/chargement-deco-modal.component';

@Component({
  selector: 'app-comfirm-deco-modal',
  standalone: true,
  imports: [ChargementDecoModalComponent],
  templateUrl: './comfirm-deco-modal.component.html',
  styleUrl: './comfirm-deco-modal.component.css'
})
export class ComfirmDecoModalComponent {
  @Output() close = new EventEmitter<void>();

  openModal() {
    const modal = document.getElementById('modalConfirmDeco');
    if (modal) {
      modal.classList.remove('hidden');
    }
  }

  closeModal() {
    const modal = document.getElementById('modalDeconnexion');
    if (modal) {
      modal.classList.add('hidden');
    }
  }
}
