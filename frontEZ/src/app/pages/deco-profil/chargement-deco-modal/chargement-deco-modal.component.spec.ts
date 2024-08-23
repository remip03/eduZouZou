import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ChargementDecoModalComponent } from './chargement-deco-modal.component';

describe('ChargementDecoModalComponent', () => {
  let component: ChargementDecoModalComponent;
  let fixture: ComponentFixture<ChargementDecoModalComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ChargementDecoModalComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ChargementDecoModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
