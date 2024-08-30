import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EnSavoirPlusComponent } from './en-savoir-plus.component';

describe('EnSavoirPlusComponent', () => {
  let component: EnSavoirPlusComponent;
  let fixture: ComponentFixture<EnSavoirPlusComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [EnSavoirPlusComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(EnSavoirPlusComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
