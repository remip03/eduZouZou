import { Component, HostListener } from '@angular/core';

@Component({
  selector: 'app-slider-profil',
  standalone: true,
  imports: [],
  templateUrl: './slider-profil.component.html',
  styleUrl: './slider-profil.component.css'
})
export class SliderProfilComponent {
  currentIndex = 0;
  totalSlides = 2; // Nombre total de slides
  startX: number = 0;
  endX: number = 0;
  isDragging: boolean = false;

  slide(direction: 'left' | 'right') {
    if (direction === 'left' && this.currentIndex > 0) {
      this.currentIndex--;
    } else if (direction === 'right' && this.currentIndex < this.totalSlides - 1) {
      this.currentIndex++;
    }
  }

  getTransform() {
    return `translateX(-${this.currentIndex * 100 / this.totalSlides}%)`; // Ajuster la transformation en fonction de la largeur des slides
  }

  @HostListener('touchstart', ['$event'])
  onTouchStart(event: TouchEvent) {
    this.startX = event.touches[0].clientX;
    this.isDragging = true;
  }

  @HostListener('touchmove', ['$event'])
  onTouchMove(event: TouchEvent) {
    if (this.isDragging) {
      this.endX = event.touches[0].clientX;
    }
  }

  @HostListener('touchend', ['$event'])
  onTouchEnd(event: TouchEvent) {
    this.isDragging = false;
    this.handleSwipe();
  }

  @HostListener('mousedown', ['$event'])
  onMouseDown(event: MouseEvent) {
    this.startX = event.clientX;
    this.isDragging = true;
  }

  @HostListener('mousemove', ['$event'])
  onMouseMove(event: MouseEvent) {
    if (this.isDragging) {
      this.endX = event.clientX;
    }
  }

  @HostListener('mouseup', ['$event'])
  onMouseUp(event: MouseEvent) {
    this.isDragging = false;
    this.handleSwipe();
  }

  handleSwipe() {
    if (this.startX - this.endX > 50) {
      this.slide('right');
    } else if (this.endX - this.startX > 50) {
      this.slide('left');
    }
  }
}
