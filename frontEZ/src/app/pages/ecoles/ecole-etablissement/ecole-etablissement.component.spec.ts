import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EcoleEtablissementComponent } from './ecole-etablissement.component';

describe('EcoleEtablissementComponent', () => {
  let component: EcoleEtablissementComponent;
  let fixture: ComponentFixture<EcoleEtablissementComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [EcoleEtablissementComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(EcoleEtablissementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
