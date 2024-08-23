import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SuppCompteComponent } from './supp-compte.component';

describe('SuppCompteComponent', () => {
  let component: SuppCompteComponent;
  let fixture: ComponentFixture<SuppCompteComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [SuppCompteComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(SuppCompteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
