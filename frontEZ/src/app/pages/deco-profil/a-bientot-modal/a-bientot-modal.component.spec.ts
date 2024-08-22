import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ABientotModalComponent } from './a-bientot-modal.component';

describe('ABientotModalComponent', () => {
  let component: ABientotModalComponent;
  let fixture: ComponentFixture<ABientotModalComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ABientotModalComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ABientotModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
