import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ComfirmDecoModalComponent } from './comfirm-deco-modal.component';

describe('ComfirmDecoModalComponent', () => {
  let component: ComfirmDecoModalComponent;
  let fixture: ComponentFixture<ComfirmDecoModalComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ComfirmDecoModalComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ComfirmDecoModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
