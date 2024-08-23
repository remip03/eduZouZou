import { CommonModule } from '@angular/common';
import { Component, HostListener, ElementRef, ChangeDetectorRef, NgZone } from '@angular/core';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-slider-profil',
  standalone: true,
  imports: [RouterLink, CommonModule],
  templateUrl: './slider-profil.component.html',
  styleUrls: ['./slider-profil.component.css']
})
export class SliderProfilComponent {
  startX: number = 0;
  currentTranslateX: number = 0;
  isDragging: boolean = false;
  transform: string = 'translateX(0px)';
  containerWidth: number = 0;
  sliderContentWidth: number = 0;
  maxTranslateX: number = 0;
  selectedMenu: string = '';

  constructor(private el: ElementRef, private ngZone: NgZone) { }

  ngAfterViewInit() {
    const container = this.el.nativeElement.querySelector('.container');
    const sliderContent = this.el.nativeElement.querySelector('.sliderContent');
    this.containerWidth = container.offsetWidth;
    this.sliderContentWidth = sliderContent.scrollWidth;
    this.maxTranslateX = this.containerWidth - this.sliderContentWidth;
  }

  @HostListener('mousedown', ['$event'])
  onMouseDown(event: MouseEvent) {
    this.startX = event.clientX;
    this.isDragging = true;
  }

  @HostListener('mousemove', ['$event'])
  onMouseMove(event: MouseEvent) {
    if (this.isDragging) {
      const moveX = event.clientX - this.startX;
      let newTranslateX = this.currentTranslateX + moveX;
      newTranslateX = Math.max(this.maxTranslateX, Math.min(0, newTranslateX));
      this.transform = `translateX(${newTranslateX}px)`;
    }
  }

  @HostListener('mouseup', ['$event'])
  onMouseUp(event: MouseEvent) {
    this.isDragging = false;
    const moveX = event.clientX - this.startX;
    this.currentTranslateX = Math.max(this.maxTranslateX, Math.min(0, this.currentTranslateX + moveX));
  }

  @HostListener('touchstart', ['$event'])
  onTouchStart(event: TouchEvent) {
    this.startX = event.touches[0].clientX;
    this.isDragging = true;
  }

  @HostListener('touchmove', ['$event'])
  onTouchMove(event: TouchEvent) {
    if (this.isDragging) {
      const moveX = event.touches[0].clientX - this.startX;
      let newTranslateX = this.currentTranslateX + moveX;
      newTranslateX = Math.max(this.maxTranslateX, Math.min(0, newTranslateX));
      this.transform = `translateX(${newTranslateX}px)`;
    }
  }

  @HostListener('touchend', ['$event'])
  onTouchEnd(event: TouchEvent) {
    this.isDragging = false;
    const moveX = event.changedTouches[0].clientX - this.startX;
    this.currentTranslateX = Math.max(this.maxTranslateX, Math.min(0, this.currentTranslateX + moveX));
  }

  onSelectMenu(menu: string) {
    this.ngZone.run(() => {
      this.selectedMenu = menu;
    });
  }

  isSelected(menu: string): boolean {
    return this.selectedMenu === menu;
  }
}
