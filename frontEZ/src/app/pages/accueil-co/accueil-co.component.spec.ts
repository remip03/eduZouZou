import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AccueilCoComponent } from './accueil-co.component';

describe('AccueilCoComponent', () => {
  let component: AccueilCoComponent;
  let fixture: ComponentFixture<AccueilCoComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [AccueilCoComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AccueilCoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
