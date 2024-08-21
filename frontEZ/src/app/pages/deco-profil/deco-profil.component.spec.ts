import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DecoProfilComponent } from './deco-profil.component';

describe('DecoProfilComponent', () => {
  let component: DecoProfilComponent;
  let fixture: ComponentFixture<DecoProfilComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [DecoProfilComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DecoProfilComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
