import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ConInscComponent } from './con-insc.component';

describe('ConInscComponent', () => {
  let component: ConInscComponent;
  let fixture: ComponentFixture<ConInscComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ConInscComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ConInscComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
