import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ProjetMenuComponent } from './projet-menu.component';

describe('ProjetMenuComponent', () => {
  let component: ProjetMenuComponent;
  let fixture: ComponentFixture<ProjetMenuComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ProjetMenuComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ProjetMenuComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
