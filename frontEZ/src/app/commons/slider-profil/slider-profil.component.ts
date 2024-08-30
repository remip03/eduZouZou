import { CommonModule } from '@angular/common';
import { Component, HostListener, ElementRef, ChangeDetectorRef, NgZone } from '@angular/core';
import { NavigationEnd, Router, RouterLink, RouterLinkActive } from '@angular/router';

@Component({
  selector: 'app-slider-profil',
  standalone: true,
  imports: [RouterLink, CommonModule, RouterLinkActive],
  templateUrl: './slider-profil.component.html',
  styleUrls: ['./slider-profil.component.css']
})
export class SliderProfilComponent {
  startX: number = 0; // Position de départ sur l'axe X pour le glissement
  currentTranslateX: number = 0; // Position actuelle de la translation sur l'axe X
  isDragging: boolean = false; // Indicateur de glissement en cours
  transform: string = 'translateX(0px)'; // Transformation CSS pour la translation
  containerWidth: number = 0; // Largeur du conteneur
  sliderContentWidth: number = 0; // Largeur du contenu du slider
  maxTranslateX: number = 0; // Translation maximale sur l'axe X
  selectedMenu: string = 'menu1'; // Menu sélectionné par défaut
  isDesktop: boolean = window.innerWidth >= 768; // Indicateur de mode bureau

  constructor(private el: ElementRef, private cdr: ChangeDetectorRef, private router: Router) {
    // Abonnement aux événements de navigation pour mettre à jour le menu sélectionné
    this.router.events.subscribe(event => {
      if (event instanceof NavigationEnd) {
        this.updateSelectedMenu();
      }
    });
  }

  // Méthode appelée après l'initialisation de la vue
  ngAfterViewInit() {
    const container = this.el.nativeElement.querySelector('.container');
    const sliderContent = this.el.nativeElement.querySelector('.sliderContent');
    this.containerWidth = container.offsetWidth; // Récupère la largeur du conteneur
    this.sliderContentWidth = sliderContent.scrollWidth; // Récupère la largeur du contenu du slider
    this.maxTranslateX = this.containerWidth - this.sliderContentWidth; // Calcule la translation maximale
  }

  // Écouteur d'événement pour le redimensionnement de la fenêtre
  @HostListener('window:resize', ['$event'])
  onResize(event: Event) {
    this.isDesktop = window.innerWidth >= 769; // Met à jour l'indicateur de mode bureau
  }

  // Écouteur d'événement pour le début du glissement (souris)
  @HostListener('mousedown', ['$event'])
  onMouseDown(event: MouseEvent) {
    this.startX = event.clientX; // Enregistre la position de départ
    this.isDragging = true; // Active le mode glissement
  }

  // Écouteur d'événement pour le mouvement de la souris
  @HostListener('mousemove', ['$event'])
  onMouseMove(event: MouseEvent) {
    if (this.isDragging) {
      const moveX = event.clientX - this.startX; // Calcule la distance de déplacement
      let newTranslateX = this.currentTranslateX + moveX; // Calcule la nouvelle position de translation
      newTranslateX = Math.max(this.maxTranslateX, Math.min(0, newTranslateX)); // Limite la translation
      this.transform = `translateX(${newTranslateX}px)`; // Applique la transformation
    }
  }

  // Écouteur d'événement pour la fin du glissement (souris)
  @HostListener('mouseup', ['$event'])
  onMouseUp(event: MouseEvent) {
    this.isDragging = false; // Désactive le mode glissement
    const moveX = event.clientX - this.startX; // Calcule la distance de déplacement
    this.currentTranslateX = Math.max(this.maxTranslateX, Math.min(0, this.currentTranslateX + moveX)); // Met à jour la position de translation
  }

  // Écouteur d'événement pour le début du glissement (tactile)
  @HostListener('touchstart', ['$event'])
  onTouchStart(event: TouchEvent) {
    this.startX = event.touches[0].clientX; // Enregistre la position de départ
    this.isDragging = true; // Active le mode glissement
  }

  // Écouteur d'événement pour le mouvement tactile
  @HostListener('touchmove', ['$event'])
  onTouchMove(event: TouchEvent) {
    if (this.isDragging) {
      const moveX = event.touches[0].clientX - this.startX; // Calcule la distance de déplacement
      let newTranslateX = this.currentTranslateX + moveX; // Calcule la nouvelle position de translation
      newTranslateX = Math.max(this.maxTranslateX, Math.min(0, newTranslateX)); // Limite la translation
      this.transform = `translateX(${newTranslateX}px)`; // Applique la transformation
    }
  }

  // Écouteur d'événement pour la fin du glissement (tactile)
  @HostListener('touchend', ['$event'])
  onTouchEnd(event: TouchEvent) {
    this.isDragging = false; // Désactive le mode glissement
    const moveX = event.changedTouches[0].clientX - this.startX; // Calcule la distance de déplacement
    this.currentTranslateX = Math.max(this.maxTranslateX, Math.min(0, this.currentTranslateX + moveX)); // Met à jour la position de translation
  }

  // Méthode pour sélectionner un menu
  onSelectMenu(menu: string) {
    this.selectedMenu = menu; // Met à jour le menu sélectionné
    this.cdr.detectChanges(); // Déclenche la détection des changements
  }

  // Méthode pour mettre à jour le menu sélectionné en fonction de l'URL
  updateSelectedMenu() {
    const url = this.router.url;
    if (url.includes('/suivis')) {
      this.selectedMenu = 'menu1';
    } else if (url.includes('/modifProfil')) {
      this.selectedMenu = 'menu2';
    } else if (url.includes('/modifMdp')) {
      this.selectedMenu = 'menu3';
    } else if (url.includes('/suppCompte')) {
      this.selectedMenu = 'menu4';
    }
    this.cdr.detectChanges(); // Déclenche la détection des changements
  }

  // Méthode pour obtenir les classes CSS du div en fonction du menu sélectionné
  getDivClass(menu: string): { [key: string]: boolean } {
    const isActive = this.selectedMenu === menu;
    return {
      menuSuivi: menu === 'menu1' && isActive,
      menuInfo: menu === 'menu2' && isActive,
      menuMdp: menu === 'menu3' && isActive,
      menuDelete: menu === 'menu4' && isActive,
      menuSuiviInactive: !isActive && this.selectedMenu === 'menu1',
      menuInfoInactive: !isActive && this.selectedMenu === 'menu2',
      menuMdpInactive: !isActive && this.selectedMenu === 'menu3',
      menuDeleteInactive: !isActive && this.selectedMenu === 'menu4'
    };
  }

  // Méthode pour obtenir les classes CSS de l'image en fonction du menu sélectionné
  getImgClass(menu: string): { [key: string]: boolean } {
    const isActive = this.selectedMenu === menu;
    return {
      iconWhite: isActive,
      iconInactiveSuivi: !isActive && this.selectedMenu === 'menu1',
      iconInactiveInfo: !isActive && this.selectedMenu === 'menu2',
      iconInactiveMdp: !isActive && this.selectedMenu === 'menu3',
      iconInactiveDelete: !isActive && this.selectedMenu === 'menu4'
    };
  }

  // Méthode pour vérifier si un menu n'est pas sélectionné
  isNotSelected(menu: string): boolean {
    return this.selectedMenu !== menu && this.selectedMenu !== '';
  }
}
