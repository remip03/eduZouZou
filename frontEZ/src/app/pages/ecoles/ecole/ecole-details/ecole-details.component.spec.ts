import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EcoleDetailsComponent } from './ecole-details.component';

describe('EcoleDetailsComponent', () => {
  let component: EcoleDetailsComponent;
  let fixture: ComponentFixture<EcoleDetailsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [EcoleDetailsComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(EcoleDetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
